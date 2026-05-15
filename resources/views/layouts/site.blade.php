<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DevAim Labs — Full-Stack Web Development')</title>
    <meta name="description" content="@yield('meta_description', 'Custom websites, web apps, dashboards, third-party integrations and payment systems built by a solo full-stack developer.')">
    <noscript><style>.reveal-hidden { opacity: 1 !important; transform: none !important; }</style></noscript>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body style="background:#0a0a0a;color:#f0f0f0" class="font-sans antialiased overflow-x-hidden">
    @yield('content')

    <div id="nav-transition-mount"></div>

    <script>
        const nav = document.getElementById('site-nav');
        const sentinel = document.getElementById('nav-sentinel');
        if (nav && sentinel) {
            const io = new IntersectionObserver(([e]) => {
                const scrolled = !e.isIntersecting;
                nav.style.background = scrolled ? 'rgba(10,10,10,0.9)' : 'transparent';
                nav.style.backdropFilter = scrolled ? 'blur(12px)' : '';
                nav.style.borderBottom = scrolled ? '1px solid #1c1c1c' : '';
            }, { rootMargin: '-80px 0px 0px 0px' });
            io.observe(sentinel);
        }
    </script>
</body>
</html>
