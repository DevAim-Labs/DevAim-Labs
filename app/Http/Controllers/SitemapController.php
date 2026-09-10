<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        // Every section route renders the same one-page document (see HomeController).
        // Routes without their own unique content self-canonicalize to '/' and are left
        // out here; only sections marked `indexable` in config/site.php (i.e. ones that
        // actually render distinct content, see home.blade.php) get their own entry.
        $urls = collect(config('site.sections'))
            ->filter(fn (array $s) => $s['indexable'] ?? false)
            ->map(fn (array $s) => [
                'loc' => url($s['path']),
                'changefreq' => $s['id'] === 'home' ? 'weekly' : 'monthly',
                'priority' => $s['id'] === 'home' ? '1.0' : '0.8',
            ])
            ->values()
            ->all();

        $urls[] = [
            'loc' => url('/privacyverklaring'),
            'changefreq' => 'yearly',
            'priority' => '0.3',
        ];

        // Service pages (Dutch)
        $servicePages = [
            ['slug' => 'websites', 'en_slug' => 'websites'],
            ['slug' => 'adminpanelen', 'en_slug' => 'admin-panels'],
            ['slug' => 'dashboards', 'en_slug' => 'dashboards'],
            ['slug' => 'betalingen', 'en_slug' => 'payments'],
            ['slug' => 'api-integraties', 'en_slug' => 'api-integrations'],
        ];

        foreach ($servicePages as $service) {
            $urls[] = [
                'loc' => url('/diensten/'.$service['slug']),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
            $urls[] = [
                'loc' => url('/en/services/'.$service['en_slug']),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
