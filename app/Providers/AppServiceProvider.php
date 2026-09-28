<?php

namespace App\Providers;

use App\Support\SitePage;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Anonymous components for the site views: <x-v2::icon />, etc.
        Blade::anonymousComponentPath(resource_path('views/v2/components'), 'v2');

        // Error pages render without a controller: give them the layout data
        // (locale from the "/en" path prefix, strings from config('site-v2')).
        foreach ([404, 500, 503] as $status) {
            View::composer(["errors::{$status}", "errors.{$status}"], function ($view) use ($status) {
                $view->with(SitePage::error(request(), $status));
            });
        }

        $this->configureRateLimiting();
    }

    /**
     * Named rate limiters (used as throttle:<name> in bootstrap/app.php
     * and routes/web.php). Keys are per client IP, so behind a proxy or
     * CDN set TRUSTED_PROXIES, or every visitor shares one bucket.
     *
     * - web:     every page, generous; stops scrapers hammering PHP.
     *            Static files (/build, /demo, images) never reach PHP.
     * - crawler: sitemap.xml, robots.txt, llms.txt.
     * - contact: POST /contact, per IP, per e-mail address and, for the
     *            website check, per checked site. Answers a JSON 429 with
     *            Retry-After; the form shows its own "too many attempts" text.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('web', fn (Request $request) => Limit::perMinute(120)->by($request->ip()));

        RateLimiter::for('crawler', fn (Request $request) => Limit::perMinute(30)->by($request->ip()));

        RateLimiter::for('contact', function (Request $request) {
            $tooMany = fn (Request $request, array $headers) => response()->json([
                'message' => $request->input('locale') === 'en'
                    ? 'Too many attempts. Please try again later.'
                    : 'Te veel pogingen. Probeer het later opnieuw.',
            ], 429, $headers);

            // Each limit needs its own key: limits that share a key share one counter.
            $limits = [
                Limit::perMinute(5)->by('ip-minute:'.$request->ip()),
                Limit::perDay(20)->by('ip-day:'.$request->ip()),
            ];

            $email = $request->input('email');

            if (is_string($email) && trim($email) !== '') {
                // Hashed: the cache holds no readable addresses.
                $limits[] = Limit::perHour(3)->by('email:'.hash('sha256', Str::lower(trim($email))));
            }

            if ($host = self::scanHost($request)) {
                $limits[] = Limit::perDay(3)->by('scan-host:'.$host);
            }

            return array_map(fn (Limit $limit) => $limit->response($tooMany), $limits);
        });
    }

    /** Host of the site a website-check asks about, without "www.", or null. */
    private static function scanHost(Request $request): ?string
    {
        $url = $request->input('scan_url');

        if ($request->input('type') !== 'website_check' || ! is_string($url) || trim($url) === '') {
            return null;
        }

        $url = trim($url);
        $host = parse_url(str_contains($url, '://') ? $url : 'https://'.$url, PHP_URL_HOST);

        return is_string($host) && $host !== '' ? preg_replace('/^www\./', '', Str::lower($host)) : null;
    }
}
