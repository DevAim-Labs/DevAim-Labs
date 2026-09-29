<?php

use App\Http\Middleware\SecurityHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Global, not in the web group: 404s (no route matched), 419, 429
        // and 500 responses get the security headers too.
        $middleware->append(SecurityHeaders::class);

        // Every page: the generous per-IP "web" limiter (AppServiceProvider).
        $middleware->web(append: ['throttle:web']);

        // Behind a load balancer / CDN (e.g. Cloudflare), list its addresses
        // in TRUSTED_PROXIES (comma separated, or "*" when the app is only
        // reachable through the proxy). Without it, request()->ip() is the
        // proxy's address and every visitor shares one rate-limit bucket.
        if ($proxies = env('TRUSTED_PROXIES')) {
            $middleware->trustProxies(at: $proxies === '*' ? '*' : array_map('trim', explode(',', $proxies)));
        }
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
