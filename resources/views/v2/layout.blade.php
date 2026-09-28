{{--
    Site layout for every page. View data comes from App\Support\SitePage
    (SitePage::data() for pages, SitePage::error() for the error views):
    pageTitle, pageDescription, canonicalUrl, alternateUrls, robots,
    structuredData, plus the header/footer data (t, org, navLinks, ...).
    Optional `ogImage`: absolute URL of a page-specific share image.
--}}
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pageTitle }}</title>
    @if (! empty($pageDescription))
        <meta name="description" content="{{ $pageDescription }}">
    @endif
    @if (! empty($robots))
        <meta name="robots" content="{{ $robots }}">
    @endif
    @if (! empty($canonicalUrl))
        <link rel="canonical" href="{{ $canonicalUrl }}">
    @endif
    @if (count($alternateUrls ?? []) > 1)
        @foreach ($alternateUrls as $lang => $href)
            <link rel="alternate" hreflang="{{ $lang }}" href="{{ $href }}">
        @endforeach
        <link rel="alternate" hreflang="x-default" href="{{ $alternateUrls['nl'] }}">
    @endif

    @if (! empty($canonicalUrl))
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="{{ $org['name'] }}">
        <meta property="og:title" content="{{ $pageTitle }}">
        <meta property="og:description" content="{{ $pageDescription }}">
        <meta property="og:url" content="{{ $canonicalUrl }}">
        <meta property="og:image" content="{{ $ogImage ?? asset('og-image.png') }}">
        <meta property="og:image:width" content="1200">
        <meta property="og:image:height" content="630">
        <meta property="og:locale" content="{{ $ogLocale }}">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $pageTitle }}">
        <meta name="twitter:description" content="{{ $pageDescription }}">
        <meta name="twitter:image" content="{{ $ogImage ?? asset('og-image.png') }}">
    @endif

    <meta name="color-scheme" content="light dark">
    <meta name="theme-color" media="(prefers-color-scheme: light)" content="#FBF7F0">
    <meta name="theme-color" media="(prefers-color-scheme: dark)" content="#15120E">

    <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('IMG_144.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('IMG_144.png') }}">

    {{--
        Theme before first paint (no flash). Allowed by the CSP through the
        per-request nonce from SecurityHeaders. Stored choice wins, else the
        OS preference. Storage can throw (private mode, blocked site data).
    --}}
    <script nonce="{{ $cspNonce ?? '' }}">
        (function () {
            var d = document.documentElement, t = null;
            try { t = localStorage.getItem('theme'); } catch (e) {}
            if (t !== 'light' && t !== 'dark') {
                t = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
            }
            d.setAttribute('data-theme', t);
            var c = t === 'dark' ? '#15120E' : '#FBF7F0';
            document.querySelectorAll('meta[name="theme-color"]').forEach(function (m) { m.setAttribute('content', c); });
        })();
    </script>

    {{-- Fonts + CSS + JS. Never throws (see SiteAssets), so error pages always render. --}}
    {!! \App\Support\SiteAssets::headTags() !!}

    @if (! empty($structuredData))
        <script type="application/ld+json">@json($structuredData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG)</script>
    @endif
</head>
<body class="v2 v2--{{ $pageKey }}">
    <a href="#main" class="skip-link">{{ $t['a11y']['skip'] }}</a>

    @include('v2.sections.header')

    <main id="main" tabindex="-1">
        @yield('content')
    </main>

    @include('v2.sections.footer')
    @if ($isHome)
        @include('v2.sections.mobile-cta')
    @elseif ($pageKey === 'service')
        @include('v2.sections.service.mobile-cta')
    @endif
</body>
</html>
