<?php

namespace App\Providers;

use App\Support\LeadIntake;
use App\Support\SitePage;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
     *            website check, per checked site (keys and limits: LeadIntake).
     *            Answers a JSON 429 with Retry-After; the form shows its own
     *            "too many attempts" text.
     */
    private function configureRateLimiting(): void
    {
        RateLimiter::for('web', fn (Request $request) => Limit::perMinute(120)->by($request->ip()));

        RateLimiter::for('crawler', fn (Request $request) => Limit::perMinute(30)->by($request->ip()));

        RateLimiter::for('contact', fn (Request $request) => LeadIntake::limits($request->all(), $request->ip()));
    }
}
