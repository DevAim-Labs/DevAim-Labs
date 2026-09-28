<?php

namespace App\Support;

/**
 * The service detail pages (/diensten/{slug}, /en/services/{slug}).
 *
 * One place that knows the services: their stable keys, localized slugs
 * and URLs, and the resolved content a service page renders. Content comes
 * from config('site-v2-services'); prices and real cases are looked up in
 * config('site-v2') so they are never duplicated.
 *
 * Callers: routes (slug patterns), PageController + SitePage (page data),
 * LegacyRedirects (old aliases), SitemapController (URLs).
 */
final class ServiceCatalog
{
    private const PREFIX = ['nl' => '/diensten/', 'en' => '/en/services/'];

    /** @return list<string> stable service keys, in display order */
    public static function keys(): array
    {
        return config('site-v2-services.order');
    }

    /** Route constraint for one locale, e.g. "websites|adminpanelen|...". */
    public static function slugPattern(string $locale): string
    {
        return implode('|', array_map(fn (string $key) => self::slug($key, $locale), self::keys()));
    }

    public static function keyForSlug(string $locale, string $slug): ?string
    {
        foreach (self::keys() as $key) {
            if (self::slug($key, $locale) === $slug) {
                return $key;
            }
        }

        return null;
    }

    /** Relative path, e.g. path('admin-panels', 'nl') = "/diensten/adminpanelen". */
    public static function path(string $key, string $locale): string
    {
        return self::PREFIX[$locale].self::slug($key, $locale);
    }

    /** Absolute URL. */
    public static function url(string $key, string $locale): string
    {
        return url(self::path($key, $locale));
    }

    /**
     * Old path => service key, for both locales (see `legacy` in the config).
     *
     * @return array<string, string>
     */
    public static function legacyPaths(): array
    {
        return array_merge(...array_values(config('site-v2-services.legacy', [])));
    }

    /**
     * Everything a service page renders, resolved for one locale:
     * copy, UI labels, demo (or null), price, real cases and related cards.
     */
    public static function page(string $key, string $locale): array
    {
        $service = self::raw($key);
        $content = $service[$locale];
        $site = config("site-v2.{$locale}");

        $demo = $service['demo'] === null ? null : $service['demo'] + $content['demo'] + [
            'embed_src' => $service['demo']['src'].'?embed=1',
        ];

        // Resolved keys first: `+` keeps the left-hand value (content has its own `demo`).
        return [
            'key' => $key,
            'url' => self::url($key, $locale),
            'icon' => $service['icon'],
            'project_type' => $service['project_type'],
            'schema_type' => $service['schema_type'],
            'demo' => $demo,
            'flow' => $content['flow'] ?? null,
            'price_from' => self::priceFrom($service['package'], $site),
            'cases' => self::cases($service['cases'], $site),
            'related' => array_map(fn (string $other) => self::card($other, $locale), $service['related']),
            'ui' => config("site-v2-services.ui.{$locale}"),
        ] + $content;
    }

    /* ------------------------------------------------------------------ */

    private static function raw(string $key): array
    {
        $service = config("site-v2-services.services.{$key}");

        if ($service === null) {
            throw new \InvalidArgumentException("Unknown service [{$key}].");
        }

        return $service;
    }

    private static function slug(string $key, string $locale): string
    {
        return self::raw($key)['slugs'][$locale];
    }

    /** "vanaf" price of the linked pricing package; null = price on request. */
    private static function priceFrom(string $package, array $site): ?int
    {
        foreach ($site['pricing']['packages'] as $p) {
            if ($p['key'] === $package) {
                return $p['price_from'];
            }
        }

        return null;
    }

    /** Real cases by name, as listed in the home work section. */
    private static function cases(array $names, array $site): array
    {
        return array_values(array_filter(
            $site['work']['cases'],
            fn (array $case) => in_array($case['name'], $names, true),
        ));
    }

    /** A related-service card: title, summary, link and thumbnail (or icon). */
    private static function card(string $key, string $locale): array
    {
        $service = self::raw($key);

        return [
            'key' => $key,
            'title' => $service[$locale]['name'],
            'summary' => $service[$locale]['summary'],
            'href' => self::path($key, $locale),
            'icon' => $service['icon'],
            'image' => $service['demo']['image'] ?? null,
            'alt' => $service[$locale]['demo']['alt'] ?? null,
        ];
    }
}
