@extends('layouts.site')

@section('content')
@include('partials.nav', ['locale' => $locale ?? 'nl', 't' => $translations ?? []])

@php
    $locale = $locale ?? 'nl';
    $t = $translations[$locale] ?? $translations['nl'] ?? [];
    $isEn = $locale === 'en';
@endphp

<section class="contact-page-section">
    <div class="contact-page-container">
        <!-- Left: Info Column -->
        <div class="contact-info-col">
            <p class="section-eyebrow">{{ $t['contact_eyebrow'] ?? 'Contact' }}</p>
            <h1 class="contact-headline">{{ $t['contact_title'] ?? "Laten we samen bouwen." }}</h1>
            <p class="contact-lead">{{ $t['contact_subtitle'] ?? 'Vertel me over je project. Ik reageer binnen 24 uur.' }}</p>

            <!-- Combined Info Card -->
            <div class="info-card-combined">
                <div class="info-row">
                    <div class="info-item">
                        <span class="info-indicator available"></span>
                        <div>
                            <span class="info-label">{{ $isEn ? 'Availability' : 'Beschikbaarheid' }}</span>
                            <span class="info-value">{{ $isEn ? 'Open for projects' : 'Open voor projecten' }}</span>
                        </div>
                    </div>
                    <div class="info-divider"></div>
                    <div class="info-item">
                        <svg class="info-icon-small" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div>
                            <span class="info-label">{{ $isEn ? 'Response' : 'Reactietijd' }}</span>
                            <span class="info-value">{{ $isEn ? 'Within 24 hours' : 'Binnen 24 uur' }}</span>
                        </div>
                    </div>
                </div>

                <div class="info-contacts">
                    <a href="mailto:devaimlabs@gmail.com" class="contact-link">
                        <svg viewBox="0 -960 960 960" fill="currentColor">
                            <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/>
                        </svg>
                        devaimlabs@gmail.com
                    </a>
                    <a href="tel:+31638523099" class="contact-link">
                        <svg viewBox="0 -960 960 960" fill="currentColor">
                            <path d="M798-120q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12Z"/>
                        </svg>
                        +31 6 38523099
                    </a>
                </div>
            </div>

            <!-- Separate Schedule Card -->
            <a href="https://cal.com/devaim/kennismaking" target="_blank" rel="noopener noreferrer" class="schedule-card group">
                <div class="schedule-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="schedule-content">
                    <span class="schedule-title">{{ $isEn ? 'Prefer a call?' : 'Liever bellen?' }}</span>
                    <span class="schedule-desc">{{ $isEn ? 'Book a free (video) call' : 'Plan een gratis (video)gesprek' }}</span>
                </div>
                <svg class="schedule-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>

        <!-- Right: Form Column -->
        <div class="contact-form-col">
            <div id="contact-page-form-mount" data-locale="{{ $locale }}"></div>
        </div>
    </div>
</section>

@include('partials.footer', ['locale' => $locale, 't' => $t])
@endsection

@push('scripts')
<script nonce="{{ $cspNonce ?? '' }}">
    window.__LOCALE__ = @json($locale ?? 'nl');
    window.__TRANSLATIONS__ = @json($translations ?? []);
</script>
@endpush

@push('styles')
<style>
/* ═══════════════════════════════════════════════════════════════════════════
   CONTACT PAGE — Spacious, confident, developer-friendly
   ═══════════════════════════════════════════════════════════════════════════ */

.contact-page-section {
    background: var(--color-surface);
    min-height: 100vh;
    padding: 7rem 0 4rem;
}

.contact-page-container {
    max-width: 80rem;
    margin: 0 auto;
    padding: 0 clamp(1.5rem, 4vw, 3rem);
    display: grid;
    grid-template-columns: 1fr 1.2fr;
    gap: clamp(3rem, 6vw, 6rem);
    align-items: start;
}

/* Left Column — Info */
.contact-info-col {
    padding-top: 2rem;
}

.contact-headline {
    font-size: clamp(2.25rem, 5vw, 3.25rem);
    font-weight: 700;
    letter-spacing: -0.03em;
    line-height: 1.1;
    color: var(--color-text);
    margin: 1rem 0 1.25rem;
}

