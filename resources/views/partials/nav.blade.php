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
            <a href="{{ $isEn ? '/en/services' : '/diensten' }}" class="nav-pill relative z-[1]" data-section="services">{{ $t['nav_services'] ?? 'Diensten' }}</a>
            <a href="{{ $isEn ? '/en/process' : '/werkwijze' }}" class="nav-pill relative z-[1]" data-section="process">{{ $t['nav_process'] ?? 'Werkwijze' }}</a>
            <a href="{{ $isEn ? '/en/work' : '/klantwerk' }}" class="nav-pill relative z-[1]" data-section="client-work">{{ $t['nav_work'] ?? 'Klantwerk' }}</a>
            <a href="{{ $isEn ? '/en/faq' : '/veelgestelde-vragen' }}" class="nav-pill relative z-[1]" data-section="faq">{{ $t['nav_faq'] ?? 'FAQ' }}</a>
            <a href="{{ $isEn ? '/en/contact' : '/contact' }}" class="nav-pill relative z-[1]" data-section="contact">{{ $t['nav_contact'] ?? 'Contact' }}</a>
        </div>

        <!-- Right actions - right column (contains both desktop and mobile variants) -->
        <div class="flex items-center gap-2 lg:gap-3 justify-self-end">
            <!-- Desktop actions: Language toggle, CTA -->
            <div class="hidden lg:flex items-center gap-3">
                <!-- Language Toggle Desktop -->
                <div id="lang-toggle-mount"></div>

                <a href="{{ $isEn ? '/en/contact' : '/contact' }}" class="btn-outline-accent inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium group" data-track="cta_click" data-track-label="{{ $t['nav_cta'] ?? 'Laten we praten' }}" data-track-location="nav">
                    {{ $t['nav_cta'] ?? 'Laten we praten' }}
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
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

    <div id="mobile-menu" class="hidden lg:hidden border-t backdrop-blur-md" style="border-color: var(--color-border-dim);">
        <div class="max-w-6xl mx-auto px-6 py-4 flex flex-col gap-4 text-sm" style="color: var(--color-text-muted);">
            <a href="{{ $isEn ? '/en/services' : '/diensten' }}" class="transition-colors hover:text-[var(--color-text)]">{{ $t['nav_services'] ?? 'Diensten' }}</a>
            <a href="{{ $isEn ? '/en/process' : '/werkwijze' }}" class="transition-colors hover:text-[var(--color-text)]">{{ $t['nav_process'] ?? 'Werkwijze' }}</a>
            <a href="{{ $isEn ? '/en/work' : '/klantwerk' }}" class="transition-colors hover:text-[var(--color-text)]">{{ $t['nav_work'] ?? 'Klantwerk' }}</a>
            <a href="{{ $isEn ? '/en/contact' : '/contact' }}" class="transition-colors hover:text-[var(--color-text)]">{{ $t['nav_contact'] ?? 'Contact' }}</a>
            <a href="{{ $isEn ? '/en/faq' : '/veelgestelde-vragen' }}" class="transition-colors hover:text-[var(--color-text)]">{{ $t['nav_faq'] ?? 'FAQ' }}</a>
            <div class="flex justify-center items-center">
                <a href="{{ $isEn ? '/en/contact' : '/contact' }}" class="btn-outline-accent inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium group" data-track="cta_click" data-track-label="{{ $t['nav_cta'] ?? 'Laten we praten' }}" data-track-location="nav">
                    {{ $t['nav_cta'] ?? 'Laten we praten' }}
                    <svg class="w-3.5 h-3.5 transition-transform duration-200 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</header>

<div id="nav-sentinel" class="absolute top-0 h-px w-full pointer-events-none"></div>

<script nonce="{{ $cspNonce ?? '' }}">
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
