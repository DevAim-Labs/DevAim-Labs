<?php

namespace App\Support;

use Illuminate\Http\Request;

/**
 * View data for every page rendered with the `v2.layout`.
 *
 * One call gives a page everything the layout, header, footer and the
 * shared sections need: copy (`t`), organisation details, resolved nav
 * links (in-page anchors on home, "/#anchor" elsewhere), title, meta,
 * canonical, hreflang alternates and JSON-LD.
 *
 * Pages: home, contact, privacy (Dutch only), the service pages
 * (SitePage::service(), content via ServiceCatalog), error (404/500/503).
 * Strings come from config('site-v2'); organisation data from
 * config('site.organization'). Nothing here touches the database, so
 * the error pages can use it safely.
 */
final class SitePage
{
    public const LOCALES = ['nl', 'en'];

    /** Paths of the pages that exist per locale. */
    private const PATHS = [
        'home' => ['nl' => '/', 'en' => '/en'],
        'contact' => ['nl' => '/contact', 'en' => '/en/contact'],
        'privacy' => ['nl' => '/privacyverklaring'],
    ];

    /**
     * @param  'home'|'contact'|'privacy'  $page
     */
    public static function data(string $locale, string $page): array
    {
        $locale = self::normalizeLocale($locale);
        $t = config("site-v2.{$locale}");
        $meta = $page === 'home' ? $t['meta'] : $t['pages'][$page];
        $alternates = self::alternates($page);

        return array_merge(self::base($locale, $page), [
            'pageTitle' => $meta['title'],
            'pageDescription' => $meta['description'],
            'canonicalUrl' => self::url($page, $locale),
            'alternateUrls' => $alternates,
            'otherLocaleUrl' => $alternates[self::otherLocale($locale)] ?? self::url('home', self::otherLocale($locale)),
            'robots' => null,
            'breadcrumbs' => self::breadcrumbs($locale, $page),
            'structuredData' => self::structuredData($locale, $page, $meta),
        ]);
    }

    /**
     * Data for a service detail page (/diensten/{slug}, /en/services/{slug}).
     * `service` holds the resolved page content (see ServiceCatalog::page()).
     */
    public static function service(string $locale, string $key): array
    {
        $locale = self::normalizeLocale($locale);
        $service = ServiceCatalog::page($key, $locale);
        $alternates = array_combine(self::LOCALES, array_map(fn (string $lang) => ServiceCatalog::url($key, $lang), self::LOCALES));

        $t = config("site-v2.{$locale}");
        $breadcrumbs = [
            ['name' => $t['pages']['home']['crumb'], 'url' => self::url('home', $locale)],
            ['name' => $service['ui']['crumb_services'], 'url' => url(self::sectionPath($locale, 'services'))],
            ['name' => $service['name'], 'url' => $service['url']],
        ];

        return array_merge(self::base($locale, 'service'), [
            'pageTitle' => $service['meta']['title'],
            'pageDescription' => $service['meta']['description'],
            'canonicalUrl' => $service['url'],
            'alternateUrls' => $alternates,
            'otherLocaleUrl' => $alternates[self::otherLocale($locale)],
            'robots' => null,
            'breadcrumbs' => $breadcrumbs,
            'service' => $service,
            'structuredData' => self::serviceStructuredData($locale, $service, $breadcrumbs),
        ]);
    }

    /**
     * Data for an error page, with no controller involved: the locale
     * comes from the request path ("/en" prefix).
     */
    public static function error(Request $request, int $status): array
    {
        $locale = self::localeFor($request);
        $t = config("site-v2.{$locale}");
        $strings = $t['errors'][(string) $status] ?? $t['errors']['500'];

        return array_merge(self::base($locale, 'error'), [
            'pageTitle' => $strings['title'],
            'pageDescription' => null,
            'canonicalUrl' => null,
            'alternateUrls' => [],
            'otherLocaleUrl' => self::url('home', self::otherLocale($locale)),
            'robots' => 'noindex',
            'breadcrumbs' => [],
            'structuredData' => null,
            'status' => $status,
            'error' => $strings,
            // 500 and 503: no nav, no menus. Just the brand, the message and a way back.
            'minimalChrome' => $status >= 500,
        ]);
    }