.contact-lead {
    font-size: 1.125rem;
    line-height: 1.7;
    color: var(--color-text-muted);
    margin-bottom: 2.5rem;
    max-width: 26rem;
}

/* Combined Info Card */
.info-card-combined {
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
}

.info-row {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    padding-bottom: 1.25rem;
    border-bottom: 1px solid var(--color-border-dim);
    margin-bottom: 1.25rem;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex: 1;
}

.info-divider {
    width: 1px;
    height: 2.5rem;
    background: var(--color-border-dim);
}

.info-indicator {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    flex-shrink: 0;
}

.info-indicator.available {
    background: #22C55E;
    box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2);
    animation: pulse-subtle 2s ease-in-out infinite;
}

@keyframes pulse-subtle {
    0%, 100% { box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.2); }
    50% { box-shadow: 0 0 0 6px rgba(34, 197, 94, 0.1); }
}

.info-icon-small {
    width: 20px;
    height: 20px;
    color: var(--color-accent);
    flex-shrink: 0;
}

.info-label {
    display: block;
    font-size: 0.6875rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--color-text-dim);
    margin-bottom: 0.125rem;
}

.info-value {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--color-text);
}

.info-contacts {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.contact-link {
    display: inline-flex;
    align-items: center;
    gap: 0.625rem;
    padding: 0.625rem 0;
    color: var(--color-text-muted);
    font-size: 0.9375rem;
    font-weight: 500;
    transition: color 0.2s ease;
}

.contact-link:hover {
    color: var(--color-accent);
}

.contact-link svg {
    width: 18px;
    height: 18px;
    color: var(--color-accent);
}

/* Schedule Card */
.schedule-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: var(--color-surface-1);
    border: 1px solid var(--color-violet);
    border-radius: 12px;
    text-decoration: none;
    transition: all 0.25s ease;
}

.schedule-card:hover {
    background: var(--color-violet-glow);
    border-color: var(--color-violet-bright);
    transform: translateY(-2px);
}

.schedule-icon {
    width: 2.5rem;
    height: 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-violet-glow);
    border-radius: 8px;
    flex-shrink: 0;
}

.schedule-icon svg {
    width: 1.25rem;
    height: 1.25rem;
    color: var(--color-violet);
}

.schedule-content {
    flex: 1;
}

.schedule-title {
    display: block;
    font-size: 0.9375rem;
    font-weight: 600;
    color: var(--color-text);
    margin-bottom: 0.125rem;
}

.schedule-desc {
    display: block;
    font-size: 0.8125rem;
    color: var(--color-text-muted);
}

.schedule-arrow {
    width: 20px;
    height: 20px;
    color: var(--color-violet);
    transition: transform 0.2s ease;
}

.schedule-card:hover .schedule-arrow {
    transform: translateX(4px);
}

/* Right Column — Form */
.contact-form-col {
    position: sticky;
    top: 5rem;
}

/* Responsive */
@media (max-width: 1024px) {
    .contact-page-container {
        grid-template-columns: 1fr;
        gap: 3rem;
    }

    .contact-info-col {
        padding-top: 0;
        text-align: center;
    }

    .contact-lead {
        margin-left: auto;
        margin-right: auto;
    }

    .info-row {
        justify-content: center;
    }

    .info-contacts {
        align-items: center;
    }

    .schedule-card {
        max-width: 400px;
        margin: 0 auto;
    }

    .contact-form-col {
        position: static;
        max-width: 560px;
        margin: 0 auto;
        width: 100%;
    }
}

@media (max-width: 640px) {
    .contact-page-section {
        padding-top: 6rem;
    }

    .info-row {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }

    .info-divider {
        display: none;
    }

    .contact-info-col {
        text-align: left;
    }

    .info-contacts {
        align-items: flex-start;
    }

    .schedule-card {
        margin: 0;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .info-indicator.available {
        animation: none;
    }

    .schedule-card:hover {
        transform: none;
    }
}
</style>
@endpush
