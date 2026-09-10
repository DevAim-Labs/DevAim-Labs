@php
    $locale = $locale ?? 'nl';
    $t = $t ?? config('translations')[$locale] ?? [];
    $isEn = $locale === 'en';
    $prefix = $isEn ? '/en' : '';
@endphp

<header id="site-nav" class="fixed top-0 inset-x-0 z-50 transition-[background,backdrop-filter,box-shadow] duration-300">
    <nav class="nav-grid">
        <!-- Logo - left column -->
        <a href="{{ $prefix }}/" class="font-bold tracking-tight text-lg" style="color: var(--color-text);">
            DevAim<span style="color: var(--color-accent);">.</span>
        </a>

        <!-- Nav pills - centered between logo and right actions -->
        <div class="nav-pills-track hidden lg:flex items-center rounded-full p-1 justify-self-center" style="background: var(--color-surface-1);">
            <span data-nav-pill-indicator class="nav-pill-indicator" aria-hidden="true"></span>
            <a href="{{ $prefix }}/#services" class="nav-pill relative z-[1]" data-section="services">{{ $t['nav_services'] ?? 'Diensten' }}</a>
            <a href="{{ $prefix }}/#process" class="nav-pill relative z-[1]" data-section="process">{{ $t['nav_process'] ?? 'Werkwijze' }}</a>
            <a href="{{ $prefix }}/#pricing" class="nav-pill relative z-[1]" data-section="pricing">{{ $isEn ? 'Pricing' : 'Prijzen' }}</a>
            <a href="{{ $prefix }}/#faq" class="nav-pill relative z-[1]" data-section="faq">{{ $t['nav_faq'] ?? 'FAQ' }}</a>
            <a href="{{ $isEn ? '/en/contact' : '/contact' }}" class="nav-pill relative z-[1]" data-section="contact">{{ $t['nav_contact'] ?? 'Contact' }}</a>
        </div>

        <!-- Right actions - right column (contains both desktop and mobile variants) -->
        <div class="flex items-center gap-2 lg:gap-3 justify-self-end">
            <!-- Desktop actions: Language toggle, CTA -->
            <div class="hidden lg:flex items-center gap-3">
                <!-- Language Toggle Desktop -->
                <div id="lang-toggle-mount"></div>

                <a href="{{ $isEn ? '/en/contact' : '/contact' }}" class="btn-hover" data-track="cta_click" data-track-label="{{ $t['nav_cta'] ?? 'Laten we praten' }}" data-track-location="nav">
                    <span class="btn-hover__dot" aria-hidden="true"></span>
                    <span class="btn-hover__label">{{ $t['nav_cta'] ?? 'Laten we praten' }}</span>
                    <span class="btn-hover__reveal" aria-hidden="true">
                        <span>{{ $t['nav_cta'] ?? 'Laten we praten' }}</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </span>
                </a>
            </div>

            <!-- Mobile actions -->
            <div class="lg:hidden flex items-center gap-2">
                <!-- Language Toggle Mobile -->
                <div id="lang-toggle-mount-mobile"></div>

                <button id="mobile-menu-btn" class="transition-colors" style="color: var(--color-text-muted);" aria-label="{{ $isEn ? 'Open menu' : 'Menu openen' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div id="mobile-menu" class="mobile-menu-panel lg:hidden" aria-hidden="true">
        <div class="mobile-menu-inner">
            <div class="mobile-menu-header">
                <a href="{{ $prefix }}/" class="font-bold tracking-tight text-lg" style="color: var(--color-text);">
                    DevAim<span style="color: var(--color-accent);">.</span>
                </a>
                <button id="mobile-menu-close" class="mobile-menu-close" aria-label="{{ $isEn ? 'Close menu' : 'Menu sluiten' }}" style="color: var(--color-text-muted);">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="mobile-menu-links">
                <a href="{{ $prefix }}/#services" data-mobile-menu-link>{{ $t['nav_services'] ?? 'Diensten' }}</a>
                <a href="{{ $prefix }}/#process" data-mobile-menu-link>{{ $t['nav_process'] ?? 'Werkwijze' }}</a>
                <a href="{{ $prefix }}/#pricing" data-mobile-menu-link>{{ $isEn ? 'Pricing' : 'Prijzen' }}</a>
                <a href="{{ $prefix }}/#faq" data-mobile-menu-link>{{ $t['nav_faq'] ?? 'FAQ' }}</a>
                <a href="{{ $isEn ? '/en/contact' : '/contact' }}" data-mobile-menu-link>{{ $t['nav_contact'] ?? 'Contact' }}</a>
            </nav>

            <a href="{{ $isEn ? '/en/contact' : '/contact' }}" class="btn-hover btn-hover-primary mobile-menu-cta" data-mobile-menu-link data-track="cta_click" data-track-label="{{ $t['nav_cta'] ?? 'Laten we praten' }}" data-track-location="nav">
                <span class="btn-hover__dot" aria-hidden="true"></span>
                <span class="btn-hover__label">{{ $t['nav_cta'] ?? 'Laten we praten' }}</span>
                <span class="btn-hover__reveal" aria-hidden="true">
                    <span>{{ $t['nav_cta'] ?? 'Laten we praten' }}</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
</header>

<div id="nav-sentinel" class="absolute top-0 h-px w-full pointer-events-none"></div>

<style>
    .mobile-menu-panel {
        position: fixed;
        inset: 0;
        z-index: 60;
        background: var(--color-surface);
        transform: translateX(-100%);
        transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1);
        overflow-y: auto;
        visibility: hidden;
    }

    .mobile-menu-panel.is-open {
        transform: translateX(0);
        visibility: visible;
    }

    .mobile-menu-inner {
        display: flex;
        flex-direction: column;
        min-height: 100%;
        padding: 1.25rem 1.5rem 2rem;
    }

    .mobile-menu-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 3.5rem;
        margin-bottom: 2.5rem;
    }

    .mobile-menu-close {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        transition: color 0.2s ease;
    }

    .mobile-menu-close:hover {
        color: var(--color-text) !important;
    }

    .mobile-menu-links {
        display: flex;
        flex-direction: column;
        margin-bottom: auto;
    }

    .mobile-menu-links a {
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        padding: 0.875rem 0;
        color: var(--color-text);
        text-decoration: none;
        border-bottom: 1px solid var(--color-border-dim);
        transition: color 0.2s ease;
    }

    .mobile-menu-links a:hover {
        color: var(--color-accent);
    }

    .mobile-menu-cta {
        margin-top: 2rem;
    }
</style>

<script nonce="{{ $cspNonce ?? '' }}">
    (function () {
        var menuBtn = document.getElementById('mobile-menu-btn');
        var menuPanel = document.getElementById('mobile-menu');
        var menuCloseBtn = document.getElementById('mobile-menu-close');
        var menuLinks = menuPanel.querySelectorAll('[data-mobile-menu-link]');

        function openMenu() {
            menuPanel.classList.add('is-open');
            menuPanel.setAttribute('aria-hidden', 'false');
            menuBtn.setAttribute('aria-expanded', 'true');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            menuPanel.classList.remove('is-open');
            menuPanel.setAttribute('aria-hidden', 'true');
            menuBtn.setAttribute('aria-expanded', 'false');
            document.body.style.overflow = '';
        }

        menuBtn.addEventListener('click', openMenu);
        menuCloseBtn.addEventListener('click', closeMenu);
        menuLinks.forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && menuPanel.classList.contains('is-open')) closeMenu();
        });
    })();
</script>
