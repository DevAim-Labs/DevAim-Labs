@php
    $locale = $locale ?? 'nl';
    $isEn = $locale === 'en';
    $contactPath = $isEn ? '/en/contact' : '/contact';
@endphp

<section id="about" data-gsap="section-about" class="reveal-hidden">
    <div class="section-card">
    <div class="max-w-4xl mx-auto px-6 py-20">
        <div class="text-center">
            <p class="section-eyebrow mb-4">{{ $isEn ? 'About me' : 'Over mij' }}</p>
            <h2 class="text-3xl md:text-4xl section-title mb-6">
                {{ $isEn ? 'Short lines, from conversation to launch.' : 'Korte lijnen, van gesprek tot livegang.' }}
            </h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-4 max-w-2xl mx-auto">
                {{ $isEn
                    ? "I'm the developer who builds your admin panel, dashboard or integration. No account manager, no changing contacts. What you discuss with me is exactly what gets built."
                    : 'Ik ben de developer die jouw adminpaneel, dashboard of integratie bouwt. Geen accountmanager, geen wisselende contactpersonen. Wat je met mij bespreekt, is ook precies wat er gebouwd wordt.'
                }}
            </p>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-8 max-w-2xl mx-auto">
                {{ $isEn
                    ? 'That means shorter lines, faster adjustments when things change, and a fixed scope and planning before I start. No surprises halfway through.'
                    : 'Dat betekent kortere lijnen, sneller schakelen als iets verandert, en een vaste scope en planning voordat ik begin. Geen verrassingen halverwege.'
                }}
            </p>
            <a
                href="{{ $contactPath }}"
                class="btn-hover btn-hover-primary"
                data-track="cta_click"
                data-track-label="{{ $isEn ? 'Talk to me' : 'Praat met mij' }}"
                data-track-location="about"
            >
                <span class="btn-hover__dot" aria-hidden="true"></span>
                <span class="btn-hover__label">{{ $isEn ? 'Talk to me' : 'Praat met mij' }}</span>
                <span class="btn-hover__reveal" aria-hidden="true">
                    <span>{{ $isEn ? 'Talk to me' : 'Praat met mij' }}</span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </span>
            </a>
        </div>
    </div>
    </div>
</section>
