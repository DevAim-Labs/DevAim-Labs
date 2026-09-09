<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::get('/robots.txt', function () {
    $sitemapUrl = url('/sitemap.xml');
    $body = <<<ROBOTS
User-agent: *
Allow: /
Disallow: /demo/

# AI Crawlers - Explicitly allowed for GEO visibility
User-agent: GPTBot
Allow: /

User-agent: ChatGPT-User
Allow: /

User-agent: ClaudeBot
Allow: /

User-agent: Anthropic-AI
Allow: /

User-agent: Google-Extended
Allow: /

User-agent: PerplexityBot
Allow: /

User-agent: Applebot-Extended
Allow: /

Sitemap: {$sitemapUrl}
ROBOTS;

    return response($body, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
});

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1');

Route::get('/llms.txt', function () {
    $org = config('site.organization');
    $body = <<<LLMS
# DevAim Labs
> Custom websites, systemen en integraties

## Over
DevAim Labs bouwt custom websites, systemen en integraties voor particulieren en bedrijven. Direct contact met de developers die bouwen, geen account managers. Reactie binnen 24 uur.

## Diensten
- Maatwerksoftware op maat
- Websites en portfolio's
- KPI-dashboards en rapportages
- Adminpanelen en interne tools
- Betaalintegraties (Stripe & Mollie)
- API-koppelingen en webhooks

## Doelgroep
Particulieren en bedrijven die op zoek zijn naar custom websites, systemen of integraties

## Contact
- Email: {$org['email']}
- Telefoon: {$org['phone']}
- KvK: 42051464
- BTW: NL005458933B79
- Website: https://devaimlabs.com

## Tech Stack
Laravel, Vue.js, React, TypeScript, Inertia.js, REST APIs, Tailwind CSS

## Waarom DevAim Labs
- Direct contact met de developers die bouwen
- Geen account managers ertussen
- Demo's elke 2 weken tijdens ontwikkeling
- Volledige eigendom van de code
- Onderhoud en doorontwikkeling na oplevering
LLMS;

    return response($body, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
});

Route::view('/privacyverklaring', 'privacy', [
    'pageTitle' => 'Privacyverklaring — DevAim Labs',
    'pageDescription' => 'Hoe DevAim Labs omgaat met persoonsgegevens: welke gegevens we verwerken, waarom, hoe lang we ze bewaren en welke rechten je hebt.',
    'canonicalUrl' => url('/privacyverklaring'),
    'breadcrumbs' => [
        ['name' => 'Home', 'path' => '/'],
        ['name' => 'Privacyverklaring', 'path' => '/privacyverklaring'],
    ],
])->name('privacy');

foreach (config('site.redirects', []) as $from => $to) {
    Route::redirect($from, $to, 301);
}

$config = config('site');
$routeSlugs = collect($config['sections'])
    ->pluck('slug')
    ->filter()
    ->merge(array_keys($config['aliases']))
    ->unique()
    ->implode('|');

Route::get('/{section}', [HomeController::class, 'show'])
    ->where('section', $routeSlugs);
