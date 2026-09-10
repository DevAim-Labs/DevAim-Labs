import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            fonts: [
                bunny('Space Grotesk', {
                    weights: [400, 500, 600, 700],
                }),
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
                bunny('Geist', {
                    weights: [400, 500, 600, 700],
                    display: 'optional',
                }),
                bunny('Geist Mono', {
                    weights: [400, 500],
                    display: 'optional',
                }),
            ],
        }),
        tailwindcss(),
        vue(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
});
