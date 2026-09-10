<template>
    <section id="services" data-gsap="section-services" class="services-section">
        <div class="section-card">
            <div class="services-inner">
                <!-- Header -->
                <header class="services-header">
                    <p class="section-eyebrow">{{ t.services_eyebrow }}</p>
                    <h2 class="services-title">
                        {{ isEn ? 'Custom software,' : 'Maatwerksoftware' }}
                        <span class="title-accent">{{ isEn ? ' tailored to you.' : ' op maat.' }}</span>
                    </h2>
                    <p class="services-subtitle">
                        {{ isEn
                            ? 'From idea to working application. Software that does exactly what your business needs, built by developers you speak to directly.'
                            : 'Van idee tot werkende applicatie. Software die precies doet wat jouw bedrijf nodig heeft, gebouwd door developers die je direct spreekt.'
                        }}
                    </p>
                </header>

                <!-- Featured Service -->
                <article
                    v-if="featuredService"
                    ref="featuredRef"
                    class="featured-card"
                    @mouseenter="isHeroHovered = true"
                    @mouseleave="isHeroHovered = false"
                >
                    <div class="featured-content">
                        <div class="featured-left">
                            <div class="featured-icon" v-html="ICONS[featuredService.icon]"></div>
                            <span class="featured-badge">{{ isEn ? 'Most requested' : 'Meest gevraagd' }}</span>
                            <h3 class="featured-title">{{ featuredService.title }}</h3>
                            <p class="featured-description">{{ featuredService.description }}</p>
                        </div>
                        <div class="featured-right">
                            <div class="featured-features">
                                <span v-for="feature in featuredService.features" :key="feature" class="featured-feature">
                                    {{ feature }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Hover reveal -->
                    <div class="featured-reveal" :class="{ 'is-active': isHeroHovered }">
                        <p class="reveal-text">{{ featuredService.detail }}</p>
                        <a :href="contactPath" class="reveal-cta">
                            {{ t.services_cta }}
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </article>

                <!-- Secondary Services Grid -->
                <div ref="gridRef" class="services-grid">
                    <article
                        v-for="(service, index) in secondaryServices"
                        :key="service.id"
                        class="service-card"
                        @mouseenter="hoveredId = service.id"
                        @mouseleave="hoveredId = null"
                    >
                        <!-- Default state -->
                        <div class="card-content" :class="{ 'is-hidden': hoveredId === service.id }">
                            <div class="card-icon" :style="{ color: getIconColor(index) }" v-html="ICONS[service.icon]"></div>
                            <h3 class="card-title">{{ service.title }}</h3>
                            <p class="card-description">{{ service.description }}</p>
                            <div class="card-features">
                                <span v-for="feature in service.features" :key="feature">{{ feature }}</span>
                            </div>
                        </div>

                        <!-- Hover state -->
                        <div class="card-hover" :class="{ 'is-visible': hoveredId === service.id }">
                            <p class="hover-detail">{{ service.detail }}</p>
                            <a :href="contactPath" class="hover-cta">
                                {{ isEn ? 'Learn more' : 'Meer info' }}
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const locale = window.__LOCALE__ || 'nl'
const isEn = locale === 'en'
const translations = window.__TRANSLATIONS__ || {}
const t = computed(() => translations[locale] || translations['nl'] || {})
const contactPath = isEn ? '/en/contact' : '/contact'

const hoveredId = ref(null)
const isHeroHovered = ref(false)
const gridRef = ref(null)
const featuredRef = ref(null)

const ICONS = {
    language: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-82q26-36 45-75t31-83H404q12 44 31 83t45 75Zm-104-16q-18-33-31.5-68.5T322-320H204q29 50 72.5 87t99.5 55Zm208 0q56-18 99.5-55t72.5-87H638q-9 38-22.5 73.5T584-178ZM170-400h136q-3-20-4.5-39.5T300-480q0-21 1.5-40.5T306-560H170q-5 20-7.5 39.5T160-480q0 21 2.5 40.5T170-400Zm216 0h188q3-20 4.5-39.5T580-480q0-21-1.5-40.5T574-560H386q-3 20-4.5 39.5T380-480q0 21 1.5 40.5T386-400Zm268 0h136q5-20 7.5-39.5T800-480q0-21-2.5-40.5T790-560H654q3 20 4.5 39.5T660-480q0 21-1.5 40.5T654-400Zm-16-240h118q-29-50-72.5-87T584-782q18 33 31.5 68.5T638-640Zm-234 0h152q-12-44-31-83t-45-75q-26 36-45 75t-31 83Zm-200 0h118q9-38 22.5-73.5T376-782q-56 18-99.5 55T204-640Z"/></svg>',
    admin_panel_settings: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M680-280q25 0 42.5-17.5T740-340q0-25-17.5-42.5T680-400q-25 0-42.5 17.5T620-340q0 25 17.5 42.5T680-280Zm0 120q31 0 57-14.5t42-38.5q-22-13-47-20t-52-7q-27 0-52 7t-47 20q16 24 42 38.5t57 14.5ZM480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v227q-19-8-39-14.5t-41-9.5v-147l-240-90-240 90v188q0 47 12.5 94t35 89.5Q310-290 342-254t71 60q11 32 29 61t41 52q-1 0-1.5.5t-1.5.5Zm200 0q-83 0-141.5-58.5T480-280q0-83 58.5-141.5T680-480q83 0 141.5 58.5T880-280q0 83-58.5 141.5T680-80ZM480-494Z"/></svg>',
    monitoring: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>',
    hub: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M240-40q-50 0-85-35t-35-85q0-50 35-85t85-35q14 0 26 3t23 8l57-71q-28-31-39-70t-5-78l-81-27q-17 25-43 40t-58 15q-50 0-85-35T0-580q0-50 35-85t85-35q50 0 85 35t35 85v8l81 28q20-36 53.5-61t75.5-32v-87q-39-11-64.5-42.5T360-840q0-50 35-85t85-35q50 0 85 35t35 85q0 42-26 73.5T510-724v87q42 7 75.5 32t53.5 61l81-28v-8q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-32 0-58.5-15T739-515l-81 27q6 39-5 77.5T614-340l57 70q11-5 23-7.5t26-2.5q50 0 85 35t35 85q0 50-35 85t-85 35q-50 0-85-35t-35-85q0-20 6.5-38.5T624-232l-57-71q-41 23-87.5 23T392-303l-56 71q11 15 17.5 33.5T360-160q0 50-35 85t-85 35ZM120-540q17 0 28.5-11.5T160-580q0-17-11.5-28.5T120-620q-17 0-28.5 11.5T80-580q0 17 11.5 28.5T120-540Zm120 420q17 0 28.5-11.5T280-160q0-17-11.5-28.5T240-200q-17 0-28.5 11.5T200-160q0 17 11.5 28.5T240-120Zm240-680q17 0 28.5-11.5T520-840q0-17-11.5-28.5T480-880q-17 0-28.5 11.5T440-840q0 17 11.5 28.5T480-800Zm0 440q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm240 240q17 0 28.5-11.5T760-160q0-17-11.5-28.5T720-200q-17 0-28.5 11.5T680-160q0 17 11.5 28.5T720-120Zm120-420q17 0 28.5-11.5T880-580q0-17-11.5-28.5T840-620q-17 0-28.5 11.5T800-580q0 17 11.5 28.5T840-540ZM480-840ZM120-580Zm360 120Zm360-120ZM240-160Zm480 0Z"/></svg>',
    payments: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/></svg>',
}

// Services data
const servicesNl = [
    {
        id: 1,
        icon: 'language',
        featured: true,
        title: "Websites en portfolio's",
        description: "Snelle, SEO-vriendelijke websites en portfolio's die converteren. Mobile-first en geoptimaliseerd voor Core Web Vitals.",
        detail: "Landingspagina's, bedrijfswebsites, portfolio's en campagnepagina's met goede semantiek, Core Web Vitals en duidelijke call-to-actions. Gebouwd om te presteren en te converteren.",
        features: ['SEO-geoptimaliseerd', 'Mobile-first', 'Snelle laadtijden'],
    },
    {
        id: 2,
        icon: 'admin_panel_settings',
        title: 'Adminpanelen',
        description: 'Vervang spreadsheets door echte tooling met rollen en rechten.',
        detail: 'Adminpanelen met rollen en rechten, goedkeuringsflows, voorraad en operationele tooling die past bij hoe je bedrijf werkt.',
        features: ['Rollen & rechten', 'Goedkeuringsflows', 'Audit trail'],
    },
    {
        id: 3,
        icon: 'monitoring',
        title: 'KPI-dashboards',
        description: 'Realtime inzicht in je bedrijfsdata met live cijfers en alerts.',
        detail: 'Dashboards met live data uit je stack. Filters, grafieken, PDF- of Excel-export en meldingen wanneer KPI\'s drempels passeren.',
        features: ['Live data', 'Exports', 'Slimme alerts'],
    },
    {
        id: 4,
        icon: 'payments',
        title: 'Betaalintegraties',
        description: 'Stripe en Mollie voor checkout, abonnementen en facturatie.',
        detail: 'Eenmalige betalingen, abonnementen, usage-based billing, klantportalen en webhook-afhandeling met retries.',
        features: ['Stripe & Mollie', 'Abonnementen', 'Facturatie'],
    },
    {
        id: 5,
        icon: 'hub',
        title: 'API-koppelingen',
        description: "REST API's, webhooks en synchronisaties tussen je systemen.",
        detail: "REST API's, webhooks en syncjobs tussen custom backends. Zodat je later van leverancier kunt wisselen zonder alles opnieuw te bouwen.",
        features: ["REST API's", 'Webhooks', 'Toekomstbestendig'],
    },
]

const servicesEn = [
    {
        id: 1,
        icon: 'language',
        featured: true,
        title: 'Websites and Portfolios',
        description: 'Fast, SEO-friendly websites and portfolios that convert. Mobile-first and optimized for Core Web Vitals.',
        detail: 'Landing pages, company websites, portfolios and campaign pages with solid semantics, Core Web Vitals and clear call-to-actions. Built to perform and convert.',
        features: ['SEO optimized', 'Mobile-first', 'Fast load times'],
    },
    {
        id: 2,
        icon: 'admin_panel_settings',
        title: 'Admin Panels',
        description: 'Replace spreadsheets with real tooling with roles and permissions.',
        detail: 'Admin panels with roles and permissions, approval workflows, inventory and operational tooling that fits how your business works.',
        features: ['Roles & permissions', 'Workflows', 'Audit trail'],
    },
    {
        id: 3,
        icon: 'monitoring',
        title: 'KPI Dashboards',
        description: 'Real-time insight into your business data with live metrics and alerts.',
        detail: 'Dashboards with live data from your stack. Filters, charts, PDF or Excel exports and notifications when KPIs cross thresholds.',
        features: ['Live data', 'Exports', 'Smart alerts'],
    },
    {
        id: 4,
        icon: 'payments',
        title: 'Payment Integrations',
        description: 'Stripe and Mollie for checkout, subscriptions and invoicing.',
        detail: 'One-time payments, subscriptions, usage-based billing, customer portals and webhook handling with retries.',
        features: ['Stripe & Mollie', 'Subscriptions', 'Invoicing'],
    },
    {
        id: 5,
        icon: 'hub',
        title: 'API Integrations',
        description: 'REST APIs, webhooks and synchronizations between your systems.',
        detail: 'REST APIs, webhooks and sync jobs between custom backends. So you can switch vendors later without rebuilding everything.',
        features: ['REST APIs', 'Webhooks', 'Future-proof'],
    },
]

const localizedServices = computed(() => isEn ? servicesEn : servicesNl)
const featuredService = computed(() => localizedServices.value.find(s => s.featured))
const secondaryServices = computed(() => localizedServices.value.filter(s => !s.featured))

const iconColors = [
    'var(--color-violet)',
    'var(--color-accent)',
    'var(--color-warm)',
    'var(--color-violet)',
]

function getIconColor(index) {
    return iconColors[index % iconColors.length]
}

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    if (featuredRef.value) {
        gsap.fromTo(featuredRef.value,
            { opacity: 0, y: 30 },
            {
                opacity: 1,
                y: 0,
                duration: 0.6,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: featuredRef.value,
                    start: 'top 85%',
                },
            }
        )
    }

    const cards = gridRef.value?.querySelectorAll('.service-card')
    if (cards?.length) {
        gsap.fromTo(cards,
            { opacity: 0, y: 25 },
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.08,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: gridRef.value,
                    start: 'top 85%',
                },
            }
        )
    }
})
</script>

