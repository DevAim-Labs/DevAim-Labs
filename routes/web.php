<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'show'])->name('home');
Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

Route::get('/robots.txt', function () {
    $body = "User-agent: *\nAllow: /\n\nSitemap: ".url('/sitemap.xml')."\n";

    return response($body, 200)->header('Content-Type', 'text/plain; charset=UTF-8');
});

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1');

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
