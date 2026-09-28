<?php

namespace Tests\Feature;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

/**
 * SecurityHeaders is global middleware: pages, error pages (404, 429)
 * and plain-text routes all carry the headers.
 */
class SecurityHeadersTest extends TestCase
{
    private function assertSecurityHeaders(TestResponse $response, string $csp = 'Content-Security-Policy-Report-Only'): void
    {
        $response
            ->assertHeader('X-Content-Type-Options', 'nosniff')
            ->assertHeader('X-Frame-Options', 'SAMEORIGIN')
            ->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');

        $permissions = (string) $response->headers->get('Permissions-Policy');
        foreach (['camera=()', 'microphone=()', 'geolocation=()', 'payment=()', 'usb=()', 'interest-cohort=()'] as $feature) {
            $this->assertStringContainsString($feature, $permissions);
        }

        $policy = (string) $response->headers->get($csp);
        foreach (["default-src 'self'", "frame-src 'self'", "frame-ancestors 'self'", "form-action 'self'", "base-uri 'self'", "object-src 'none'", "'nonce-"] as $directive) {
            $this->assertStringContainsString($directive, $policy, "{$csp} lacks {$directive}");
        }
        $this->assertDoesNotMatchRegularExpression("/script-src[^;]*'unsafe-inline'/", $policy);
    }

    public function test_pages_get_the_headers(): void
    {
        $this->assertSecurityHeaders($this->get('/')->assertOk());
        $this->assertSecurityHeaders($this->get('/robots.txt')->assertOk());
    }

    public function test_not_found_pages_get_the_headers(): void
    {
        $this->assertSecurityHeaders($this->get('/does-not-exist')->assertNotFound());
        $this->assertSecurityHeaders($this->get('/en/does-not-exist')->assertNotFound());
    }

    public function test_throttled_responses_get_the_headers(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->postJson('/contact', ['email' => "x{$i}"]);
        }

        $this->assertSecurityHeaders($this->postJson('/contact', ['email' => 'x9'])->assertStatus(429));
    }

    public function test_page_nonce_matches_the_policy(): void
    {
        $response = $this->get('/');
        preg_match("/'nonce-([^']+)'/", (string) $response->headers->get('Content-Security-Policy-Report-Only'), $match);

        $this->assertNotEmpty($match[1] ?? null);
        $this->assertStringContainsString('nonce="'.$match[1].'"', $response->getContent());
    }

    public function test_production_enforces_the_policy(): void
    {
        $this->app['env'] = 'production';

        $response = $this->get('https://localhost/');

        $this->assertSecurityHeaders($response, 'Content-Security-Policy');
        $this->assertFalse($response->headers->has('Content-Security-Policy-Report-Only'));
        $this->assertStringContainsString('upgrade-insecure-requests', (string) $response->headers->get('Content-Security-Policy'));
        $response
            ->assertHeader('Strict-Transport-Security', 'max-age=31536000; includeSubDomains')
            ->assertHeader('Cross-Origin-Opener-Policy', 'same-origin');
    }

    public function test_hsts_only_over_https(): void
    {
        $this->assertFalse($this->get('/')->headers->has('Strict-Transport-Security'));
    }

    public function test_pages_are_rate_limited(): void
    {
        for ($i = 0; $i < 30; $i++) {
            $this->get('/robots.txt')->assertOk();
        }

        $this->assertSecurityHeaders($this->get('/robots.txt')->assertStatus(429));
    }
}