<style scoped>
.services-section {
    padding: 0;
}

.section-card {
    background: var(--color-surface-1);
    border-radius: 1.25rem;
    margin: 0.75rem clamp(0.75rem, 3vw, 2.5rem);
    padding: clamp(2rem, 5vw, 4rem) clamp(1.5rem, 4vw, 3rem);
}

html[data-theme="light"] .section-card {
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04), 0 4px 12px -4px rgba(0, 0, 0, 0.06);
}

.services-inner {
    max-width: 72rem;
    margin: 0 auto;
}

/* Header */
.services-header {
    text-align: center;
    max-width: 40rem;
    margin: 0 auto 3rem;
}

.services-title {
    font-size: clamp(1.75rem, 4vw, 2.5rem);
    font-weight: 700;
    line-height: 1.2;
    letter-spacing: -0.02em;
    color: var(--color-text);
    margin: 0.75rem 0 1rem;
}

.title-accent {
    color: var(--color-accent);
}

.services-subtitle {
    font-size: clamp(0.9375rem, 1.5vw, 1.0625rem);
    line-height: 1.7;
    color: var(--color-text-muted);
}

/* Featured Card */
.featured-card {
    position: relative;
    background: var(--color-surface-2);
    border: 1px solid var(--color-accent);
    border-radius: 16px;
    padding: clamp(1.5rem, 3vw, 2.5rem);
    margin-bottom: 1.5rem;
    overflow: hidden;
    min-height: 180px;
}

