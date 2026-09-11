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
        $homeLastmod = date('Y-m-d'); // Update this when content changes

        $urls = collect(config('site.sections'))
            ->filter(fn (array $s) => $s['indexable'] ?? false)
            ->map(fn (array $s) => [
                'loc' => url($s['path']),
                'lastmod' => $homeLastmod,
                'changefreq' => $s['id'] === 'home' ? 'weekly' : 'monthly',
                'priority' => $s['id'] === 'home' ? '1.0' : '0.8',
                'alternates' => [
                    'nl' => url($s['path']),
                    'en' => url('/en' . ($s['path'] === '/' ? '' : $s['path'])),
                    'x-default' => url($s['path']),
                ],
            ])
            ->values()
            ->all();

        $urls[] = [
            'loc' => url('/privacyverklaring'),
            'lastmod' => '2024-01-01',
            'changefreq' => 'yearly',
            'priority' => '0.3',
        ];

        // Service pages (Dutch and English)
        $servicePages = [
            ['slug' => 'websites', 'en_slug' => 'websites'],
            ['slug' => 'adminpanelen', 'en_slug' => 'admin-panels'],
            ['slug' => 'dashboards', 'en_slug' => 'dashboards'],
            ['slug' => 'betalingen', 'en_slug' => 'payments'],
            ['slug' => 'api-integraties', 'en_slug' => 'api-integrations'],
        ];

        $serviceLastmod = date('Y-m-d'); // Today's date for service pages

        foreach ($servicePages as $service) {
            $nlUrl = url('/diensten/'.$service['slug']);
            $enUrl = url('/en/services/'.$service['en_slug']);

            $urls[] = [
                'loc' => $nlUrl,
                'lastmod' => $serviceLastmod,
                'changefreq' => 'monthly',
                'priority' => '0.7',
                'alternates' => [
                    'nl' => $nlUrl,
                    'en' => $enUrl,
                    'x-default' => $nlUrl,
                ],
            ];
            $urls[] = [
                'loc' => $enUrl,
                'lastmod' => $serviceLastmod,
                'changefreq' => 'monthly',
                'priority' => '0.7',
                'alternates' => [
                    'nl' => $nlUrl,
                    'en' => $enUrl,
                    'x-default' => $nlUrl,
                ],
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
