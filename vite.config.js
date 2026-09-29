import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            // Site entries (v2 design; see App\Support\SiteAssets). The old
            // resources/js/app.js + resources/css/app.css are no longer
            // rendered by any route and are left out of the build.
            input: [
                'resources/css/v2.css',
                'resources/js/v2/main.js',
            ],
            refresh: true,
            // Only the families the site renders (SiteAssets::FONTS, v2.css),
            // self-hosted so they stay inside the production CSP's font-src 'self'.
            fonts: [
                // display: 'optional' — the plugin's automatic metric-matched
                // fallback generation (via fontaine) doesn't work in this setup
                // (verified: fontaine.readMetrics() returns null even for a
                // valid local font file), so a 'swap' here would cause a large
                // layout shift once the real font arrives. 'optional' either
                // uses the font immediately (already cached) or keeps the
                // fallback for this page view — no late, shifting swap.
                bunny('Inter', {
                    weights: [400, 500, 600, 700],
                    display: 'optional',
                }),
                bunny('JetBrains Mono', {
                    weights: [400, 500, 600],
                    display: 'optional',
                }),
                // Display face; 400 (+ italic) is the H1 face (preloaded, see SiteAssets).
                bunny('Fraunces', {
                    weights: [400, 600, 700, 900],
                    styles: ['normal', 'italic'],
                    display: 'optional',
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
