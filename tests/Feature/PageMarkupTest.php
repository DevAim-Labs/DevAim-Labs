<?php

namespace Tests\Feature;

use App\Support\ServiceCatalog;
use App\Support\SitePage;
use Tests\TestCase;

/**
 * Markup rules every page of the site must keep: one h1 and the landmarks,
 * a CSP nonce on every inline script, valid JSON-LD, reciprocal hreflang
 * and safe external links.
 */
class PageMarkupTest extends TestCase
{
    /** @return list<string> every indexable page path */
    private function paths(): array
    {
        $paths = ['/', '/en', '/contact', '/en/contact', '/privacyverklaring'];

        foreach (ServiceCatalog::keys() as $key) {
            foreach (SitePage::LOCALES as $locale) {
                $paths[] = ServiceCatalog::path($key, $locale);
            }
        }

        return $paths;
    }

    public function test_every_page_has_one_h1_the_landmarks_and_a_working_skip_link(): void
    {
        foreach ([...$this->paths(), '/does-not-exist'] as $path) {
            $html = $this->get($path)->getContent();

            $this->assertSame(1, substr_count($html, '<h1'), "{$path}: exactly one h1");
            $this->assertSame(1, substr_count($html, '<main id="main"'), "{$path}: one main");
            $this->assertStringContainsString('<a href="#main" class="skip-link">', $html, "{$path}: skip link");
            $this->assertStringContainsString('<header class="site-header"', $html, "{$path}: banner");
            $this->assertStringContainsString('<footer class="site-footer', $html, "{$path}: contentinfo");
        }
    }

    public function test_every_inline_script_carries_the_csp_nonce(): void
    {
        foreach ($this->paths() as $path) {
            preg_match_all('#<script\b([^>]*)>#i', $this->get($path)->getContent(), $tags);

            foreach ($tags[1] as $attributes) {
                if (str_contains($attributes, 'application/ld+json')) {
                    continue; // data, not executed: CSP does not apply
                }

                $this->assertMatchesRegularExpression('#\snonce="[^"]+"#', $attributes, "{$path}: <script{$attributes}> has no nonce");
            }
        }
    }

    public function test_json_ld_is_valid_with_ordered_breadcrumbs_and_no_empty_offers(): void
    {
        foreach ($this->paths() as $path) {
            $html = $this->get($path)->getContent();
            $this->assertSame(1, preg_match_all('#<script type="application/ld\+json">(.*?)</script>#s', $html, $blocks), "{$path}: one JSON-LD block");

            $data = json_decode($blocks[1][0], true, flags: JSON_THROW_ON_ERROR);
            $this->assertSame('https://schema.org', $data['@context']);

            foreach ($data['@graph'] as $node) {
                if ($node['@type'] === 'BreadcrumbList') {
                    $this->assertSame(range(1, count($node['itemListElement'])), array_column($node['itemListElement'], 'position'), "{$path}: breadcrumb positions");
                    $this->assertSame(url($path === '/' ? '/' : $path), end($node['itemListElement'])['item'], "{$path}: last crumb is the page");
                }

                if (isset($node['offers'])) {
                    $this->assertIsInt($node['offers']['priceSpecification']['minPrice'], "{$path}: Offer without a price");
                }
            }
        }
    }

    public function test_hreflang_alternates_are_reciprocal(): void
    {
        foreach ($this->paths() as $path) {
            $alternates = $this->alternates($path);

            foreach ($alternates as $lang => $href) {
                $this->assertSame($alternates, $this->alternates(parse_url($href, PHP_URL_PATH) ?: '/'), "{$path}: {$lang} alternate does not link back");
            }
        }
    }

    public function test_external_links_open_safely(): void
    {
        foreach ($this->paths() as $path) {
            preg_match_all('#<a\b[^>]*target="_blank"[^>]*>#', $this->get($path)->getContent(), $links);

            foreach ($links[0] as $link) {
                $this->assertStringContainsString('rel="noopener noreferrer"', $link, "{$path}: {$link}");
            }
        }
    }

    /** @return array<string, string> hreflang => href */
    private function alternates(string $path): array
    {
        preg_match_all('#<link rel="alternate" hreflang="([^"]+)" href="([^"]+)">#', $this->get($path)->getContent(), $m);

        return array_combine($m[1], $m[2]);
    }
}
