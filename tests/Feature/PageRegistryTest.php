<?php

namespace Tests\Feature;

use App\Support\LegacyRedirects;
use App\Support\PageRegistry;
use App\Support\ServiceCatalog;
use Tests\TestCase;

/**
 * The page registry is the one list of live Pages: every URL it names
 * answers 200 with its own hreflang set, and the sitemap, llms.txt and the
 * redirects agree with it.
 */
class PageRegistryTest extends TestCase
{
    public function test_every_page_has_reciprocal_alternates(): void
    {
        foreach (PageRegistry::pages() as $page) {
            $alternates = PageRegistry::alternates($page);

            $locales = PageRegistry::locales($page);
            $this->assertSame(count($locales) > 1 ? $locales : [], array_keys($alternates), "{$page}: one alternate per locale");

            foreach ($alternates as $locale => $href) {
                $this->assertSame(PageRegistry::url($page, $locale), $href, "{$page}/{$locale}");
            }

            // Every alternate is itself a page whose alternates are this same set.
            foreach ($alternates as $href) {
                $other = $this->pageAt($href);
                $this->assertSame($alternates, PageRegistry::alternates($other), "{$page}: {$href} does not link back");
            }
        }
    }

    public function test_every_registry_url_answers_200_with_its_canonical_and_hreflang(): void
    {
        foreach (PageRegistry::sitemap() as $entry) {
            $html = $this->get(PageRegistry::path($entry['page'], $entry['locale']))->assertOk()->getContent();

            $this->assertStringContainsString('<link rel="canonical" href="'.$entry['loc'].'">', $html, $entry['loc']);

            preg_match_all('#<link rel="alternate" hreflang="([^"]+)" href="([^"]+)">#', $html, $m);
            $this->assertSame($entry['alternates'], array_combine($m[1], $m[2]), "{$entry['loc']}: rendered hreflang");
        }
    }

    public function test_sitemap_equals_the_registry(): void
    {
        $xml = simplexml_load_string($this->get('/sitemap.xml')->assertOk()->getContent());
        $urls = [];

        foreach ($xml->url as $url) {
            $alternates = [];
            foreach ($url->children('http://www.w3.org/1999/xhtml')->link as $link) {
                $alternates[(string) $link->attributes()->hreflang] = (string) $link->attributes()->href;
            }
            $urls[] = [(string) $url->loc, (string) $url->lastmod, (string) $url->changefreq, (string) $url->priority, $alternates];
        }

        $expected = array_map(
            fn (array $e) => [$e['loc'], $e['lastmod'], $e['changefreq'], $e['priority'], $e['alternates']],
            PageRegistry::sitemap(),
        );

        $this->assertSame($expected, $urls);
    }

    public function test_llms_txt_lists_every_page_and_no_other_site_url(): void
    {
        $body = $this->get('/llms.txt')->assertOk()->getContent();
        $live = array_map('url', PageRegistry::livePaths());

        foreach ($live as $url) {
            $this->assertMatchesRegularExpression('#[(\s]'.preg_quote($url, '#').'[)\s]#', $body, "{$url} missing from llms.txt");
        }

        preg_match_all('#'.preg_quote(url('/'), '#').'[^\s)]*#', $body, $links);
        foreach ($links[0] as $link) {
            $this->assertContains($link, $live, "llms.txt links to {$link}, which is not a Page");
        }
    }

    public function test_robots_points_at_the_sitemap(): void
    {
        $this->get('/robots.txt')->assertOk()->assertSee('Sitemap: '.route('sitemap'));
    }

    public function test_privacy_is_dutch_only(): void
    {
        $this->assertSame(['nl'], PageRegistry::locales('privacy'));
        $this->assertSame([], PageRegistry::alternates('privacy'));
        // From an English page the link still goes to the Dutch statement.
        $this->assertSame(url('/privacyverklaring'), PageRegistry::url('privacy', 'en'));
    }

    public function test_service_pages_come_from_the_catalog_in_every_locale(): void
    {
        foreach (ServiceCatalog::keys() as $key) {
            $page = PageRegistry::service($key);

            $this->assertContains($page, PageRegistry::pages());
            $this->assertSame(PageRegistry::LOCALES, PageRegistry::locales($page));
            $this->assertSame($key, PageRegistry::serviceKey($page));
        }
    }

    public function test_no_live_path_is_redirected(): void
    {
        $this->assertSame([], array_intersect(PageRegistry::livePaths(), array_keys(LegacyRedirects::all())));
    }

    private function pageAt(string $url): string
    {
        foreach (PageRegistry::pages() as $page) {
            foreach (PageRegistry::locales($page) as $locale) {
                if (PageRegistry::url($page, $locale) === $url) {
                    return $page;
                }
            }
        }

        $this->fail("{$url} is not a Page");
    }
}
