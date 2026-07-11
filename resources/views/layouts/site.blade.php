<!DOCTYPE html>
<html lang="nl" class="scroll-smooth" data-theme="dark">
<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4DGM3LBT0E"></script>
    <script nonce="{{ $cspNonce ?? '' }}">
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-4DGM3LBT0E');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $pageTitle ?? trim($__env->yieldContent('title')) ?: 'DevAim Labs' }}</title>
    <meta name="description" content="{{ $pageDescription ?? trim($__env->yieldContent('meta_description')) ?: 'Maatwerksoftware voor bedrijven — adminpanelen, KPI-dashboards, websites, API-koppelingen en betaalstromen.' }}">
    <link rel="canonical" href="{{ $canonicalUrl ?? url('/') }}">
    <meta name="robots" content="index, follow">

    <meta property="og:type" content="website">
    <meta property="og:site_name" content="DevAim Labs">
    <meta property="og:title" content="{{ $pageTitle ?? 'DevAim Labs' }}">
    <meta property="og:description" content="{{ $pageDescription ?? '' }}">
    <meta property="og:url" content="{{ $canonicalUrl ?? url('/') }}">
    <meta property="og:image" content="{{ asset('og-image.png') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="nl_NL">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle ?? 'DevAim Labs' }}">
    <meta name="twitter:description" content="{{ $pageDescription ?? '' }}">
    <meta name="twitter:image" content="{{ asset('og-image.png') }}">

    <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('IMG_144.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('IMG_144.png') }}">
    <link rel="preload" as="image" href="/heroimage-768.webp" type="image/webp" media="(max-width: 768px)">
    <link rel="preload" as="image" href="/heroimage.webp" type="image/webp" media="(min-width: 769px)">
    <noscript><style>.reveal-hidden { opacity: 1 !important; transform: none !important; }</style></noscript>
    <script nonce="{{ $cspNonce ?? '' }}">
        (function() {
            var t = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('scripts')

    @php
        $org = config('site.organization');
        $structured = [
            '@context' => 'https://schema.org',
            '@graph' => [
                [
                    '@type' => 'ProfessionalService',
                    '@id' => url('/') . '#organization',
                    'name' => $org['name'],
                    'url' => url('/'),
                    'logo' => asset($org['logo']),
                    'email' => $org['email'],
                    'telephone' => $org['phone'],
                    'areaServed' => 'NL',
                    'description' => $pageDescription ?? 'Maatwerksoftware en custom software ontwikkeling.',
                ],
            ],
        ];
        if (! empty($breadcrumbs) && count($breadcrumbs) > 1) {
            $structured['@graph'][] = [
                '@type' => 'BreadcrumbList',
                'itemListElement' => collect($breadcrumbs)->values()->map(fn ($crumb, $i) => [
                    '@type' => 'ListItem',
                    'position' => $i + 1,
                    'name' => $crumb['name'],
                    'item' => url($crumb['path']),
                ])->all(),
            ];
        }
    @endphp
    <script type="application/ld+json">@json($structured)</script>
    @stack('structured_data')
</head>
<body style="background:var(--color-surface);color:var(--color-text)" class="font-sans antialiased overflow-x-hidden">

    <main id="main-content">
        @yield('content')
    </main>

    <div id="nav-transition-mount"></div>

    <script nonce="{{ $cspNonce ?? '' }}">
        const nav = document.getElementById('site-nav');
        const sentinel = document.getElementById('nav-sentinel');
        if (nav && sentinel) {
            const io = new IntersectionObserver(([e]) => {
                nav.classList.toggle('is-scrolled', !e.isIntersecting);
            }, { rootMargin: '-80px 0px 0px 0px' });
            io.observe(sentinel);
        }

    </script>
</body>
</html>
