<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class HomeController extends Controller
{
    public function show(?string $section = null): View
    {
        return $this->renderHome($section, 'nl');
    }

    public function showEn(?string $section = null): View
    {
        return $this->renderHome($section, 'en');
    }

    public function showContact(): View
    {
        return $this->renderContactPage('nl');
    }

    public function showContactEn(): View
    {
        return $this->renderContactPage('en');
    }

    protected function renderContactPage(string $locale): View
    {
        $configKey = $locale === 'en' ? 'site-en' : 'site';
        $config = config($configKey);
        $translations = config('translations');
        $contact = $config['sections']['contact'];

        $homePath = $locale === 'en' ? '/en' : '/';
        $breadcrumbs = [
            ['name' => 'Home', 'path' => $homePath],
            ['name' => 'Contact', 'path' => $contact['path']],
        ];

        $alternateUrls = [
            'nl' => url('/contact'),
            'en' => url('/en/contact'),
        ];

        return view('contact-page', [
            'pageTitle' => $contact['title'],
            'pageDescription' => $contact['description'],
            'canonicalUrl' => url($contact['path']),
            'breadcrumbs' => $breadcrumbs,
            'locale' => $locale,
            'translations' => $translations,
            'alternateUrls' => $alternateUrls,
        ]);
    }

    protected function renderHome(?string $section, string $locale): View
    {
        $configKey = $locale === 'en' ? 'site-en' : 'site';
        $config = config($configKey);
        $translations = config('translations')[$locale] ?? [];
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

        $breadcrumbLabels = $locale === 'en' ? [
            'about' => 'About',
            'services' => 'Services',
            'process' => 'Process',
            'client-work' => 'Work',
            'personal-projects' => 'Projects',
            'faq' => 'FAQ',
            'contact' => 'Contact',
        ] : [
            'about' => 'Over ons',
            'services' => 'Diensten',
            'process' => 'Werkwijze',
            'client-work' => 'Klantwerk',
            'personal-projects' => 'Projecten',
            'faq' => 'Veelgestelde vragen',
            'contact' => 'Contact',
        ];

        $homePath = $locale === 'en' ? '/en' : '/';
        $breadcrumbs = [
            ['name' => 'Home', 'path' => $homePath],
        ];
        if ($sectionId !== 'home') {
            $breadcrumbs[] = [
                'name' => $breadcrumbLabels[$sectionId] ?? $active['title'],
                'path' => $canonicalPath,
            ];
        }

        // Alternate language URLs for SEO
        $alternateUrls = [];
        if ($locale === 'nl') {
            $enConfig = config('site-en');
            $enSection = $enConfig['sections'][$sectionId] ?? null;
            if ($enSection) {
                $alternateUrls['en'] = url($enSection['path']);
            }
            $alternateUrls['nl'] = url($canonicalPath);
        } else {
            $nlConfig = config('site');
            $nlSection = $nlConfig['sections'][$sectionId] ?? null;
            if ($nlSection) {
                $alternateUrls['nl'] = url($nlSection['path']);
            }
            $alternateUrls['en'] = url($canonicalPath);
        }

        return view('home', [
            'initialSection' => $sectionId === 'home' ? null : $sectionId,
            'analyticsSections' => $sections,
            'pageTitle' => $active['title'],
            'pageDescription' => $active['description'],
            'canonicalUrl' => ($active['indexable'] ?? false) ? url($canonicalPath) : url($homePath),
            'breadcrumbs' => $breadcrumbs,
            'locale' => $locale,
            'translations' => $translations,
            'alternateUrls' => $alternateUrls,
        ]);
    }
}
