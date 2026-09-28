<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Support\ClientCases;
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
    // A crawler obeys only the most specific group that names it, so every
    // group repeats the /demo/ rule (the demos are fictional businesses).
    // Search/answer bots (OAI-SearchBot, Claude-SearchBot, PerplexityBot, ...)
    // are what makes the site citable in AI search.
    $agents = [
        '*', 'Googlebot', 'Bingbot',
        'OAI-SearchBot', 'ChatGPT-User', 'GPTBot',
        'Claude-SearchBot', 'Claude-User', 'ClaudeBot',
        'PerplexityBot', 'Perplexity-User',
        'Google-Extended', 'Applebot-Extended',
    ];
    $groups = implode("\n\n", array_map(fn (string $agent) => "User-agent: {$agent}\nAllow: /\nDisallow: /demo/", $agents));
    $body = $groups."\n\nSitemap: ".url('/sitemap.xml')."\n";

    return response($body, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
})->middleware('throttle:crawler');

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:contact');

Route::get('/llms.txt', function () {
    // Built from the same config as the pages, so it never claims more than
    // the site does (llms.txt is optional; search engines do not rank on it).
    $org = config('site.organization');
    $company = config('site-v2.company');
    $nl = config('site-v2.nl');
    $services = collect(ServiceCatalog::keys())
        ->map(fn (string $key) => sprintf(
            '- [%s](%s): %s (English: %s)',
            config("site-v2-services.services.{$key}.nl.name"),
            ServiceCatalog::url($key, 'nl'),
            config("site-v2-services.services.{$key}.nl.summary"),
            ServiceCatalog::url($key, 'en'),
        ))
        ->implode("\n");
    $cases = collect(ClientCases::all('nl'))
        ->map(fn (array $case) => "- {$case['name']} ({$case['url']})")
        ->implode("\n");
    [$home, $homeEn, $contact, $contactEn, $privacy] = array_map('url', ['/', '/en', '/contact', '/en/contact', '/privacyverklaring']);
    $about = implode(' ', $nl['about']['paragraphs']);
    $stack = implode(', ', $nl['about']['stack']);
    $steps = collect($nl['process']['steps'])->map(fn (array $step) => "- {$step['title']}: {$step['text']}")->implode("\n");

    $body = <<<LLMS
# {$org['name']}

> {$nl['meta']['description']}

{$about}

Taal: Nederlands (standaard) en Engels (/en). Prijzen: vaste prijs vooraf, op aanvraag na een gratis kennismaking.

## Diensten
{$services}

## Werkwijze
{$steps}

## Recent werk (echte klanten)
{$cases}

## Pagina's
- [Home]({$home}): overzicht, werk, werkwijze, tarieven en veelgestelde vragen (English: {$homeEn})
- [Contact]({$contact}): formulier, e-mail en telefoon (English: {$contactEn})
- [Privacyverklaring]({$privacy})

## Techniek
{$stack}

## Bedrijfsgegevens
- E-mail: {$org['email']}
- Telefoon: {$org['phone']}
- KvK: {$company['kvk']}
- BTW: {$company['btw']}
LLMS;

    return response($body."\n", 200)->header('Content-Type', 'text/plain; charset=UTF-8');
})->middleware('throttle:crawler');
