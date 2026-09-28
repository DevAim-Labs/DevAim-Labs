/*
 * Live demo facade (service pages). Markup: resources/views/v2/sections/service/demo.blade.php
 *
 * The page ships a screenshot only. "Start live demo" inserts the iframe
 * (sandbox="allow-scripts allow-forms", never allow-same-origin), shows a
 * loading state with aria-busy and moves focus into the demo once it has
 * loaded. "Demo sluiten" removes it and returns focus to the start button.
 * "Volledig scherm" appears only where the Fullscreen API is available and
 * enlarges the frame wrapper (not the iframe); Esc leaves it.
 *
 * Below 768px there is never an iframe: the CSS shows "Open de demo" (a
 * new tab) instead, and a live frame is unloaded if the viewport shrinks.
 */

const INLINE = '(min-width: 768px)';

function setup(demo) {
    const stage = demo.querySelector('[data-demo-stage]');
    const frame = demo.querySelector('[data-demo-frame]');
    const start = demo.querySelector('[data-demo-start]');
    const closeBtn = demo.querySelector('[data-demo-close]');
    const fullBtn = demo.querySelector('[data-demo-fullscreen]');
    const loading = demo.querySelector('[data-demo-loading]');
    if (!stage || !start) return;

    const inline = window.matchMedia(INLINE);
    let iframe = null;

    function load({ focus = true } = {}) {
        if (iframe || !inline.matches) return iframe;

        iframe = document.createElement('iframe');
        iframe.className = 'svc-demo__iframe';
        iframe.src = demo.dataset.src;
        iframe.title = demo.dataset.title;
        // Same-origin demo: scripts + forms (the checkout demo submits a
        // form) but an opaque origin, so it cannot remove its own sandbox.
        iframe.setAttribute('sandbox', 'allow-scripts allow-forms');
        iframe.setAttribute('referrerpolicy', 'strict-origin-when-cross-origin');
        iframe.width = stage.querySelector('img')?.getAttribute('width') ?? '1600';
        iframe.height = stage.querySelector('img')?.getAttribute('height') ?? '956';

        demo.dataset.state = 'loading';
        stage.setAttribute('aria-busy', 'true');
        if (loading) loading.hidden = false;

        iframe.addEventListener(
            'load',
            () => {
                demo.dataset.state = 'live';
                stage.removeAttribute('aria-busy');
                if (loading) loading.hidden = true;
                if (focus) iframe.focus({ preventScroll: true });
            },
            { once: true },
        );

        stage.append(iframe);
        if (closeBtn) closeBtn.hidden = false;
        return iframe;
    }

    function unload({ restoreFocus = false } = {}) {
        if (!iframe) return;
        if (document.fullscreenElement === frame) document.exitFullscreen?.().catch(() => {});
        iframe.remove();
        iframe = null;
        delete demo.dataset.state;
        stage.removeAttribute('aria-busy');
        if (loading) loading.hidden = true;
        if (closeBtn) closeBtn.hidden = true;
        if (restoreFocus) start.focus();
    }

    start.addEventListener('click', () => load());
    closeBtn?.addEventListener('click', () => unload({ restoreFocus: true }));

    // Full screen: progressive enhancement (not on iPhone Safari).
    if (fullBtn && frame && document.fullscreenEnabled && frame.requestFullscreen) {
        fullBtn.hidden = false;
        fullBtn.addEventListener('click', () => {
            if (document.fullscreenElement) {
                document.exitFullscreen().catch(() => {});
                return;
            }
            load({ focus: false });
            frame.requestFullscreen().then(() => iframe?.focus({ preventScroll: true })).catch(() => {});
        });
        document.addEventListener('fullscreenchange', () => {
            fullBtn.setAttribute('aria-pressed', String(document.fullscreenElement === frame));
        });
    }

    // Phones never keep an inline frame (see the breakpoint table above).
    inline.addEventListener?.('change', (event) => {
        if (!event.matches) unload();
    });

    // Without this attribute the start button stays hidden (no-JS: the
    // screenshot and "Open in nieuw tabblad" still work).
    demo.dataset.ready = '';
}

export default function initDemoEmbeds() {
    document.querySelectorAll('[data-demo]').forEach(setup);
}
