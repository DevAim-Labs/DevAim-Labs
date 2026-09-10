@php
    $locale = $locale ?? 'nl';
    $t = $t ?? config('translations')[$locale] ?? [];
    $isEn = $locale === 'en';
    $contactPath = $isEn ? '/en/contact' : '/contact';

    // Text loop words for each language
    $loopWordsNl = ['Maatwerksoftware', 'Websites', "Portfolio's", 'Adminpanelen', 'Betaalintegraties', 'KPI Dashboards', 'API Koppelingen'];
    $loopWordsEn = ['Custom Software', 'Websites', 'Portfolios', 'Admin Panels', 'Payment Integrations', 'KPI Dashboards', 'API Integrations'];
    $loopWords = $isEn ? $loopWordsEn : $loopWordsNl;
@endphp

<section id="home" class="hero-section">
    <div class="hero-container">
        <!-- Solid background block -->
        <div class="hero-bg-block" aria-hidden="true"></div>
        <!-- LEFT COLUMN: Content -->
        <div class="hero-content">
            @if(!empty($breadcrumbs) && count($breadcrumbs) > 1)
            <nav aria-label="Breadcrumb" class="hero-breadcrumb">
                <ol>
                    @foreach($breadcrumbs as $i => $crumb)
                        @if($i > 0)<li aria-hidden="true">/</li>@endif
                        <li>
                            @if($i === count($breadcrumbs) - 1)
                                <span aria-current="page">{{ $crumb['name'] }}</span>
                            @else
                                <a href="{{ $crumb['path'] }}">{{ $crumb['name'] }}</a>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
            @endif

            <!-- Availability Badge -->
            <div data-gsap="hero-badge" class="hero-badge" id="hero-availability-mount" data-text="{{ $t['hero_badge'] ?? 'Beschikbaar voor nieuwe projecten' }}"></div>

            <!-- Headline with Text Loop -->
            <h1 data-gsap="hero-headline" class="hero-headline">
                <span class="hero-headline-prefix">{{ $isEn ? 'We build' : 'Wij bouwen' }}</span>
                <span id="hero-text-loop-mount" data-words="{{ json_encode($loopWords) }}" data-locale="{{ $locale }}"></span>
            </h1>

            <!-- Sub-copy -->
            <p data-gsap="hero-sub" class="hero-subtitle">
                {{ $t['hero_sub_1'] ?? 'Direct contact met de developers die bouwen.' }}
                {{ $t['hero_sub_2'] ?? 'Geen tussenpersoon. Reactie binnen 24 uur.' }}
            </p>

            <!-- CTAs -->
            <div data-gsap="hero-cta" class="hero-actions">
                <a href="{{ $contactPath }}"
                   class="hero-btn-primary"
                   data-track="cta_click"
                   data-track-label="{{ $isEn ? 'Start project' : 'Start project' }}"
                   data-track-location="hero">
                    {{ $isEn ? 'Start a project' : 'Start een project' }}
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                <a href="#services"
                   class="hero-btn-secondary"
                   data-smooth-scroll
                   data-track="cta_click"
                   data-track-label="{{ $isEn ? 'Learn more' : 'Meer weten' }}"
                   data-track-location="hero">
                    {{ $isEn ? 'Learn more' : 'Meer weten' }}
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </a>
            </div>

            <!-- Trust signals -->
            <div class="hero-trust">
                <div class="trust-item">
                    <span class="trust-check">✓</span>
                    <span>{{ $isEn ? '24h response time' : '24 uur reactietijd' }}</span>
                </div>
            </div>
        </div>

        <!-- RIGHT COLUMN: Contact Form -->
        <div class="hero-form-wrapper">
            <div id="hero-contact-form-mount" data-locale="{{ $locale }}"></div>
        </div>
    </div>
</section>


<style>
/* ═══════════════════════════════════════════════════════════════════════════
   HERO SECTION — Clean, professional, solid background
   ═══════════════════════════════════════════════════════════════════════════ */

.hero-section {
    position: relative;
    background: var(--color-surface);
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 7rem 0 4rem;
}

