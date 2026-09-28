<?php

namespace App\Support;

/**
 * Every retired URL of the old one-page site, mapped to its new home in
 * one hop (no redirect chains).
 *
 * Sources, read only: config/site.php and config/site-en.php (section
 * slugs, `aliases`, `redirects`). The old section id is mapped to a home
 * section by config('site-v2.legacy_sections'). Aliases that name one
 * service (e.g. /kpi-dashboard) go to that service page instead, from
 * config('site-v2-services.legacy') via ServiceCatalog. The /v2 preview
 * URLs are included too.
 */
final class LegacyRedirects
{
    /** Paths that are real pages now and must never be redirected. */
    private const LIVE = ['/', '/en', '/contact', '/en/contact'];

    /**
     * @return array<string, string> old path => new path (with #anchor)
     */
    public static function all(): array
    {
        $map = [
            '/v2' => SitePage::sectionPath('nl', null),
            '/en/v2' => SitePage::sectionPath('en', null),
        ];

        foreach (['nl' => config('site', []), 'en' => config('site-en', [])] as $locale => $site) {
            $prefix = $locale === 'en' ? '/en/' : '/';

            foreach ($site['sections'] ?? [] as $id => $section) {
                if (! empty($section['slug'])) {
                    $map[$prefix.$section['slug']] = self::target($locale, $id);
                }
            }

            foreach ($site['aliases'] ?? [] as $alias => $id) {
                $map[$prefix.$alias] = self::target($locale, $id);
            }

            // Older redirects (e.g. /about -> /over-ons) now skip the middle hop.
            foreach ($site['redirects'] ?? [] as $from => $to) {
                $id = collect($site['sections'] ?? [])->search(fn (array $s) => ($s['path'] ?? null) === $to);
                $map[$from] = $id !== false ? self::target($locale, $id) : ($map[$to] ?? $to);
            }
        }

        // A service page beats the generic "/#diensten" anchor.
        foreach (ServiceCatalog::legacyPaths() as $from => $key) {
            $map[$from] = ServiceCatalog::path($key, str_starts_with($from, '/en/') ? 'en' : 'nl');
        }

        return array_diff_key($map, array_flip(self::LIVE));
    }

    private static function target(string $locale, string $oldSectionId): string
    {
        $section = config('site-v2.legacy_sections')[$oldSectionId] ?? null;

        return SitePage::sectionPath($locale, $section);
    }
}
