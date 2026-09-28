<?php

namespace App\Http\Controllers;

use App\Support\ServiceCatalog;
use App\Support\SitePage;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Only URLs that answer 200 are listed: the old section URLs now 301
     * to anchors on the home page (see App\Support\LegacyRedirects).
     */
    public function __invoke(): Response
    {
        $today = date('Y-m-d');
        $urls = [];

        // Pages that exist in both languages, with their hreflang pair.
        foreach (['home' => ['weekly', '1.0'], 'contact' => ['monthly', '0.8']] as $page => [$changefreq, $priority]) {
            array_push($urls, ...$this->pair(
                fn (string $locale) => SitePage::url($page, $locale), $today, $changefreq, $priority,
            ));
        }

        // Dutch only; date as stated on the page ("Laatst bijgewerkt").
        $urls[] = [
            'loc' => SitePage::url('privacy', 'nl'),
            'lastmod' => '2026-09-05',
            'changefreq' => 'yearly',
            'priority' => '0.3',
        ];

        foreach (ServiceCatalog::keys() as $key) {
            array_push($urls, ...$this->pair(
                fn (string $locale) => ServiceCatalog::url($key, $locale), $today, 'monthly', '0.8',
            ));
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * One <url> per locale for a page that exists in every locale, each
     * listing the full hreflang set (x-default: Dutch).
     *
     * @param  \Closure(string): string  $urlFor  locale => absolute URL
     */
    private function pair(\Closure $urlFor, string $lastmod, string $changefreq, string $priority): array
    {
        $locs = array_combine(SitePage::LOCALES, array_map($urlFor, SitePage::LOCALES));
        $alternates = $locs + ['x-default' => $locs['nl']];

        return array_map(fn (string $loc) => [
            'loc' => $loc,
            'lastmod' => $lastmod,
            'changefreq' => $changefreq,
            'priority' => $priority,
            'alternates' => $alternates,
        ], array_values($locs));
    }
}
