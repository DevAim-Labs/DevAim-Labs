@php
    // Mirrors resources/js/components/landing/LandingIcon.vue's PATHS map so
    // the same hand-authored SVG set works from Blade (server-rendered) and
    // Vue (islands) without duplication of intent. Always decorative
    // (aria-hidden) — the accessible label lives in the surrounding text.
    $icons = [
        'arrowRight' => 'M5 12h14M13 5l7 7-7 7',
        'arrowUpRight' => 'M7 17 17 7M8 7h9v9',
        'menu' => 'M4 7h16M4 12h16M4 17h16',
        'close' => 'M6 6l12 12M18 6 6 18',
        'check' => 'M5 13l4 4L19 7',
        'mail' => 'M4 6h16v12H4z M4 7l8 6 8-6',
        'phone' => 'M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1.1l-2 2.1z',
        'pause' => 'M7 5h3v14H7zM14 5h3v14h-3z',
        'play' => 'M7 5l12 7-12 7V5z',
    ];
    $size = $size ?? 20;
@endphp
<svg width="{{ $size }}" height="{{ $size }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false" {{ $attributes ?? '' }}>
    <path d="{{ $icons[$name] ?? $icons['check'] }}" />
</svg>
