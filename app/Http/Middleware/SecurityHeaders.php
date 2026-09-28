<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;
use Symfony\Component\HttpFoundation\Response;

/**
 * Security headers on every response the app sends, error pages included
 * (registered as global middleware in bootstrap/app.php).
 *
 * The CSP allows inline scripts only with the per-request nonce (shared
 * with the views as $cspNonce and with Vite's tags). Production enforces
 * it; every other environment sends it as Content-Security-Policy-Report-Only
 * with the Vite dev server added, so violations show in the console
 * without breaking hot reload.
 *
 * Static files (/build, /demo, images) never pass through here: their
 * headers come from the web server, see deploy/ and public/.htaccess.
 */
class SecurityHeaders
{
    private const PERMISSIONS_POLICY = 'accelerometer=(), autoplay=(), bluetooth=(), camera=(), display-capture=(), '
        .'geolocation=(), gyroscope=(), hid=(), magnetometer=(), microphone=(), midi=(), payment=(), '
        .'serial=(), usb=(), browsing-topics=(), interest-cohort=()';

    public function handle(Request $request, Closure $next): Response
    {
        $nonce = base64_encode(random_bytes(16));
        Vite::useCspNonce($nonce);
        view()->share('cspNonce', $nonce);

        /** @var Response $response */
        $response = $next($request);
        $headers = $response->headers;

        $enforce = app()->isProduction();
        $headers->set(
            $enforce ? 'Content-Security-Policy' : 'Content-Security-Policy-Report-Only',
            self::contentSecurityPolicy($nonce, $enforce),
        );

        $headers->set('X-Frame-Options', 'SAMEORIGIN');
        $headers->set('X-Content-Type-Options', 'nosniff');
        $headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $headers->set('Permissions-Policy', self::PERMISSIONS_POLICY);

        // HTTPS only: on http://localhost browsers ignore HSTS and warn about COOP.
        if ($request->secure()) {
            $headers->set('Cross-Origin-Opener-Policy', 'same-origin');
            $headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        return $response;
    }

    /** Outside production the Vite dev server (when running) is allowed too. */
    private static function contentSecurityPolicy(string $nonce, bool $enforce): string
    {
        $devServer = $enforce ? null : self::viteDevServer();
        $dev = $devServer === null ? '' : ' '.$devServer;
        $devSocket = $devServer === null ? '' : ' '.preg_replace('#^http#', 'ws', $devServer);

        return implode('; ', array_filter([
            "default-src 'self'",
            "script-src 'self' 'nonce-{$nonce}'{$dev}",
            // Inline style attributes (theme colours, progress widths).
            "style-src 'self' 'unsafe-inline'{$dev}",
            "img-src 'self' data:{$dev}",
            "font-src 'self'{$dev}",
            "connect-src 'self'{$dev}{$devSocket}",
            // The service-page demos: same-origin /demo/*.html in a sandboxed iframe.
            "frame-src 'self'",
            "frame-ancestors 'self'",
            "base-uri 'self'",
            "form-action 'self'",
            "object-src 'none'",
            // Not valid in a report-only policy.
            $enforce ? 'upgrade-insecure-requests' : null,
        ]));
    }

    /** Origin of the running Vite dev server (from public/hot), or null. */
    private static function viteDevServer(): ?string
    {
        if (! Vite::isRunningHot()) {
            return null;
        }

        $url = trim((string) @file_get_contents(Vite::hotFile()));

        return preg_match('#^https?://[^/\s]+#', $url, $match) ? $match[0] : null;
    }
}
