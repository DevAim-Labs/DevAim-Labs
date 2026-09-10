<script setup>
import { computed } from 'vue'

const locale = window.__LOCALE__ || 'nl'
const isEn = locale === 'en'

const t = computed(() => isEn ? {
    eyebrow: 'Pricing',
    title: 'Transparent pricing, tailored to your project.',
    subtitle: "Every project is unique. I'll figure out the best pricing model with you, based on complexity and scope.",

    // Development section
    devTitle: 'Development',
    devDesc: 'Depending on the size and complexity of your project, I work with:',
    devOptions: [
        { label: 'Fixed price', desc: 'for well-defined projects' },
        { label: 'Per phase', desc: 'for projects that evolve' },
        { label: 'Hourly rate', desc: 'for flexible collaboration' },
    ],
    devNote: 'I discuss the best approach in my free introductory call.',

    // Maintenance section
    maintTitle: 'Maintenance & Support',
    maintDesc: 'After delivery, I can continue to maintain and improve your software with a monthly agreement:',
    maintFeatures: [
        'Bug fixes and security updates',
        'Small adjustments and improvements',
        'Priority support',
        'Hosting management (optional)',
    ],
    maintNote: 'Monthly fee based on scope. Cancel anytime.',

    ctaText: 'Discuss your project',
    ctaPath: '/en/contact',
} : {
    eyebrow: 'Tarieven',
    title: 'Transparante tarieven, afgestemd op jouw project.',
    subtitle: 'Elk project is uniek. Ik bepaal samen met jou het beste model op basis van complexiteit en scope.',

    // Development section
    devTitle: 'Ontwikkeling',
    devDesc: 'Afhankelijk van de grootte en complexiteit van je project werk ik met:',
    devOptions: [
        { label: 'Vaste prijs', desc: 'voor afgebakende projecten' },
        { label: 'Per fase', desc: 'voor projecten die evolueren' },
        { label: 'Uurtarief', desc: 'voor flexibele samenwerking' },
    ],
    devNote: 'Ik bespreek de beste aanpak in mijn gratis kennismakingsgesprek.',

    // Maintenance section
    maintTitle: 'Onderhoud & Support',
    maintDesc: 'Na oplevering kan ik je software blijven onderhouden en verbeteren met een maandelijkse afspraak:',
    maintFeatures: [
        'Bugfixes en security updates',
        'Kleine aanpassingen en verbeteringen',
        'Prioriteit support',
        'Hosting beheer (optioneel)',
    ],
    maintNote: 'Maandelijks bedrag op basis van scope. Maandelijks opzegbaar.',

    ctaText: 'Bespreek je project',
    ctaPath: '/contact',
})
</script>

<template>
    <section id="pricing" class="pricing-section" data-gsap="section-pricing">
        <div class="section-card">
            <div class="pricing-container">
                <!-- Header -->
                <header class="pricing-header">
                    <p class="section-eyebrow">{{ t.eyebrow }}</p>
                    <h2 class="section-title">{{ t.title }}</h2>
                    <p class="pricing-subtitle">{{ t.subtitle }}</p>
                </header>

                <!-- Two-column layout -->
                <div class="pricing-grid">
                    <!-- Development Card -->
                    <article class="pricing-card">
                        <div class="card-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5"/>
                            </svg>
                        </div>
                        <h3 class="card-title">{{ t.devTitle }}</h3>
                        <p class="card-desc">{{ t.devDesc }}</p>

                        <ul class="options-list">
                            <li v-for="opt in t.devOptions" :key="opt.label">
                                <span class="opt-label">{{ opt.label }}</span>
                                <span class="opt-desc">{{ opt.desc }}</span>
                            </li>
                        </ul>

                        <p class="card-note">{{ t.devNote }}</p>
                    </article>

                    <!-- Maintenance Card -->
                    <article class="pricing-card pricing-card-accent">
                        <div class="card-icon">
                            <svg viewBox="0 -960 960 960" fill="currentColor">
                                <path d="m370-80-16-128q-13-5-24.5-12T307-235l-119 50L78-375l103-78q-1-7-1-13.5v-27q0-6.5 1-13.5L78-585l110-190 119 50q11-8 23-15t24-12l16-128h220l16 128q13 5 24.5 12t22.5 15l119-50 110 190-103 78q1 7 1 13.5v27q0 6.5-2 13.5l103 78-110 190-118-50q-11 8-23 15t-24 12L590-80H370Zm70-80h79l14-106q31-8 57.5-23.5T639-327l99 41 39-68-86-65q5-14 7-29.5t2-31.5q0-16-2-31.5t-7-29.5l86-65-39-68-99 42q-22-23-48.5-38.5T533-694l-13-106h-79l-14 106q-31 8-57.5 23.5T321-633l-99-41-39 68 86 64q-5 15-7 30t-2 32q0 16 2 31t7 30l-86 65 39 68 99-42q22 23 48.5 38.5T427-266l13 106Zm42-180q58 0 99-41t41-99q0-58-41-99t-99-41q-59 0-99.5 41T342-480q0 58 40.5 99t99.5 41Zm-2-140Z"/>
                            </svg>
                        </div>
                        <h3 class="card-title">{{ t.maintTitle }}</h3>
                        <p class="card-desc">{{ t.maintDesc }}</p>

                        <ul class="features-list">
                            <li v-for="feature in t.maintFeatures" :key="feature">
                                <span class="check-icon">✓</span>
                                {{ feature }}
                            </li>
                        </ul>

                        <p class="card-note">{{ t.maintNote }}</p>
                    </article>
                </div>

                <!-- CTA -->
                <div class="pricing-cta">
                    <a :href="t.ctaPath" class="pricing-cta-btn">
                        {{ t.ctaText }}
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.pricing-section {
    background: var(--color-surface);
}

