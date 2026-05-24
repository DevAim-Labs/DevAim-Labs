<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" data-theme="dark">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KW96JLBB');</script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-4DGM3LBT0E"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-4DGM3LBT0E');
    </script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DevAim Labs')</title>
    <meta name="description" content="@yield('meta_description', 'Custom software for your business — admin panels, KPI dashboards, websites, API integrations and payment systems.')">
    <link rel="icon" type="image/png" href="{{ asset('DevAim_IMG.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('DevAim_IMG.png') }}">
    <noscript><style>.reveal-hidden { opacity: 1 !important; transform: none !important; }</style></noscript>
    <script>
        (function() {
            var t = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', t);
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:var(--color-surface);color:var(--color-text)" class="font-sans antialiased overflow-x-hidden">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KW96JLBB"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    @yield('content')

    <div id="nav-transition-mount"></div>

    <script>
        const nav = document.getElementById('site-nav');
        const sentinel = document.getElementById('nav-sentinel');
        if (nav && sentinel) {
            const io = new IntersectionObserver(([e]) => {
                nav.classList.toggle('is-scrolled', !e.isIntersecting);
            }, { rootMargin: '-80px 0px 0px 0px' });
            io.observe(sentinel);
        }

        function toggleTheme() {
            const html = document.documentElement;
            const next = html.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            html.setAttribute('data-theme', next);
            localStorage.setItem('theme', next);
        }
    </script>
</body>
</html>
