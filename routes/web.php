<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Support\LegacyRedirects;
use App\Support\ServiceCatalog;
use Illuminate\Support\Facades\Route;

// Pages (view data: App\Support\SitePage)
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/en', [PageController::class, 'home'])->defaults('locale', 'en')->name('home.en');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/en/contact', [PageController::class, 'contact'])->defaults('locale', 'en')->name('contact.en');
Route::get('/privacyverklaring', [PageController::class, 'privacy'])->name('privacy');

// Service detail pages (content: config/site-v2-services.php via ServiceCatalog)
Route::get('/diensten/{service}', [PageController::class, 'service'])
    ->where('service', ServiceCatalog::slugPattern('nl'))
    ->name('service.show');
Route::get('/en/services/{service}', [PageController::class, 'service'])
    ->where('service', ServiceCatalog::slugPattern('en'))
    ->defaults('locale', 'en')
    ->name('service.show.en');

// Old one-page section URLs, their aliases and the /v2 preview: one 301
// hop to the matching service page or home anchor (e.g. /tarieven -> /#tarieven,
// /kpi-dashboard -> /diensten/dashboards).
foreach (LegacyRedirects::all() as $from => $to) {
    Route::permanentRedirect($from, $to);
}

// Rate limiters (web, crawler, contact): see AppServiceProvider.
Route::get('/sitemap.xml', SitemapController::class)->middleware('throttle:crawler')->name('sitemap');

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
})->middleware('throttle:crawler');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact');

Route::get('/llms.txt', function () {
    $org = config('site.organization');
    $company = config('site-v2.company');
    $home = url('/');
    $homeEn = url('/en');
    $contact = url('/contact');
    $contactEn = url('/en/contact');
    $servicePages = collect(ServiceCatalog::keys())
        ->map(fn (string $key) => '- '.config("site-v2-services.services.{$key}.nl.name").': '.ServiceCatalog::url($key, 'nl').' (EN: '.ServiceCatalog::url($key, 'en').')')
        ->implode("\n");
    $body = <<<LLMS
# DevAim Labs
> Custom websites, systemen en integraties

## Over
DevAim Labs bouwt custom websites, systemen en integraties voor particulieren en bedrijven. Direct contact met de developer die bouwt, geen tussenpersoon. Reactie binnen 1 werkdag.

## Diensten
- Maatwerksoftware voor u
- Websites en webshops
- KPI-dashboards en rapportages
- Adminpanelen en interne tools
- Betaalintegraties (Stripe & Mollie)
- API-koppelingen en webhooks

## Pagina's
- Home (NL): {$home}
- Home (EN): {$homeEn}
- Contact (NL): {$contact}
- Contact (EN): {$contactEn}

## Dienstpagina's (met live demo's)
{$servicePages}

## Doelgroep
Particulieren en bedrijven die op zoek zijn naar custom websites, systemen of integraties

## Contact
- Email: {$org['email']}
- Telefoon: {$org['phone']}
- KvK: {$company['kvk']}
- BTW: {$company['btw']}
- Website: https://devaimlabs.com

## Tech Stack
Laravel, Vue.js, React, TypeScript, Inertia.js, REST APIs, Tailwind CSS

## Waarom DevAim Labs
- Direct contact met de developer die bouwt
- Geen tussenpersoon ertussen
- Demo's elke 2 weken tijdens ontwikkeling
- Volledige eigendom van de code
- Onderhoud en doorontwikkeling na oplevering
LLMS;

    return response($body, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
})->middleware('throttle:crawler');
