<?php

namespace Tests\Feature;

use App\Support\LegacyRedirects;
use App\Support\ServiceCatalog;
use Tests\TestCase;

/**
 * Service detail pages: /diensten/{slug} and /en/services/{slug}.
 */
class ServicePagesTest extends TestCase
{
    /** path => [locale, service key, other-locale path] */
    private const PAGES = [
        '/diensten/websites' => ['nl', 'websites', '/en/services/websites'],
        '/diensten/adminpanelen' => ['nl', 'admin-panels', '/en/services/admin-panels'],
        '/diensten/dashboards' => ['nl', 'dashboards', '/en/services/dashboards'],
        '/diensten/betalingen' => ['nl', 'payments', '/en/services/payments'],
        '/diensten/api-integraties' => ['nl', 'api-integrations', '/en/services/api-integrations'],
        '/en/services/websites' => ['en', 'websites', '/diensten/websites'],
        '/en/services/admin-panels' => ['en', 'admin-panels', '/diensten/adminpanelen'],
        '/en/services/dashboards' => ['en', 'dashboards', '/diensten/dashboards'],
        '/en/services/payments' => ['en', 'payments', '/diensten/betalingen'],
        '/en/services/api-integrations' => ['en', 'api-integrations', '/diensten/api-integraties'],
    ];

    public function test_all_service_pages_render_indexable_with_h1_lang_canonical_and_hreflang(): void
    {
        foreach (self::PAGES as $path => [$lang, $key, $otherPath]) {
            $hero = config("site-v2-services.services.{$key}.{$lang}.hero");
            [$nl, $en] = $lang === 'nl' ? [url($path), url($otherPath)] : [url($otherPath), url($path)];

            $this->get($path)
                ->assertOk()
                ->assertSee('<html lang="'.$lang.'">', false)
                ->assertSee('<body class="v2 v2--service">', false)
                ->assertSee('<h1 class="h1 svc-hero__title" id="page-title">'.e($hero['title']).' <em>'.e($hero['title_em']).'</em></h1>', false)
                ->assertDontSee('noindex', false)
                ->assertSee('<link rel="canonical" href="'.url($path).'">', false)
                ->assertSee('<link rel="alternate" hreflang="nl" href="'.$nl.'">', false)
                ->assertSee('<link rel="alternate" hreflang="en" href="'.$en.'">', false)
                ->assertSee('<link rel="alternate" hreflang="x-default" href="'.$nl.'">', false)
                ->assertSee('"@type":"Service"', false)
                ->assertSee('"@type":"FAQPage"', false)
                ->assertSee('"@type":"BreadcrumbList"', false);
        }
    }

    public function test_route_names_and_catalog_urls_match(): void
    {
        $this->assertSame(url('/diensten/adminpanelen'), route('service.show', 'adminpanelen'));
        $this->assertSame(url('/en/services/admin-panels'), route('service.show.en', 'admin-panels'));

        foreach (self::PAGES as $path => [$lang, $key]) {
            $this->assertSame(url($path), ServiceCatalog::url($key, $lang));
        }

        $this->get('/diensten/admin-panels')->assertNotFound();
        $this->get('/en/services/adminpanelen')->assertNotFound();
    }

    public function test_demo_pages_ship_a_click_to_load_facade_without_an_iframe(): void
    {
        foreach (self::PAGES as $path => [$lang, $key]) {
            $demo = config("site-v2-services.services.{$key}.demo");
            if ($demo === null) {
                continue;
            }
            $label = config("site-v2-services.ui.{$lang}.demo.badge");

            $html = $this->get($path)
                ->assertOk()
                ->assertSee('data-demo', false)
                ->assertSee('data-src="'.$demo['src'].'?embed=1"', false)
                ->assertSee('data-demo-start', false)
                ->assertSee('href="#after-demo"', false)
                ->assertSee('src="'.asset(ltrim($demo['image'], '/')).'"', false)
                ->assertSee('href="'.$demo['src'].'" class="btn btn-sm btn-tech svc-demo__open" target="_blank"', false)
                ->assertSee($label)
                ->getContent();

            $this->assertStringNotContainsString('<iframe', $html, "{$path} must not ship an iframe");
            $this->assertStringNotContainsString('allow-same-origin', $html);
        }
    }

