<script setup>
import { computed } from 'vue'

const locale = window.__LOCALE__ || 'nl'
const isEn = locale === 'en'

const t = computed(() => ({
    eyebrow: isEn ? 'Pricing' : 'Tarieven',
    title: isEn ? 'Flexible pricing, tailored to your project.' : 'Flexibele tarieven, afgestemd op jouw project.',
    subtitle: isEn
        ? 'Every project is unique. We work with you to find the pricing model that fits best.'
        : 'Elk project is uniek. We bepalen samen welk model het beste past bij jouw situatie.',
    negotiable: isEn ? 'Pricing negotiable per project' : 'Prijs in overleg per project',
    ctaText: isEn ? 'Discuss your project' : 'Bespreek je project',
    ctaPath: isEn ? '/en/contact' : '/contact',
}))

const pricingModels = computed(() => isEn ? [
    {
        id: 'fixed',
        icon: 'package',
        title: 'Fixed Price',
        description: 'Complete project for a fixed amount. Clear scope, clear price. Ideal for well-defined projects with a clear end goal.',
        benefits: ['Budget certainty', 'Clear milestones', 'No surprises'],
        highlight: 'Most popular'
    },
    {
        id: 'phased',
        icon: 'layers',
        title: 'Per Phase',
        description: 'Pay per milestone or sprint. Flexible approach where you only commit to the next phase. Perfect for projects that may evolve.',
        benefits: ['Flexibility', 'Lower initial investment', 'Iterative development'],
        highlight: null
    },
    {
        id: 'hourly',
        icon: 'clock',
        title: 'Hourly Rate',
        description: 'Pay for actual hours worked. Ideal for ongoing support, maintenance, or projects with changing requirements.',
        benefits: ['Maximum flexibility', 'Scale up or down', 'Transparent billing'],
        highlight: null
    }
] : [
    {
        id: 'fixed',
        icon: 'package',
        title: 'Vaste Prijs',
        description: 'Compleet project voor een vast bedrag. Duidelijke scope, duidelijke prijs. Ideaal voor goed afgebakende projecten met een helder einddoel.',
        benefits: ['Budgetzekerheid', 'Duidelijke milestones', 'Geen verrassingen'],
        highlight: 'Meest gekozen'
    },
    {
        id: 'phased',
        icon: 'layers',
        title: 'Per Fase',
        description: 'Betaal per milestone of sprint. Flexibele aanpak waarbij je steeds alleen de volgende fase afneemt. Perfect voor projecten die kunnen evolueren.',
        benefits: ['Flexibiliteit', 'Lagere initiële investering', 'Iteratief ontwikkelen'],
        highlight: null
    },
    {
        id: 'hourly',
        icon: 'clock',
        title: 'Uurtarief',
        description: 'Betaal voor daadwerkelijk gewerkte uren. Ideaal voor doorlopende ondersteuning, onderhoud, of projecten met wisselende eisen.',
        benefits: ['Maximale flexibiliteit', 'Op- en afschalen', 'Transparante facturatie'],
        highlight: null
    }
])

const ICONS = {
    package: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <path d="M16.5 9.4l-9-5.19M21 16V8a2 2 0 00-1-1.73l-7-4a2 2 0 00-2 0l-7 4A2 2 0 003 8v8a2 2 0 001 1.73l7 4a2 2 0 002 0l7-4A2 2 0 0021 16z"/>
        <path d="M3.27 6.96L12 12.01l8.73-5.05M12 22.08V12"/>
    </svg>`,
    layers: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <polygon points="12 2 2 7 12 12 22 7 12 2"/>
        <polyline points="2 17 12 22 22 17"/>
        <polyline points="2 12 12 17 22 12"/>
    </svg>`,
    clock: `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
        <circle cx="12" cy="12" r="10"/>
        <polyline points="12 6 12 12 16 14"/>
    </svg>`
}
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

                <!-- Pricing Models -->
                <div class="pricing-grid">
                    <article
                        v-for="model in pricingModels"
                        :key="model.id"
                        class="pricing-card"
                        :class="{ 'pricing-card-featured': model.highlight }"
                    >
                        <!-- Highlight badge -->
                        <span v-if="model.highlight" class="pricing-badge">
                            {{ model.highlight }}
                        </span>

                        <!-- Icon -->
                        <div class="pricing-icon" v-html="ICONS[model.icon]"></div>

                        <!-- Title -->
                        <h3 class="pricing-title">{{ model.title }}</h3>

                        <!-- Description -->
                        <p class="pricing-description">{{ model.description }}</p>

                        <!-- Benefits -->
                        <ul class="pricing-benefits">
                            <li v-for="benefit in model.benefits" :key="benefit">
                                <span class="benefit-check">✓</span>
                                {{ benefit }}
                            </li>
                        </ul>

                        <!-- Price note -->
                        <p class="pricing-note">{{ t.negotiable }}</p>
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
    max-width: 72rem;
    margin: 0 auto;
    padding: 5rem 1.5rem;
}

/* Header */
.pricing-header {
    text-align: center;
    max-width: 40rem;
    margin: 0 auto 4rem;
}

.pricing-subtitle {
    font-size: 1rem;
    line-height: 1.7;
    color: var(--color-text-muted);
    margin-top: 1rem;
}

/* Grid */
.pricing-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1.5rem;
    margin-bottom: 3rem;
}

@media (max-width: 1024px) {
    .pricing-grid {
        grid-template-columns: 1fr;
        max-width: 28rem;
        margin-left: auto;
        margin-right: auto;
    }
}

/* Cards */
.pricing-card {
    position: relative;
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    border-radius: 12px;
    padding: 2rem;
    display: flex;
    flex-direction: column;
    transition: border-color 0.2s ease, transform 0.2s ease;
}

.pricing-card:hover {
    border-color: var(--color-border);
    transform: translateY(-2px);
}

.pricing-card-featured {
    border-color: var(--color-accent);
}

.pricing-card-featured:hover {
    border-color: var(--color-accent);
}

/* Badge */
.pricing-badge {
    position: absolute;
    top: -0.75rem;
    left: 1.5rem;
    padding: 0.25rem 0.75rem;
    background: var(--color-accent);
    color: var(--color-on-accent);
    font-size: 0.6875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border-radius: 4px;
}

/* Icon */
.pricing-icon {
    width: 2.5rem;
    height: 2.5rem;
    color: var(--color-accent);
    margin-bottom: 1.5rem;
}

.pricing-icon svg {
    width: 100%;
    height: 100%;
}

/* Title */
.pricing-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 0.75rem;
}

/* Description */
.pricing-description {
    font-size: 0.9375rem;
    line-height: 1.6;
    color: var(--color-text-muted);
    margin: 0 0 1.5rem;
    flex-grow: 1;
}

/* Benefits */
.pricing-benefits {
    list-style: none;
    padding: 0;
    margin: 0 0 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.pricing-benefits li {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    color: var(--color-text-muted);
}

.benefit-check {
    color: var(--color-accent);
    font-weight: 600;
}

/* Price note */
.pricing-note {
    font-size: 0.8125rem;
    color: var(--color-text-dim);
    font-style: italic;
    margin: 0;
    padding-top: 1rem;
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