.featured-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
    transition: opacity 0.25s ease;
}

@media (hover: hover) {
    .featured-card:hover .featured-content {
        opacity: 0;
    }
}

.featured-left {
    flex: 1;
    max-width: 32rem;
}

.featured-icon {
    width: 2.5rem;
    height: 2.5rem;
    color: var(--color-accent);
    margin-bottom: 1rem;
}

.featured-icon svg {
    width: 100%;
    height: 100%;
}

.featured-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: var(--color-accent);
    color: var(--color-on-accent);
    font-size: 0.6875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    border-radius: 4px;
    margin-bottom: 0.875rem;
}

.featured-title {
    font-size: clamp(1.25rem, 2.5vw, 1.5rem);
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 0.625rem;
    letter-spacing: -0.01em;
}

.featured-description {
    font-size: 0.9375rem;
    line-height: 1.65;
    color: var(--color-text-muted);
    margin: 0;
}

.featured-right {
    flex-shrink: 0;
}

.featured-features {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.featured-feature {
    padding: 0.375rem 0.875rem;
    background: transparent;
    border: 1px solid var(--color-accent);
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--color-accent);
    white-space: nowrap;
    text-align: center;
    transition: background 0.2s ease, color 0.2s ease;
}

@media (hover: hover) {
    .featured-feature:hover {
        background: var(--color-accent);
        color: var(--color-on-accent);
    }
}

