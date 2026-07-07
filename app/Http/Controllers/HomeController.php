<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function show(?string $section = null): View
    {
        $config = config('site');
        $sectionId = 'home';

        if ($section !== null) {
            if (isset($config['aliases'][$section])) {
                $sectionId = $config['aliases'][$section];
            } else {
                $found = collect($config['sections'])->search(
                    fn (array $s) => ($s['slug'] ?? null) === $section
                );
                $sectionId = $found ?: null;
            }

            if (! $sectionId || ! isset($config['sections'][$sectionId])) {
                abort(404);
            }
        }

        $active = $config['sections'][$sectionId];
        $canonicalPath = $active['path'];

        $sections = collect($config['sections'])->map(fn (array $s) => [
            'id' => $s['id'],
            'path' => $s['path'],
            'title' => $s['title'],
            'keywords' => $s['keywords'],
        ])->values();

        $breadcrumbLabels = [
            'about' => 'Over ons',
            'services' => 'Diensten',
            'process' => 'Werkwijze',
            'client-work' => 'Klantwerk',
            'personal-projects' => 'Projecten',
            'faq' => 'Veelgestelde vragen',
            'contact' => 'Contact',
        ];

        $breadcrumbs = [
            ['name' => 'Home', 'path' => '/'],
        ];
        if ($sectionId !== 'home') {
            $breadcrumbs[] = [
                'name' => $breadcrumbLabels[$sectionId] ?? $active['title'],
                'path' => $canonicalPath,
            ];
        }

        return view('home', [
            'initialSection' => $sectionId === 'home' ? null : $sectionId,
            'analyticsSections' => $sections,
            'pageTitle' => $active['title'],
            'pageDescription' => $active['description'],
            'canonicalUrl' => url($canonicalPath),
            'breadcrumbs' => $breadcrumbs,
        ]);
    }
}