.hero-container {
    position: relative;
    width: 100%;
    max-width: 76rem;
    margin: 0 auto;
    padding: 0 1.5rem;
    display: grid;
    grid-template-columns: 1fr 440px;
    gap: 5rem;
    align-items: center;
}

/* Solid background block */
.hero-bg-block {
    position: absolute;
    top: -3rem;
    left: 50%;
    transform: translateX(-50%);
    width: calc(100% + 16rem);
    max-width: 92rem;
    height: calc(100% + 6rem);
    background: var(--color-surface-1);
    border-radius: 24px;
    z-index: -1;
}

html[data-theme="light"] .hero-bg-block {
    background: var(--color-surface-1);
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

/* Content column */
.hero-content {
    display: flex;
    flex-direction: column;
    gap: 0;
}

.hero-breadcrumb ol {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    list-style: none;
    margin: 0 0 1.5rem;
    padding: 0;
    font-size: 0.8125rem;
    color: var(--color-text-dim);
}

.hero-breadcrumb a:hover {
    color: var(--color-text-muted);
}

/* Badge */
.hero-badge {
    margin-bottom: 1.5rem;
}

/* Headline */
.hero-headline {
    font-size: clamp(2.5rem, 5vw, 3.75rem);
    font-weight: 700;
    line-height: 1.1;
    letter-spacing: -0.03em;
    color: var(--color-text);
    margin: 0 0 1.5rem;
}

.hero-headline-prefix {
    display: block;
    color: var(--color-text-muted);
    font-size: 0.85em;
    font-weight: 500;
    margin-bottom: 0.25rem;
}

/* Subtitle */
.hero-subtitle {
    font-size: 1.125rem;
    line-height: 1.7;
    color: var(--color-text-muted);
    max-width: 28rem;
    margin: 0 0 2rem;
}

/* Actions */
.hero-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 0.875rem;
    margin-bottom: 2.5rem;
}

.hero-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    background: var(--color-accent);
    color: var(--color-on-accent);
    font-size: 0.9375rem;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.2s ease, transform 0.2s ease;
}

.hero-btn-primary:hover {
    background: var(--color-accent-dim);
    transform: translateY(-1px);
}

.hero-btn-primary:active {
    transform: translateY(0);
}

.hero-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.5rem;
    background: transparent;
    color: var(--color-text-muted);
    font-size: 0.9375rem;
    font-weight: 500;
    border: 1px solid var(--color-border);
    border-radius: 8px;
    text-decoration: none;
    transition: border-color 0.2s ease, color 0.2s ease;
}

.hero-btn-secondary:hover {
    border-color: var(--color-text-muted);
    color: var(--color-text);
}

/* Trust signals */
.hero-trust {
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
}

.trust-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: var(--color-text-dim);
}

.trust-check {
    color: var(--color-accent);
    font-weight: 600;
}

/* Form wrapper */
.hero-form-wrapper {
    position: relative;
}

/* ═══════════════════════════════════════════════════════════════════════════
   RESPONSIVE
   ═══════════════════════════════════════════════════════════════════════════ */

@media (max-width: 1200px) {
    .hero-container {
        grid-template-columns: 1fr 400px;
        gap: 3rem;
    }
}

@media (max-width: 1024px) {
    .hero-section {
        padding: 6rem 0 3rem;
    }

    .hero-container {
        grid-template-columns: 1fr;
        gap: 3rem;
        text-align: center;
    }

    .hero-content {
        align-items: center;
    }

    .hero-breadcrumb ol {
        justify-content: center;
    }

    .hero-subtitle {
        margin-left: auto;
        margin-right: auto;
    }

    .hero-actions {
        justify-content: center;
    }

    .hero-trust {
        justify-content: center;
    }

    .hero-form-wrapper {
        max-width: 440px;
        margin: 0 auto;
        width: 100%;
    }
}

@media (max-width: 640px) {
    .hero-section {
        min-height: auto;
        padding: 5rem 0 2rem;
    }

    .hero-container {
        padding: 0 1rem;
    }

    .hero-headline {
        font-size: 2rem;
    }

    .hero-trust {
        flex-direction: column;
        gap: 0.75rem;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .hero-btn-primary:hover,
    .hero-btn-secondary:hover {
        transform: none;
    }
}
</style>
