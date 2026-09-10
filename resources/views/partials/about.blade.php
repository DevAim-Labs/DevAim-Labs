@php
    $locale = $locale ?? 'nl';
    $isEn = $locale === 'en';
    $contactPath = $isEn ? '/en/contact' : '/contact';
@endphp

<section id="about" data-gsap="section-about" class="reveal-hidden">
    <div class="section-card">
    <div class="max-w-4xl mx-auto px-6 py-20">
        <div class="text-center">
            <p class="section-eyebrow mb-4">{{ $isEn ? 'About us' : 'Over ons' }}</p>
            <h2 class="text-3xl md:text-4xl section-title mb-6">
                {{ $isEn ? 'Short lines, from conversation to launch.' : 'Korte lijnen, van gesprek tot livegang.' }}
            </h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-4 max-w-2xl mx-auto">
                {{ $isEn
                    ? "We're the team that builds your admin panel, dashboard or integration. No account manager, no changing contacts. What you discuss with us is exactly what gets built."
                    : 'Wij zijn het team dat jouw adminpaneel, dashboard of integratie bouwt. Geen accountmanager, geen wisselende contactpersonen. Wat je met ons bespreekt, is ook precies wat er gebouwd wordt.'
                }}
            </p>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-8 max-w-2xl mx-auto">
                {{ $isEn
                    ? 'That means shorter lines, faster adjustments when things change, and a fixed scope and planning before we start. No surprises halfway through.'
                    : 'Dat betekent kortere lijnen, sneller schakelen als iets verandert, en een vaste scope en planning voordat we beginnen. Geen verrassingen halverwege.'
                }}
            </p>
            <a
                href="{{ $contactPath }}"
                class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                data-track="cta_click"
                data-track-label="{{ $isEn ? 'Talk to us' : 'Praat met ons' }}"
                data-track-location="about"
            >
                {{ $isEn ? 'Talk to us' : 'Praat met ons' }} →
            </a>
        </div>
    </div>
    </div>
</section>
