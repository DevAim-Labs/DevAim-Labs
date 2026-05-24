<header id="site-nav" class="fixed top-0 inset-x-0 z-50 transition-[background,backdrop-filter,box-shadow] duration-300">
    <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="/" class="font-bold tracking-tight text-lg" style="color: var(--color-text);">
            DevAim<span style="color: var(--color-accent);">.</span>
        </a>

        <div class="hidden md:flex items-center rounded-full p-1" style="background: var(--color-surface-1);">
            <a href="/diensten" class="nav-pill" data-section="services">Diensten</a>
            <a href="/werkwijze" class="nav-pill" data-section="process">Werkwijze</a>
            <a href="/klantwerk" class="nav-pill" data-section="client-work">Klantwerk</a>
            <a href="/veelgestelde-vragen" class="nav-pill" data-section="faq">FAQ</a>
            <a href="/contact" class="nav-pill" data-section="contact">Contact</a>
        </div>

        <div class="hidden md:flex items-center gap-3">
            <button onclick="toggleTheme()" aria-label="Thema wisselen" class="w-8 h-8 flex items-center justify-center rounded transition-colors duration-200" style="color: var(--color-text-muted);">
                <svg class="theme-icon-sun" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="5"/>
                    <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
                <svg class="theme-icon-moon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>

            <a href="/contact" class="btn-outline-accent inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium" data-track="cta_click" data-track-label="Laten we praten" data-track-location="nav">
                Laten we praten
            </a>
        </div>

        <div class="md:hidden flex items-center gap-2">
            <button onclick="toggleTheme()" aria-label="Thema wisselen" class="w-8 h-8 flex items-center justify-center rounded transition-colors duration-200" style="color: var(--color-text-muted);">
                <svg class="theme-icon-sun" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="5"/>
                    <line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/>
                    <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/>
                    <line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/>
                    <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/>
                </svg>
                <svg class="theme-icon-moon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
                </svg>
            </button>
            <button id="mobile-menu-btn" class="transition-colors" style="color: var(--color-text-muted);" aria-label="Menu openen">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </nav>

    <div id="mobile-menu" class="hidden md:hidden border-t backdrop-blur-md" style="border-color: var(--color-border-dim);">
        <div class="max-w-6xl mx-auto px-6 py-4 flex flex-col gap-4 text-sm" style="color: var(--color-text-muted);">
            <a href="/diensten" class="transition-colors hover:text-white">Diensten</a>
            <a href="/werkwijze" class="transition-colors hover:text-white">Werkwijze</a>
            <a href="/klantwerk" class="transition-colors hover:text-white">Klantwerk</a>
            <a href="/veelgestelde-vragen" class="transition-colors hover:text-white">FAQ</a>
            <a href="/contact" class="transition-colors hover:text-white">Contact</a>
        </div>
    </div>
</header>

<div id="nav-sentinel" class="absolute top-0 h-px w-full pointer-events-none"></div>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