/* Featured hover reveal */
.featured-reveal {
    position: absolute;
    inset: 0;
    background: var(--color-surface-2);
    padding: clamp(1.5rem, 3vw, 2.5rem);
    display: flex;
    flex-direction: column;
    justify-content: center;
    opacity: 0;
    transform: translateY(100%);
    transition: opacity 0.3s ease, transform 0.3s cubic-bezier(0.23, 1, 0.32, 1);
}

.featured-reveal.is-active {
    opacity: 1;
    transform: translateY(0);
}

.reveal-text {
    font-size: clamp(0.9375rem, 1.5vw, 1.0625rem);
    line-height: 1.7;
    color: var(--color-text);
    max-width: 42rem;
    margin: 0 0 1.5rem;
}

.reveal-cta {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    background: var(--color-accent);
    color: var(--color-on-accent);
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    border-radius: 8px;
    width: fit-content;
    transition: gap 0.2s ease, transform 0.2s ease;
}

.reveal-cta:hover {
    gap: 0.75rem;
    transform: translateY(-1px);
}

/* Secondary Services Grid */
.services-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 1rem;
}

@media (max-width: 1024px) {
    .services-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .featured-content {
        flex-direction: column;
    }

    .featured-right {
        width: 100%;
    }

    .featured-features {
        flex-direction: row;
        flex-wrap: wrap;
    }
}

