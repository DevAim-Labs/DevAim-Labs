<?php

namespace Tests\Feature;

use App\Support\PageRegistry;
use Tests\TestCase;

/**
 * Markup rules every page of the site must keep: one h1 and the landmarks,
 * a CSP nonce on every inline script, valid JSON-LD and safe external
 * links. Reciprocal hreflang: PageRegistryTest.
 */
class PageMarkupTest extends TestCase
{
    /** @return list<string> every Page path (PageRegistry) */
    private function paths(): array
    {
        return PageRegistry::livePaths();
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

    public function test_json_ld_has_no_price_less_offer_and_every_page_carries_the_business(): void
    {
        $orgId = url('/').'#organization';

        foreach ($this->paths() as $path) {
            preg_match('#<script type="application/ld\+json">(.*?)</script>#s', $this->get($path)->getContent(), $block);
            $data = json_decode($block[1], true, flags: JSON_THROW_ON_ERROR);

            // Anywhere in the graph: an Offer must carry a real price.
            $this->assertNoPriceLessOffer($data, $path);

            $org = collect($data['@graph'])->firstWhere('@id', $orgId);
            $this->assertNotNull($org, "{$path}: the business node referenced by provider/about/publisher is on the page");
            $this->assertSame('ProfessionalService', $org['@type']);
            $this->assertSame(config('site.organization.phone'), $org['telephone'], "{$path}: NAP phone");
            $this->assertSame(config('site.organization.email'), $org['email'], "{$path}: NAP email");
            $this->assertSame(['@type' => 'PropertyValue', 'propertyID' => 'KvK', 'value' => config('site-v2.company.kvk')], $org['identifier']);
            $this->assertArrayNotHasKey('aggregateRating', $org);
        }
    }

    public function test_titles_and_descriptions_are_unique_and_fit_the_serp(): void
    {
        $titles = $descriptions = [];

        foreach ($this->paths() as $path) {
            $html = $this->get($path)->getContent();
            preg_match('#<title>(.*?)</title>#s', $html, $title);
            preg_match('#<meta name="description" content="([^"]*)">#', $html, $description);

            $title = html_entity_decode($title[1]);
            $description = html_entity_decode($description[1] ?? '');

            $this->assertLessThanOrEqual(62, mb_strlen($title), "{$path}: title too long: {$title}");
            $this->assertGreaterThanOrEqual(100, mb_strlen($description), "{$path}: description too short");
            $this->assertLessThanOrEqual(160, mb_strlen($description), "{$path}: description too long: {$description}");
            $this->assertStringContainsString('<meta property="og:image" content="'.asset('og-image.png').'">', $html, "{$path}: absolute og:image");

            $titles[$path] = $title;
            $descriptions[$path] = $description;
        }

        $this->assertSame($titles, array_unique($titles), 'every page has its own title');
        $this->assertSame($descriptions, array_unique($descriptions), 'every page has its own description');
    }

    public function test_reveal_content_is_visible_in_the_server_rendered_html(): void
    {
        // The pending (hidden) state is set by motion.js only; crawlers without JS see everything.
        foreach ($this->paths() as $path) {
            $this->assertStringNotContainsString('data-reveal-state', $this->get($path)->getContent(), "{$path}: reveal state in the HTML");
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

    private function assertNoPriceLessOffer(array $node, string $path): void
    {
        if (($node['@type'] ?? null) === 'Offer') {
            $price = $node['price'] ?? $node['priceSpecification']['minPrice'] ?? $node['priceSpecification']['price'] ?? null;
            $this->assertNotNull($price, "{$path}: Offer without a price");
        }

        foreach ($node as $child) {
            if (is_array($child)) {
                $this->assertNoPriceLessOffer($child, $path);
            }
        }
    }
}
