<?php

namespace App\Support;

use Illuminate\Foundation\Vite;

/**
 * The <head> asset tags (fonts + CSS + JS) for the site layout.
 *
 * Never throws: a missing Vite manifest or fonts manifest yields fewer
 * tags, not an exception, so the 500 and 503 pages always render.
 */
final class SiteAssets
{
    private const ENTRIES = ['resources/css/v2.css', 'resources/js/v2/main.js'];

    private const FONTS = ['inter', 'fraunces', 'jetbrains-mono'];

    public static function headTags(): string
    {
        $vite = app(Vite::class);
        $html = '';

        try {
            self::limitFontPreloads($vite);
            $html .= $vite->fonts(self::FONTS)->toHtml();
        } catch (\Throwable) {
            // Fonts are progressive enhancement: the fallback stacks apply.
        }

        try {
            $html .= $vite(self::ENTRIES)->toHtml();
        } catch (\Throwable) {
            // No build and no dev server: the page still renders, unstyled.
        }

        return $html;
    }

    /**
     * The fonts plugin preloads every woff2 of every family it renders
     * (all weights, all unicode subsets). Only the latin Fraunces 400
     * file (the H1 face) is worth a preload; the rest load on demand
     * through their @font-face rules.
     */
    private static function limitFontPreloads(Vite $vite): void
    {
        $keep = self::headingFontFile();

        $vite->usePreloadTagAttributes(function ($src, $url) use ($keep) {
            if ($src !== 'fonts') {
                return [];
            }

            return $keep !== null && str_ends_with($url, $keep) ? [] : false;
        });
    }

    private static function headingFontFile(): ?string
    {
        $path = public_path('build/fonts-manifest.json');

        if (! is_file($path)) {
            return null;
        }

        $manifest = json_decode((string) file_get_contents($path), true);
        $files = $manifest['families']['fraunces']['variants']['400:normal']['files'] ?? [];

        foreach ($files as $file) {
            // The latin subset is the one whose range starts at U+0000.
            if (($file['format'] ?? null) === 'woff2' && str_starts_with($file['unicodeRange'] ?? '', 'U+0000-00FF')) {
                return basename($file['file']);
            }
        }

        return null;
    }
}
