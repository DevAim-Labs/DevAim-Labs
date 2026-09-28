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
 * Which pages exist, and their URLs and hreflang alternates, come from
 * the PageRegistry.
 * Strings come from config('site-v2'); the Organisation's details and
 * schema.org node from App\Support\Organisation (views get them as
 * `$org`, never from config). Nothing here touches the database, so
 * the error pages can use it safely.
 */
final class SitePage
{
    /**
     * @param  'home'|'contact'|'privacy'  $page
     */
    public static function data(string $locale, string $page): array
    {
        $locale = self::normalizeLocale($locale);
        $t = config("site-v2.{$locale}");
        $meta = $page === 'home' ? $t['meta'] : $t['pages'][$page];
        $alternates = PageRegistry::alternates($page);

        return array_merge(self::base($locale, $page), [
            'pageTitle' => $meta['title'],
            'pageDescription' => $meta['description'],
            'canonicalUrl' => PageRegistry::url($page, $locale),
            'alternateUrls' => $alternates,
            'otherLocaleUrl' => $alternates[self::otherLocale($locale)] ?? PageRegistry::url('home', self::otherLocale($locale)),
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
        $alternates = PageRegistry::alternates(PageRegistry::service($key));

        $t = config("site-v2.{$locale}");
        $breadcrumbs = [
            ['name' => $t['pages']['home']['crumb'], 'url' => PageRegistry::url('home', $locale)],
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
            'otherLocaleUrl' => PageRegistry::url('home', self::otherLocale($locale)),
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

    /**
     * Path of a home section, e.g. sectionPath('nl', 'pricing') = "/#tarieven".
     * A null section is the top of the home page.
     */
    public static function sectionPath(string $locale, ?string $section): string
    {
        $home = PageRegistry::path('home', $locale);

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
        $isHome = $page === 'home';

        // On home, a section link is a plain in-page anchor.
        $section = fn (string $key) => $isHome ? '#'.$t['ids'][$key] : url(self::sectionPath($locale, $key));

        $navLinks = array_map(function (array $link) use ($section, $isHome, $page, $locale, $t) {
            if (isset($link['section'])) {
                $href = $section($link['section']);
            } elseif ($link['page'] === 'contact' && $isHome) {
                $href = '#'.$t['ids']['contact'];
            } else {
                $href = PageRegistry::url($link['page'], $locale);
            }

            return $link + [
                'href' => $href,
                'current' => ($link['page'] ?? null) === $page,
            ];
        }, $t['nav']['links']);

        return [
            'locale' => $locale,
            't' => $t,
            'org' => Organisation::details(),
            'pageKey' => $page,
            'isHome' => $isHome,
            'minimalChrome' => false,
            'homeUrl' => PageRegistry::url('home', $locale),
            // Dutch only: the same URL from every locale.
            'privacyUrl' => PageRegistry::url('privacy', $locale),
            'brandHref' => $isHome ? '#top' : PageRegistry::url('home', $locale),
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
        $t['work']['cases'] = ClientCases::all($locale);

        return $t;
    }

    private static function breadcrumbs(string $locale, string $page): array
    {
        if ($page === 'home') {
            return [];
        }

        $pages = config("site-v2.{$locale}.pages");

        return [
            ['name' => $pages['home']['crumb'], 'url' => PageRegistry::url('home', $locale)],
            ['name' => $pages[$page]['crumb'], 'url' => PageRegistry::url($page, $locale)],
        ];
    }

    private static function structuredData(string $locale, string $page, array $meta): array
    {
        $t = config("site-v2.{$locale}");
        $url = PageRegistry::url($page, $locale);
        $orgId = Organisation::id();

        if ($page === 'home') {
            return [
                '@context' => 'https://schema.org',
                '@graph' => [
                    self::organisationNode($locale) + [
                        // No Offer without a real price: the catalog lists the services themselves.
                        'hasOfferCatalog' => [
                            '@type' => 'OfferCatalog',
                            'name' => $t['services']['title'],
                            'itemListElement' => array_map(fn (array $s) => [
                                '@type' => 'Service',
                                'name' => $s['title'],
                                'description' => $s['outcome'],
                                'url' => ServiceCatalog::url($s['service'], $locale),
                                'provider' => ['@id' => $orgId],
                            ], $t['services']['items']),
                        ],
                    ],
                    [
                        '@type' => 'WebSite',
                        '@id' => url('/').'#website',
                        'url' => url('/'),
                        'name' => Organisation::details()['name'],
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
                self::organisationNode($locale),
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
            'provider' => ['@id' => Organisation::id()],
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
                self::organisationNode($locale),
                self::faqNode($url, $locale, $service['faq']),
                self::breadcrumbNode($crumbs),
            ],
        ];
    }

    /** The business node, on every page so provider / about / publisher references resolve. */
    private static function organisationNode(string $locale): array
    {
        return Organisation::schemaNode(config("site-v2.{$locale}.meta.description"));
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

    private static function normalizeLocale(string $locale): string
    {
        return in_array($locale, PageRegistry::LOCALES, true) ? $locale : PageRegistry::DEFAULT_LOCALE;
    }

    private static function otherLocale(string $locale): string
    {
        return $locale === 'nl' ? 'en' : 'nl';
    }
}
