<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $sections = config('site.sections');
        $urls = [];

        foreach ($sections as $section) {
            if (empty($section['path'])) {
                continue;
            }
            $urls[] = [
                'loc' => url($section['path']),
                'changefreq' => $section['id'] === 'home' ? 'weekly' : 'monthly',
                'priority' => $section['id'] === 'home' ? '1.0' : '0.8',
            ];
        }

        $xml = view('sitemap', ['urls' => $urls])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