.pricing-container {
    max-width: 60rem;
    margin: 0 auto;
    padding: 5rem 1.5rem;
}

/* Header */
.pricing-header {
    text-align: center;
    max-width: 40rem;
    margin: 0 auto 3.5rem;
}

.pricing-subtitle {
    font-size: 1rem;
    line-height: 1.7;
    color: var(--color-text-muted);
    margin-top: 1rem;
}

/* Grid - 2 columns */
.pricing-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 3rem;
}

@media (max-width: 768px) {
    .pricing-grid {
        grid-template-columns: 1fr;
    }
}

/* Cards */
.pricing-card {
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    border-radius: 16px;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    transition: border-color 0.2s ease;
}

.pricing-card:hover {
    border-color: var(--color-border);
}

.pricing-card-accent {
    border-color: var(--color-violet);
}

.pricing-card-accent:hover {
    border-color: var(--color-violet-bright);
}

/* Card Icon */
.card-icon {
    width: 2.5rem;
    height: 2.5rem;
    margin-bottom: 1.25rem;
    color: var(--color-accent);
}

.pricing-card-accent .card-icon {
    color: var(--color-violet);
}

.card-icon svg {
    width: 100%;
    height: 100%;
}

/* Card Title */
.card-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 0.75rem;
}

/* Card Description */
.card-desc {
    font-size: 0.9375rem;
    line-height: 1.6;
    color: var(--color-text-muted);
    margin: 0 0 1.5rem;
}

/* Options List (Development card) */
.options-list {
    list-style: none;
    padding: 0;
    margin: 0 0 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.options-list li {
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
    font-size: 0.9375rem;
}

.opt-label {
    font-weight: 600;
    color: var(--color-text);
}

.opt-desc {
    font-size: 0.8125rem;
    color: var(--color-text-muted);
}

/* Features List (Maintenance card) */
.features-list {
    list-style: none;
    padding: 0;
    margin: 0 0 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.features-list li {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    font-size: 0.9375rem;
    color: var(--color-text-muted);
}

.check-icon {
    color: var(--color-violet);
    font-weight: 600;
    flex-shrink: 0;
}

/* Card Note */
.card-note {
    font-size: 0.8125rem;
    color: var(--color-text-dim);
    margin: auto 0 0;
    padding-top: 1.25rem;
    border-top: 1px solid var(--color-border-dim);
}

/* CTA */
.pricing-cta {
    text-align: center;
}

.pricing-cta-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 1.75rem;
    background: var(--color-accent);
    color: var(--color-on-accent);
    font-size: 0.9375rem;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    transition: background 0.2s ease, transform 0.15s ease;
}

.pricing-cta-btn:hover {
    background: var(--color-accent-dim);
    transform: translateY(-1px);
}

.pricing-cta-btn:active {
    transform: translateY(0);
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .pricing-card:hover,
    .pricing-cta-btn:hover {
        transform: none;
    }
}
</style>