    public static function localeFor(Request $request): string
    {
        return $request->is('en') || $request->is('en/*') ? 'en' : 'nl';
    }

    /** Absolute URL of a page, e.g. url('contact', 'en'). */
    public static function url(string $page, string $locale): string
    {
        $paths = self::PATHS[$page];

        return url($paths[$locale] ?? $paths['nl']);
    }

    /**
     * Path of a home section, e.g. sectionPath('nl', 'pricing') = "/#tarieven".
     * A null section is the top of the home page.
     */
    public static function sectionPath(string $locale, ?string $section): string
    {
        $home = self::PATHS['home'][$locale];

        if ($section === null) {
            return $home;
        }

        $id = config("site-v2.{$locale}.ids.{$section}");

        if ($id === null) {
            throw new \InvalidArgumentException("Unknown home section [{$section}].");
        }

        return $home.'#'.$id;
    }

    /* ------------------------------------------------------------------ */

    /** Data shared by every page: copy, organisation, header and footer links. */
    private static function base(string $locale, string $page): array
    {
        $t = self::withServiceLinks(config("site-v2.{$locale}"), $locale);
        $org = config('site.organization');
        $isHome = $page === 'home';

        // On home, a section link is a plain in-page anchor.
        $section = fn (string $key) => $isHome ? '#'.$t['ids'][$key] : url(self::sectionPath($locale, $key));

        $navLinks = array_map(function (array $link) use ($section, $isHome, $page, $locale, $t) {
            if (isset($link['section'])) {
                $href = $section($link['section']);
            } elseif ($link['page'] === 'contact' && $isHome) {
                $href = '#'.$t['ids']['contact'];
            } else {
                $href = self::url($link['page'], $locale);
            }

            return $link + [
                'href' => $href,
                'current' => ($link['page'] ?? null) === $page,
            ];
        }, $t['nav']['links']);

        return [
            'locale' => $locale,
            't' => $t,
            'org' => $org,
            'company' => config('site-v2.company'),
            'phoneHref' => 'tel:'.preg_replace('/[^0-9+]/', '', $org['phone']),
            'pageKey' => $page,
            'isHome' => $isHome,
            'minimalChrome' => false,
            'homeUrl' => self::url('home', $locale),
            'brandHref' => $isHome ? '#top' : self::url('home', $locale),
            'navLinks' => $navLinks,
            'servicesMenu' => $t['nav']['services_menu'],
            'ctaHref' => $section($t['nav']['cta']['section']),
            'ogLocale' => $t['meta']['og_locale'],
        ];
    }

    /**
     * The services menu and the home service cards name a service by key
     * (`service`); its URL comes from ServiceCatalog, so slugs live in one place.
     */
    private static function withServiceLinks(array $t, string $locale): array
    {
        $link = fn (array $item) => $item + ['href' => ServiceCatalog::path($item['service'], $locale)];
        $t['nav']['services_menu']['items'] = array_map($link, $t['nav']['services_menu']['items']);
        $t['services']['items'] = array_map($link, $t['services']['items']);

        return $t;
    }

    /** hreflang alternates: only for pages that exist in more than one language. */
    private static function alternates(string $page): array
    {
        $paths = self::PATHS[$page];

        return count($paths) > 1 ? array_map(fn (string $path) => url($path), $paths) : [];
    }

    private static function breadcrumbs(string $locale, string $page): array
    {
        if ($page === 'home') {
            return [];
        }

        $pages = config("site-v2.{$locale}.pages");

        return [
            ['name' => $pages['home']['crumb'], 'url' => self::url('home', $locale)],
            ['name' => $pages[$page]['crumb'], 'url' => self::url($page, $locale)],
        ];
    }