@media (max-width: 640px) {
    .services-grid {
        grid-template-columns: 1fr;
    }
}

/* Service Card */
.service-card {
    position: relative;
    background: var(--color-surface-2);
    border: 1px solid var(--color-border-dim);
    border-radius: 12px;
    padding: 1.5rem;
    min-height: 220px;
    overflow: hidden;
    transition: border-color 0.2s ease;
}

@media (hover: hover) {
    .service-card:hover {
        border-color: var(--color-border);
    }
}

/* Card content */
.card-content {
    display: flex;
    flex-direction: column;
    height: 100%;
    transition: opacity 0.2s ease;
}

.card-content.is-hidden {
    opacity: 0;
}

.card-icon {
    width: 1.75rem;
    height: 1.75rem;
    margin-bottom: 1rem;
}

.card-icon svg {
    width: 100%;
    height: 100%;
}

.card-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 0.5rem;
}

.card-description {
    font-size: 0.8125rem;
    line-height: 1.6;
    color: var(--color-text-muted);
    margin: 0 0 auto;
    padding-bottom: 1rem;
}

.card-features {
    display: flex;
    flex-wrap: wrap;
    gap: 0.375rem;
    margin-top: auto;
}

.card-features span {
    padding: 0.25rem 0.5rem;
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    border-radius: 4px;
    font-size: 0.6875rem;
    color: var(--color-text-dim);
}

/* Card hover state */
.card-hover {
    position: absolute;
    inset: 0;
    background: var(--color-surface-2);
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    opacity: 0;
    transform: translateY(100%);
    pointer-events: none;
    transition: opacity 0.25s ease, transform 0.25s cubic-bezier(0.23, 1, 0.32, 1);
}

.card-hover.is-visible {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.hover-detail {
    font-size: 0.8125rem;
    line-height: 1.7;
    color: var(--color-text-muted);
    margin: 0;
}

.hover-cta {
    display: inline-flex;
    align-items: center;
    gap: 0.375rem;
    margin-top: auto;
    padding: 0.5rem 0.875rem;
    background: transparent;
    border: 1px solid var(--color-border);
    color: var(--color-text);
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    border-radius: 6px;
    width: fit-content;
    transition: all 0.2s ease;
}

.hover-cta:hover {
    background: var(--color-accent);
    border-color: var(--color-accent);
    color: var(--color-on-accent);
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .featured-reveal,
    .card-hover {
        transition: opacity 0.15s ease;
        transform: none;
    }

    .featured-reveal.is-active,
    .card-hover.is-visible {
        transform: none;
    }
}
</style>
