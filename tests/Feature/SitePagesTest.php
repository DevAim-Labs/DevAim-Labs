<?php

namespace Tests\Feature;

use App\Support\LegacyRedirects;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * Page rendering, redirects, sitemap and error pages for the site layout.
 */
class SitePagesTest extends TestCase
{
    /** Marker that a page was rendered with resources/views/v2/layout.blade.php. */
    private const LAYOUT = '<body class="v2 v2--';

    public function test_home_pages_render_indexable_with_lang_hreflang_and_json_ld(): void
    {
        $nl = url('/');
        $en = url('/en');

        foreach (['/' => ['nl', $nl], '/en' => ['en', $en]] as $path => [$lang, $canonical]) {
            $this->get($path)
                ->assertOk()
                ->assertSee('<html lang="'.$lang.'">', false)
                ->assertSee(self::LAYOUT.'home', false)
                ->assertDontSee('noindex', false)
                ->assertSee('<link rel="canonical" href="'.$canonical.'">', false)
                ->assertSee('<link rel="alternate" hreflang="nl" href="'.$nl.'">', false)
                ->assertSee('<link rel="alternate" hreflang="en" href="'.$en.'">', false)
                ->assertSee('<link rel="alternate" hreflang="x-default" href="'.$nl.'">', false)
                ->assertSee('"@type":"ProfessionalService"', false)
                ->assertSee('"@type":"FAQPage"', false);
        }

        $this->get('/')->assertSee('Prijs op aanvraag')->assertSee(config('site.organization.email'));
        $this->get('/en')->assertSee('Price on request');
    }

    public function test_route_names_point_at_the_home_pages(): void
    {
        $this->assertSame(url('/'), route('home'));
        $this->assertSame(url('/en'), route('home.en'));
        $this->assertSame(url('/contact'), route('contact'));
        $this->assertSame(url('/en/contact'), route('contact.en'));
        $this->assertSame(url('/privacyverklaring'), route('privacy'));
    }

    public function test_v2_preview_urls_redirect_permanently_to_home(): void
    {
        $this->get('/v2')->assertStatus(301)->assertRedirect('/');
        $this->get('/en/v2')->assertStatus(301)->assertRedirect('/en');
    }

    public function test_old_section_urls_redirect_to_the_matching_home_anchor(): void
    {
        $expected = [
            // Dutch sections
            '/over-ons' => '/#over-mij',
            '/diensten' => '/#diensten',
            '/werkwijze' => '/#werkwijze',
            '/tarieven' => '/#tarieven',
            '/klantwerk' => '/#werk',
            '/projecten' => '/#werk',
            '/veelgestelde-vragen' => '/#vragen',
            // Dutch aliases (service-specific ones: ServicePagesTest)
            '/maatwerksoftware' => '/#diensten',
            '/custom-software-ontwikkeling' => '/',
            // Older English-slug redirects, now one hop
            '/about' => '/#over-mij',
            '/services' => '/#diensten',
            '/process' => '/#werkwijze',
            '/work' => '/#werk',
            '/projects' => '/#werk',
            '/faq' => '/#vragen',
            // English sections and aliases
            '/en/about' => '/en#about',
            '/en/services' => '/en#services',
            '/en/process' => '/en#process',
            '/en/pricing' => '/en#pricing',
            '/en/work' => '/en#work',
            '/en/projects' => '/en#work',
            '/en/faq' => '/en#faq',
            '/en/custom-software' => '/en#services',
        ];

        foreach ($expected as $from => $to) {
            $this->get($from)->assertStatus(301)->assertRedirect($to);
        }
    }

    public function test_every_legacy_url_from_the_old_config_is_redirected(): void
    {
        $paths = [];
        foreach (['/' => config('site'), '/en/' => config('site-en')] as $prefix => $site) {
            foreach ($site['sections'] as $section) {
                if ($section['slug'] && $section['slug'] !== 'contact') {
                    $paths[] = $prefix.$section['slug'];
                }
            }
            foreach (array_keys($site['aliases'] ?? []) as $alias) {
                $paths[] = $prefix.$alias;
            }
            foreach (array_keys($site['redirects'] ?? []) as $from) {
                $paths[] = $from;
            }
        }

        foreach ($paths as $path) {
            $this->assertArrayHasKey($path, LegacyRedirects::all(), "{$path} has no redirect");
            $this->get($path)->assertStatus(301);
        }
    }

    public function test_every_redirect_is_a_single_hop_to_an_existing_anchor(): void
    {
        foreach (LegacyRedirects::all() as $from => $to) {
            [$path, $anchor] = array_pad(explode('#', $to, 2), 2, null);

            $page = $this->get($path);
            $page->assertOk(); // no second redirect

            if ($anchor !== null) {
                $page->assertSee('id="'.$anchor.'"', false);
            }
        }
    }

