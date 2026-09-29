<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CrawlerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SitemapController;
use App\Support\LegacyRedirects;
use App\Support\PageRegistry;
use App\Support\ServiceCatalog;
use Illuminate\Support\Facades\Route;

// Pages: paths from App\Support\PageRegistry, view data from App\Support\SitePage.
Route::get(PageRegistry::path('home', 'nl'), [PageController::class, 'home'])->name('home');
Route::get(PageRegistry::path('home', 'en'), [PageController::class, 'home'])->defaults('locale', 'en')->name('home.en');
Route::get(PageRegistry::path('contact', 'nl'), [PageController::class, 'contact'])->name('contact');
Route::get(PageRegistry::path('contact', 'en'), [PageController::class, 'contact'])->defaults('locale', 'en')->name('contact.en');
Route::get(PageRegistry::path('privacy', 'nl'), [PageController::class, 'privacy'])->name('privacy');

// Service detail pages (content: config/site-v2-services.php via ServiceCatalog)
Route::get(PageRegistry::servicePrefix('nl').'/{service}', [PageController::class, 'service'])
    ->where('service', ServiceCatalog::slugPattern('nl'))
    ->name('service.show');
Route::get(PageRegistry::servicePrefix('en').'/{service}', [PageController::class, 'service'])
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
Route::get('/robots.txt', [CrawlerController::class, 'robots'])->middleware('throttle:crawler')->name('robots');
Route::get('/llms.txt', [CrawlerController::class, 'llms'])->middleware('throttle:crawler')->name('llms');

// Lead intake: every site form posts here (to the Dutch contact page path).
Route::post(PageRegistry::path('contact', 'nl'), [ContactController::class, 'store'])
    ->middleware('throttle:contact')
    ->name('lead.submit');