    private static function structuredData(string $locale, string $page, array $meta): array
    {
        $t = config("site-v2.{$locale}");
        $org = config('site.organization');
        $url = self::url($page, $locale);
        $orgId = self::orgId();

        if ($page === 'home') {
            return [
                '@context' => 'https://schema.org',
                '@graph' => [
                    [
                        '@type' => 'ProfessionalService',
                        '@id' => $orgId,
                        'name' => $org['name'],
                        'url' => url('/'),
                        'logo' => asset(ltrim($org['logo'], '/')),
                        'image' => asset('og-image.png'),
                        'email' => $org['email'],
                        'telephone' => $org['phone'],
                        'vatID' => config('site-v2.company.btw'),
                        'description' => $t['meta']['description'],
                        'areaServed' => ['@type' => 'Country', 'name' => 'Nederland'],
                        'address' => ['@type' => 'PostalAddress', 'addressCountry' => 'NL'],
                        'knowsLanguage' => ['nl', 'en'],
                        'hasOfferCatalog' => [
                            '@type' => 'OfferCatalog',
                            'name' => $t['services']['title'],
                            'itemListElement' => array_map(fn (array $s) => [
                                '@type' => 'Offer',
                                'itemOffered' => ['@type' => 'Service', 'name' => $s['title'], 'description' => $s['outcome']],
                            ], $t['services']['items']),
                        ],
                    ],
                    [
                        '@type' => 'WebSite',
                        '@id' => url('/').'#website',
                        'url' => url('/'),
                        'name' => $org['name'],
                        'inLanguage' => ['nl', 'en'],
                        'publisher' => ['@id' => $orgId],
                    ],
                    self::faqNode($url, $locale, $t['faq']['items']),
                ],
            ];
        }

        $crumbs = self::breadcrumbs($locale, $page);

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => $page === 'contact' ? 'ContactPage' : 'WebPage',
                    '@id' => $url.'#webpage',
                    'url' => $url,
                    'name' => $meta['title'],
                    'description' => $meta['description'],
                    'inLanguage' => $locale,
                    'isPartOf' => ['@id' => url('/').'#website'],
                    'about' => ['@id' => $orgId],
                ],
                self::breadcrumbNode($crumbs),
            ],
        ];
    }

    /** Service + FAQPage + BreadcrumbList, as one @graph. */
    private static function serviceStructuredData(string $locale, array $service, array $crumbs): array
    {
        $url = $service['url'];

        $serviceNode = [
            '@type' => 'Service',
            '@id' => $url.'#service',
            'name' => $service['hero']['title'].' '.$service['hero']['title_em'],
            'serviceType' => $service['schema_type'],
            'description' => $service['meta']['description'],
            'url' => $url,
            'inLanguage' => $locale,
            'provider' => ['@id' => self::orgId()],
            'areaServed' => ['@type' => 'Country', 'name' => 'Nederland'],
        ];

        // Only a real, configured price becomes an Offer; "on request" has none.
        if ($service['price_from'] !== null) {
            $serviceNode['offers'] = [
                '@type' => 'Offer',
                'priceCurrency' => 'EUR',
                'priceSpecification' => [
                    '@type' => 'PriceSpecification',
                    'minPrice' => $service['price_from'],
                    'priceCurrency' => 'EUR',
                    'valueAddedTaxIncluded' => false,
                ],
            ];
        }

        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                $serviceNode,
                self::faqNode($url, $locale, $service['faq']),
                self::breadcrumbNode($crumbs),
            ],
        ];
    }

    /** @param  list<array{q: string, a: string}>  $items */
    private static function faqNode(string $url, string $locale, array $items): array
    {
        return [
            '@type' => 'FAQPage',
            '@id' => $url.'#faq',
            'inLanguage' => $locale,
            'mainEntity' => array_map(fn (array $item) => [
                '@type' => 'Question',
                'name' => $item['q'],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
            ], $items),
        ];
    }

    /** @param  list<array{name: string, url: string}>  $crumbs  positions start at 1 */
    private static function breadcrumbNode(array $crumbs): array
    {
        return [
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(fn (array $crumb, int $i) => [
                '@type' => 'ListItem',
                'position' => $i + 1,
                'name' => $crumb['name'],
                'item' => $crumb['url'],
            ], $crumbs, array_keys($crumbs)),
        ];
    }

    private static function orgId(): string
    {
        return url('/').'#organization';
    }

    private static function normalizeLocale(string $locale): string
    {
        return in_array($locale, self::LOCALES, true) ? $locale : 'nl';
    }

    private static function otherLocale(string $locale): string
    {
        return $locale === 'nl' ? 'en' : 'nl';
    }
}
