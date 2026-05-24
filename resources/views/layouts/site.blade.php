<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth" data-theme="dark">
<head>
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