    public function test_contact_pages_render_with_the_site_layout(): void
    {
        foreach (['/contact' => 'nl', '/en/contact' => 'en'] as $path => $lang) {
            $t = config("site-v2.{$lang}");

            $this->get($path)
                ->assertOk()
                ->assertSee('<html lang="'.$lang.'">', false)
                ->assertSee(self::LAYOUT.'contact', false)
                ->assertDontSee('noindex', false)
                ->assertSee('<link rel="canonical" href="'.url($path).'">', false)
                ->assertSee('<link rel="alternate" hreflang="x-default" href="'.url('/contact').'">', false)
                ->assertSee('"@type":"ContactPage"', false)
                ->assertSee('id="contact-form"', false)
                ->assertSee('name="type" value="contact"', false)
                ->assertSee('name="locale" value="'.$lang.'"', false)
                ->assertSee($t['pages']['contact']['heading'])
                ->assertSee($t['contact']['response'])
                ->assertSee(config('site.organization.email'))
                ->assertSee($t['faq']['items'][$t['pages']['contact']['faq_items'][0]]['q']);
        }
    }

    public function test_header_links_resolve_from_inner_pages_and_list_the_service_pages(): void
    {
        $this->get('/contact')
            ->assertSee('href="'.url('/').'/#diensten"', false)
            ->assertSee('href="'.url('/').'/#tarieven"', false)
            ->assertSee('href="'.url('/').'/#website-check"', false)
            ->assertSee('aria-expanded="false" aria-controls="services-menu"', false)
            ->assertSee('aria-current="page"', false)
            ->assertSee('href="/diensten/websites"', false)
            ->assertSee('href="/diensten/adminpanelen"', false)
            ->assertSee('href="/diensten/dashboards"', false)
            ->assertSee('href="/diensten/betalingen"', false)
            ->assertSee('href="/diensten/api-integraties"', false);

        $this->get('/en/contact')
            ->assertSee('href="'.url('/en').'#services"', false)
            ->assertSee('href="/en/services/api-integrations"', false);

        // On home the same links stay in-page anchors.
        $this->get('/')->assertSee('href="#diensten"', false)->assertSee('href="#contact"', false);
    }

    public function test_privacy_page_renders_with_the_site_layout(): void
    {
        $this->get('/privacyverklaring')
            ->assertOk()
            ->assertSee('<html lang="nl">', false)
            ->assertSee(self::LAYOUT.'privacy', false)
            ->assertSee('<link rel="canonical" href="'.url('/privacyverklaring').'">', false)
            ->assertDontSee('rel="alternate" hreflang', false) // Dutch only: no alternates
            ->assertSee('class="legal"', false)
            ->assertSee('Privacyverklaring')
            ->assertSee('Autoriteit Persoonsgegevens');
    }

    public function test_missing_urls_render_the_404_page_in_the_site_layout(): void
    {
        foreach (['/foo' => 'nl', '/en/foo' => 'en'] as $path => $lang) {
            $e = config("site-v2.{$lang}.errors.404");

            $this->get($path)
                ->assertNotFound()
                ->assertSee('<html lang="'.$lang.'">', false)
                ->assertSee(self::LAYOUT.'error', false)
                ->assertSee('<meta name="robots" content="noindex">', false)
                ->assertSee($e['heading'])
                ->assertSee($e['home'])
                ->assertSee($e['services'])
                ->assertSee($e['contact']);
        }

        $this->get('/foo')
            ->assertSee('href="'.url('/').'"', false)
            ->assertSee('href="'.url('/').'/#diensten"', false)
            ->assertSee('href="'.url('/contact').'"', false);
    }

    public function test_500_and_503_pages_render_in_the_site_layout_without_the_nav(): void
    {
        config(['app.debug' => false]);
        Route::get('/_test/boom', fn () => throw new \RuntimeException('boom'));
        Route::get('/en/_test/down', fn () => abort(503));

        $this->get('/_test/boom')
            ->assertStatus(500)
            ->assertSee(self::LAYOUT.'error', false)
            ->assertSee(config('site-v2.nl.errors.500.heading'))
            ->assertDontSee('data-nav-menu', false)
            ->assertDontSee('boom');

        $this->get('/en/_test/down')
            ->assertStatus(503)
            ->assertSee('<html lang="en">', false)
            ->assertSee(config('site-v2.en.errors.503.heading'));
    }

    public function test_sitemap_lists_only_live_urls(): void
    {
        $response = $this->get('/sitemap.xml')->assertOk();
        preg_match_all('#<loc>(.*?)</loc>#', $response->getContent(), $matches);
        $locs = $matches[1];

        foreach (['/', '/en', '/contact', '/en/contact', '/privacyverklaring', '/diensten/websites', '/en/services/websites'] as $path) {
            $this->assertContains(url($path), $locs);
        }

        foreach (array_keys(LegacyRedirects::all()) as $old) {
            $this->assertNotContains(url($old), $locs, "{$old} redirects and must not be in the sitemap");
        }

        foreach ($locs as $loc) {
            $this->get(parse_url($loc, PHP_URL_PATH) ?: '/')->assertOk();
        }
    }

    public function test_robots_and_llms_only_point_at_live_urls(): void
    {
        foreach (['/robots.txt', '/llms.txt'] as $file) {
            $body = $this->get($file)->assertOk()->getContent();
            preg_match_all('#'.preg_quote(url('/'), '#').'[^\s)]*#', $body, $matches);

            foreach ($matches[0] as $link) {
                $this->get(parse_url($link, PHP_URL_PATH) ?: '/')->assertOk();
            }
        }
    }
}
