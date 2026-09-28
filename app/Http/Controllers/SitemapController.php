<?php

namespace App\Http\Controllers;

use App\Support\ServiceCatalog;
use App\Support\SitePage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;

class SitemapController extends Controller
{
    /**
     * Only URLs that answer 200 are listed: the old section URLs now 301
     * to anchors on the home page (see App\Support\LegacyRedirects).
     */
    public function __invoke(): Response
    {
        $lastmod = $this->contentLastModified();
        $urls = [];

        // Pages that exist in both languages, with their hreflang pair.
        foreach (['home' => ['weekly', '1.0'], 'contact' => ['monthly', '0.8']] as $page => [$changefreq, $priority]) {
            array_push($urls, ...$this->pair(
                fn (string $locale) => SitePage::url($page, $locale), $lastmod, $changefreq, $priority,
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
                fn (string $locale) => ServiceCatalog::url($key, $locale), $lastmod, 'monthly', '0.8',
            ));
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * Date the page content last changed: the newest of the copy, the
     * service content, the client cases and the page templates. Not
     * "today": a lastmod that moves daily without a change teaches
     * crawlers to ignore it.
     */
    private function contentLastModified(): string
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
