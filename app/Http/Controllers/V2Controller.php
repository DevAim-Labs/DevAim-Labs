<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Vite;
use Illuminate\View\View;

/**
 * The /v2 redesign, served side by side with the current site until launch.
 */
class V2Controller extends Controller
{
    public function nl(): View
    {
        return $this->show('nl');
    }

    public function en(): View
    {
        return $this->show('en');
    }

    private function show(string $locale): View
    {
        $t = config("site-v2.{$locale}");
        $org = config('site.organization');
        $company = config('site-v2.company');

        $alternates = [
            'nl' => route('v2'),
            'en' => route('v2.en'),
        ];

        $this->limitFontPreloads();

        return view('v2.home', [
            'locale' => $locale,
            't' => $t,
            'org' => $org,
            'company' => $company,
            'phoneHref' => 'tel:'.preg_replace('/[^0-9+]/', '', $org['phone']),
            'canonicalUrl' => $alternates[$locale],
            'alternateUrls' => $alternates,
            'otherLocaleUrl' => $alternates[$locale === 'nl' ? 'en' : 'nl'],
            'structuredData' => $this->structuredData($locale, $t, $org, $company, $alternates[$locale]),
        ]);
    }

    /**
     * ProfessionalService + FAQPage, as one @graph.
     */
    private function structuredData(string $locale, array $t, array $org, array $company, string $url): array
    {
        return [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'ProfessionalService',
                    '@id' => url('/').'#organization',
                    'name' => $org['name'],
                    'url' => url('/'),
                    'logo' => asset($org['logo']),
                    'image' => asset('og-image.png'),
                    'email' => $org['email'],
                    'telephone' => $org['phone'],
                    'vatID' => $company['btw'],
                    'description' => $t['meta']['description'],
                    'areaServed' => ['@type' => 'Country', 'name' => 'Nederland'],
                    'address' => ['@type' => 'PostalAddress', 'addressCountry' => 'NL'],
                    'knowsLanguage' => ['nl', 'en'],
                    'hasOfferCatalog' => [
                        '@type' => 'OfferCatalog',
                        'name' => $t['services']['title'],
                        'itemListElement' => collect($t['services']['items'])->map(fn ($s) => [
                            '@type' => 'Offer',
                            'itemOffered' => ['@type' => 'Service', 'name' => $s['title'], 'description' => $s['outcome']],
                        ])->all(),
                    ],
                ],
                [
                    '@type' => 'FAQPage',
                    '@id' => $url.'#faq',
                    'inLanguage' => $locale,
                    'mainEntity' => collect($t['faq']['items'])->map(fn ($item) => [
                        '@type' => 'Question',
                        'name' => $item['q'],
                        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $item['a']],
                    ])->all(),
                ],
            ],
        ];
    }

    /**
     * The fonts plugin preloads every woff2 of every family it renders
     * (all weights, all unicode subsets). For this page only the latin
     * Fraunces 400 file (the H1 face) is worth a preload; the rest load
     * on demand through their @font-face rules.
     */
    private function limitFontPreloads(): void
    {
        $keep = $this->headingFontFile();

        Vite::usePreloadTagAttributes(function ($src, $url) use ($keep) {
            if ($src !== 'fonts') {
                return [];
            }

            return $keep !== null && str_ends_with($url, $keep) ? [] : false;
        });
    }

    private function headingFontFile(): ?string
    {
        $path = public_path('build/fonts-manifest.json');

        if (! is_file($path)) {
            return null;
        }

        $manifest = json_decode((string) file_get_contents($path), true);
        $files = $manifest['families']['fraunces']['variants']['400:normal']['files'] ?? [];

        foreach ($files as $file) {
            // The latin subset is the one whose range starts at U+0000.
            if (($file['format'] ?? null) === 'woff2' && str_starts_with($file['unicodeRange'] ?? '', 'U+0000-00FF')) {
                return basename($file['file']);
            }
        }

        return null;
    }
}