    public function test_api_page_has_the_flow_diagram_and_no_demo(): void
    {
        foreach (['/diensten/api-integraties' => 'nl', '/en/services/api-integrations' => 'en'] as $path => $lang) {
            $flow = config("site-v2-services.services.api-integrations.{$lang}.flow");

            $html = $this->get($path)
                ->assertOk()
                ->assertSee('data-flow', false)
                ->assertSee('role="img" aria-label="'.e($flow['diagram_label']).'"', false)
                ->assertSee('data-flow-toggle', false)
                ->assertSee('data-flow-log', false)
                ->assertSee($flow['status']['retry'])
                ->assertSee(config("site-v2-services.ui.{$lang}.flow.badge"))
                ->getContent();

            $this->assertStringNotContainsString('<iframe', $html);
            $this->assertStringNotContainsString('data-demo-start', $html);
        }
    }

    public function test_page_has_one_contact_form_with_the_project_type_preselected(): void
    {
        foreach (self::PAGES as $path => [$lang, $key]) {
            $type = config("site-v2-services.services.{$key}.project_type");
            $html = $this->get($path)->assertOk()->getContent();

            $this->assertSame(1, substr_count($html, '<form '), "{$path} must have exactly one form");
            $this->assertStringContainsString('name="locale" value="'.$lang.'"', $html);
            $this->assertMatchesRegularExpression('#<option value="'.preg_quote($type, '#').'"\s+selected#', $html);
        }
    }

    public function test_price_on_request_when_the_pricing_config_has_no_price(): void
    {
        config(['site-v2.nl.pricing.packages.0.price_from' => null]);
        $this->get('/diensten/websites')->assertSee('Prijs op aanvraag')->assertDontSee('"minPrice"', false);

        config(['site-v2.nl.pricing.packages.0.price_from' => 1500]);
        $this->get('/diensten/websites')->assertSee('€ 1.500')->assertSee('"minPrice":1500', false);
    }

    public function test_real_cases_only_on_the_websites_page(): void
    {
        $this->get('/diensten/websites')->assertSee('Lokanta Proeflokaal')->assertSee('Slowdown Store');
        $this->get('/diensten/dashboards')->assertDontSee('Lokanta Proeflokaal');
    }

    public function test_related_services_link_to_other_service_pages(): void
    {
        $this->get('/diensten/dashboards')
            ->assertSee('href="/diensten/adminpanelen" class="link-arrow card-link"', false)
            ->assertSee('href="/diensten/api-integraties" class="link-arrow card-link"', false);
    }

    public function test_menus_footer_and_home_cards_link_to_the_service_pages(): void
    {
        // Header menu marks the current service; the footer lists all five.
        $html = $this->get('/diensten/betalingen')->assertOk()->getContent();
        $this->assertMatchesRegularExpression('#href="/diensten/betalingen" class="nav-menu__link"\s+aria-current="page"#', $html);
        $this->assertStringContainsString('id="footer-services-title"', $html);
        $this->assertSame(1, preg_match_all('#class="nav-menu__link"\s+aria-current="page"#', $html));

        foreach (array_keys(self::PAGES) as $path) {
            $this->get(str_starts_with($path, '/en/') ? '/en' : '/')->assertSee('href="'.$path.'"', false);
        }
    }

    public function test_service_aliases_redirect_in_one_hop_to_the_service_page(): void
    {
        $expected = [
            '/adminpaneel-laravel-vue' => '/diensten/adminpanelen',
            '/adminpaneel' => '/diensten/adminpanelen',
            '/kpi-dashboard' => '/diensten/dashboards',
            '/stripe-mollie-integratie' => '/diensten/betalingen',
            '/betaalintegratie' => '/diensten/betalingen',
            '/api-koppelingen' => '/diensten/api-integraties',
            '/landingspagina' => '/diensten/websites',
            '/en/admin-panel' => '/en/services/admin-panels',
            '/en/dashboard' => '/en/services/dashboards',
        ];

        foreach ($expected as $from => $to) {
            $this->assertSame($to, LegacyRedirects::all()[$from] ?? null, "{$from} is not mapped");
            $this->get($from)->assertStatus(301)->assertRedirect($to);
            $this->get($to)->assertOk(); // single hop
        }
    }
}
