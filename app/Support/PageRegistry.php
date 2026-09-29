<?php

namespace App\Support;

use Illuminate\Support\Facades\File;

/**
 * The page registry: every live Page of the site, per locale (see CONTEXT.md).
 *
 * A Page is identified by a string: 'home', 'contact', 'privacy' (Dutch
 * only), or a service page, PageRegistry::service('payments'), whose
 * localized slug comes from ServiceCatalog. Everything that needs to know
 * which URLs exist asks this module: routes, SitePage (canonical, hreflang,
 * breadcrumbs), the sitemap, llms.txt, LegacyRedirects (a live path is
 * never redirected) and the views (through SitePage data).
 *
 * Interface:
 * - pages(): every page id, in sitemap order;
 * - locales(), path(), url(): where a page lives;
 * - alternates(): its hreflang set (empty for a page in one locale);
 * - livePaths(), sitemap(): every live URL, with its sitemap metadata.
 *
 * Only pages that answer 200 are listed: error pages and redirects are not
 * Pages. Every Page is indexable.
 */
final class PageRegistry
{
    public const LOCALES = ['nl', 'en'];

    /** The locale of x-default and of the fallback in url(). */
    public const DEFAULT_LOCALE = 'nl';

    /**
     * The fixed pages. `lastmod` is null for "when the content last
     * changed" (see contentLastModified()), or a fixed date as stated on
     * the page itself.
     */
    private const FIXED = [
        'home' => [
            'paths' => ['nl' => '/', 'en' => '/en'],
            'changefreq' => 'weekly',
            'priority' => '1.0',
            'lastmod' => null,
        ],
        'contact' => [
            'paths' => ['nl' => '/contact', 'en' => '/en/contact'],
            'changefreq' => 'monthly',
            'priority' => '0.8',
            'lastmod' => null,
        ],
        // Dutch only; date as stated on the page ("Laatst bijgewerkt").
        'privacy' => [
            'paths' => ['nl' => '/privacyverklaring'],
            'changefreq' => 'yearly',
            'priority' => '0.3',
            'lastmod' => '2026-09-05',
        ],
    ];

    /** Service pages live under this path per locale, then their localized slug. */
    private const SERVICE_PREFIX = ['nl' => '/diensten', 'en' => '/en/services'];

    private const SERVICE = 'service:';

    /** Page id of a service page, e.g. service('payments') = "service:payments". */
    public static function service(string $key): string
    {
        return self::SERVICE.$key;
    }

    /** The service key of a service page id, or null for a fixed page. */
    public static function serviceKey(string $page): ?string
    {
        return str_starts_with($page, self::SERVICE) ? substr($page, strlen(self::SERVICE)) : null;
    }

    /** @return list<string> every page id: the fixed pages, then the services in catalog order */
    public static function pages(): array
    {
        return [...array_keys(self::FIXED), ...array_map(self::service(...), ServiceCatalog::keys())];
    }

    /** @return list<string> the locales a page exists in */
    public static function locales(string $page): array
    {
        return self::serviceKey($page) !== null ? self::LOCALES : array_keys(self::fixed($page)['paths']);
    }

    /**
     * Relative path of a page in a locale, e.g. path('contact', 'en') =
     * "/en/contact". A page that does not exist in that locale gives its
     * default-locale path (the Dutch privacy statement from an /en page).
     */
    public static function path(string $page, string $locale): string
    {
        if (! in_array($locale, self::locales($page), true)) {
            $locale = self::DEFAULT_LOCALE;
        }

        $key = self::serviceKey($page);

        return $key !== null
            ? self::servicePrefix($locale).'/'.ServiceCatalog::slug($key, $locale)
            : self::fixed($page)['paths'][$locale];
    }

    /** Absolute URL of path(). */
    public static function url(string $page, string $locale): string
    {
        return url(self::path($page, $locale));
    }

    /**
     * hreflang alternates, locale => absolute URL. Empty for a page that
     * exists in one locale only. x-default (the Dutch URL) is not included:
     * the layout and the sitemap add it.
     *
     * @return array<string, string>
     */
    public static function alternates(string $page): array
    {
        $locales = self::locales($page);

        if (count($locales) < 2) {
            return [];
        }

        return array_combine($locales, array_map(fn (string $locale) => self::url($page, $locale), $locales));
    }

    /** Where the service pages of a locale live, e.g. "/en/services" (for the routes). */
    public static function servicePrefix(string $locale): string
    {
        return self::SERVICE_PREFIX[$locale];
    }

    /** @return list<string> every live relative path (never redirected) */
    public static function livePaths(): array
    {
        $paths = [];

        foreach (self::pages() as $page) {
            foreach (self::locales($page) as $locale) {
                $paths[] = self::path($page, $locale);
            }
        }

        return $paths;
    }

    /**
     * One sitemap entry per page per locale, in pages() order.
     *
     * @return list<array{page: string, locale: string, loc: string, lastmod: string, changefreq: string, priority: string, alternates: array<string, string>}>
     */
    public static function sitemap(): array
    {
        $contentDate = self::contentLastModified();
        $entries = [];

        foreach (self::pages() as $page) {
            $meta = self::serviceKey($page) !== null
                ? ['changefreq' => 'monthly', 'priority' => '0.8', 'lastmod' => null]
                : self::fixed($page);
            $alternates = self::alternates($page);

            foreach (self::locales($page) as $locale) {
                $entries[] = [
                    'page' => $page,
                    'locale' => $locale,
                    'loc' => self::url($page, $locale),
                    'lastmod' => $meta['lastmod'] ?? $contentDate,
                    'changefreq' => $meta['changefreq'],
                    'priority' => $meta['priority'],
                    'alternates' => $alternates === [] ? [] : $alternates + ['x-default' => $alternates[self::DEFAULT_LOCALE]],
                ];
            }
        }

        return $entries;
    }

    /* ------------------------------------------------------------------ */

    private static function fixed(string $page): array
    {
        return self::FIXED[$page] ?? throw new \InvalidArgumentException("Unknown page [{$page}].");
    }

    /**
     * Date the page content last changed: the newest of the copy, the
     * service content, the client cases and the page templates. Not
     * "today": a lastmod that moves daily without a change teaches
     * crawlers to ignore it.
     */
    private static function contentLastModified(): string
    {
        $times = array_map(
            fn (string $file) => is_file($file) ? filemtime($file) : 0,
            [config_path('site-v2.php'), config_path('site-v2-services.php'), resource_path('data/clients.json')],
        );

        foreach (File::allFiles(resource_path('views/v2')) as $view) {
            $times[] = $view->getMTime();
        }

        return date('Y-m-d', max($times) ?: time());
    }
}
