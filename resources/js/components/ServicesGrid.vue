<template>
    <section id="services" data-gsap="section-services" class="services-section">
        <div class="section-card">
            <div class="services-inner">
                <!-- Header -->
                <header class="services-header">
                    <p class="section-eyebrow">{{ t.services_eyebrow }}</p>
                    <h2 class="services-title">
                        {{ isEn ? 'Custom software,' : 'Maatwerksoftware' }}
                        <span class="title-accent">{{ isEn ? ' tailored to you.' : ' voor jou.' }}</span>
                    </h2>
                    <p class="services-subtitle">
                        {{ isEn
                            ? 'From idea to working application. Software that does exactly what your business needs, built by developers you speak to directly.'
                            : 'Van idee tot werkende applicatie. Software die precies doet wat jouw bedrijf nodig heeft, gebouwd door developers die je direct spreekt.'
                        }}
                    </p>
                </header>

                <!-- Hover/tap-to-expand service list -->
                <div ref="listRef" class="services-list">
                    <div class="services-list-rule" aria-hidden="true"></div>
                    <template v-for="(service, i) in localizedServices" :key="service.id">
                        <div
                            class="service-row"
                            :class="{ 'is-active': activeId === service.id, 'is-dimmed': activeId !== null && activeId !== service.id }"
                            @mouseenter="onHoverStart(service.id)"
                            @mouseleave="onHoverEnd(service.id)"
                            @click="onRowClick(service.id)"
                        >
                            <div class="service-row-media" aria-hidden="true">
                                <img
                                    v-if="service.image"
                                    :src="service.image"
                                    alt=""
                                    loading="lazy"
                                    decoding="async"
                                >
                                <div v-else-if="service.beam" class="service-row-media-beam">
                                    <IntegrationsBeam />
                                </div>
                                <div v-else class="service-row-media-fallback">
                                    <span v-html="ICONS[service.icon]"></span>
                                </div>
                                <div class="service-row-overlay"></div>
                            </div>

                            <div class="service-row-content">
                                <div class="service-row-info">
                                    <span class="service-row-index">{{ String(i + 1).padStart(2, '0') }}</span>
                                    <span class="service-row-title">{{ service.title }}</span>
                                    <span class="service-row-desc">{{ service.description }}</span>
                                </div>

                                <div class="service-row-actions">
                                    <a
                                        :href="service.pageUrl"
                                        class="btn-hover service-row-cta"
                                        data-track="link_click"
                                        :data-track-label="isEn ? 'Learn more' : 'Meer info'"
                                        :data-track-location="'services_' + service.id"
                                        :aria-label="(isEn ? 'Learn more about: ' : 'Meer info over: ') + service.title"
                                        @click.stop
                                    >
                                        <span class="btn-hover__dot" aria-hidden="true"></span>
                                        <span class="btn-hover__label">{{ isEn ? 'Learn more' : 'Meer info' }}</span>
                                        <span class="btn-hover__reveal" aria-hidden="true">
                                            <span>{{ isEn ? 'Learn more' : 'Meer info' }}</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </span>
                                    </a>
                                    <a
                                        :href="service.demoUrl"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn-hover btn-hover-primary service-row-cta"
                                        data-track="cta_click"
                                        :data-track-label="isEn ? 'Check out demo' : 'Bekijk demo'"
                                        :data-track-location="'services_' + service.id"
                                        :aria-label="(isEn ? 'Check out demo: ' : 'Bekijk demo: ') + service.title"
                                        @click.stop
                                    >
                                        <span class="btn-hover__dot" aria-hidden="true"></span>
                                        <span class="btn-hover__label" aria-hidden="true">{{ isEn ? 'Check out demo' : 'Bekijk demo' }}</span>
                                        <span class="btn-hover__reveal" aria-hidden="true">
                                            <span>{{ isEn ? 'Check out demo' : 'Bekijk demo' }}</span>
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="services-list-rule" aria-hidden="true"></div>
                    </template>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import IntegrationsBeam from './ui/IntegrationsBeam.vue'

gsap.registerPlugin(ScrollTrigger)

const locale = window.__LOCALE__ || 'nl'
const isEn = locale === 'en'
const translations = window.__TRANSLATIONS__ || {}
const t = computed(() => translations[locale] || translations['nl'] || {})

const listRef = ref(null)
const activeId = ref(null)

function hoverCapable() {
    return window.matchMedia('(hover: hover)').matches
}

function onHoverStart(id) {
    if (hoverCapable()) activeId.value = id
}

function onHoverEnd(id) {
    if (hoverCapable() && activeId.value === id) activeId.value = null
}

function onRowClick(id) {
    // Hover-capable devices already get this via mouseenter/mouseleave —
    // a click there is just a click, not a toggle. Touch devices have no
    // hover, so tapping a row is how they open/close it.
    if (hoverCapable()) return
    activeId.value = activeId.value === id ? null : id
}

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
        description: "Snelle, SEO-vriendelijke websites die converteren.",
        image: '/service-previews/website.webp',
        demoUrl: '/demo/website.html',
        pageUrl: '/diensten/websites',
    },
    {
        id: 2,
        icon: 'admin_panel_settings',
        title: 'Adminpanelen',
        description: 'Vervang spreadsheets door echte tooling met rollen en rechten.',
        image: '/service-previews/adminpaneel.webp',
        demoUrl: '/demo/adminpaneel.html',
        pageUrl: '/diensten/adminpanelen',
    },
    {
        id: 3,
        icon: 'monitoring',
        title: 'KPI-dashboards',
        description: 'Realtime inzicht in je bedrijfsdata met live cijfers en alerts.',
        image: '/service-previews/kpi.webp',
        demoUrl: '/demo/kpi-dashboard.html',
        pageUrl: '/diensten/dashboards',
    },
    {
        id: 4,
        icon: 'payments',
        title: 'Betaalintegraties',
        description: 'Stripe en Mollie voor checkout, abonnementen en facturatie.',
        image: '/service-previews/betaal.webp',
        demoUrl: '/demo/betaalsysteem.html',
        pageUrl: '/diensten/betalingen',
    },
    {
        id: 5,
        icon: 'hub',
        title: 'API-koppelingen',
        description: "REST API's, webhooks en synchronisaties tussen je systemen.",
        image: null,
        beam: true,
        demoUrl: '/demo/',
        pageUrl: '/diensten/api-integraties',
    },
]

const servicesEn = [
    {
        id: 1,
        icon: 'language',
        featured: true,
        title: 'Websites and Portfolios',
        description: 'Fast, SEO-friendly websites that convert.',
        image: '/service-previews/website.webp',
        demoUrl: '/demo/website.html',
        pageUrl: '/en/services/websites',
    },
    {
        id: 2,
        icon: 'admin_panel_settings',
        title: 'Admin Panels',
        description: 'Replace spreadsheets with real tooling with roles and permissions.',
        image: '/service-previews/adminpaneel.webp',
        demoUrl: '/demo/adminpaneel.html',
        pageUrl: '/en/services/admin-panels',
    },
    {
        id: 3,
        icon: 'monitoring',
        title: 'KPI Dashboards',
        description: 'Real-time insight into your business data with live metrics and alerts.',
        image: '/service-previews/kpi.webp',
        demoUrl: '/demo/kpi-dashboard.html',
        pageUrl: '/en/services/dashboards',
    },
    {
        id: 4,
        icon: 'payments',
        title: 'Payment Integrations',
        description: 'Stripe and Mollie for checkout, subscriptions and invoicing.',
        image: '/service-previews/betaal.webp',
        demoUrl: '/demo/betaalsysteem.html',
        pageUrl: '/en/services/payments',
    },
    {
        id: 5,
        icon: 'hub',
        title: 'API Integrations',
        description: 'REST APIs, webhooks and synchronizations between your systems.',
        image: null,
        beam: true,
        demoUrl: '/demo/',
        pageUrl: '/en/services/api-integrations',
    },
]

const localizedServices = computed(() => isEn ? servicesEn : servicesNl)

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    const rows = listRef.value?.querySelectorAll('.service-row')
    if (rows?.length) {
        gsap.fromTo(rows,
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.06,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: listRef.value,
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
    max-width: 60rem;
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

/* ── Hover/tap-to-expand list ── */
.services-list {
    display: flex;
    flex-direction: column;
    margin-top: 1rem;
}

.services-list-rule {
    border-top: 1px solid var(--color-border-dim);
}

.service-row {
    position: relative;
    overflow: hidden;
    height: 4.5rem;
    cursor: pointer;
    transition: height 0.45s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.25s ease;
}

.service-row.is-active {
    height: 20rem;
}

.service-row.is-dimmed {
    opacity: 0.4;
}

@media (prefers-reduced-motion: reduce) {
    .service-row {
        transition: opacity 0.2s ease;
    }
}

/* Background media */
.service-row-media {
    position: absolute;
    inset: 0;
    opacity: 0;
    transform: scale(1.06);
    transition: opacity 0.5s cubic-bezier(0.23, 1, 0.32, 1), transform 0.6s cubic-bezier(0.23, 1, 0.32, 1);
}

.service-row.is-active .service-row-media {
    opacity: 1;
    transform: scale(1);
}

.service-row-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.service-row-media-fallback {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-surface-2);
}

.service-row-media-beam {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background: var(--color-surface-2);
}

.service-row-media-fallback span {
    display: block;
    width: 4rem;
    height: 4rem;
    color: var(--color-accent);
    opacity: 0.25;
}

.service-row-media-fallback span :deep(svg) {
    width: 100%;
    height: 100%;
}

.service-row-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.78), rgba(0, 0, 0, 0.25) 55%, transparent);
}

/* Foreground content */
.service-row-content {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1.25rem;
    padding: 0 0.25rem;
}

.service-row.is-active .service-row-content {
    align-items: flex-end;
    padding: 1.25rem 0.25rem;
}

.service-row-info {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 0.75rem;
    min-width: 0;
}

.service-row-index {
    font-size: 0.8125rem;
    font-variant-numeric: tabular-nums;
    color: var(--color-text-dim);
    flex-shrink: 0;
    transition: color 0.3s ease;
}

.service-row.is-active .service-row-index {
    color: rgba(255, 255, 255, 0.55);
}

.service-row-title {
    font-size: clamp(1.0625rem, 2vw, 1.5rem);
    font-weight: 700;
    letter-spacing: -0.01em;
    color: var(--color-text);
    transition: color 0.3s ease;
}

.service-row.is-active .service-row-title {
    color: #fff;
}

.service-row-badge {
    flex-shrink: 0;
    padding: 0.2rem 0.625rem;
    border-radius: 999px;
    font-size: 0.6875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    background: var(--color-accent);
    color: var(--color-on-accent);
}

.service-row-desc {
    color: rgba(255, 255, 255, 0.75);
    font-size: 0.875rem;
    opacity: 0;
    transform: translateX(-8px);
    transition: opacity 0.35s ease, transform 0.35s ease;
}

.service-row.is-active .service-row-desc {
    opacity: 1;
    transform: translateX(0);
}

.service-row-actions {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    flex-shrink: 0;
    opacity: 0;
    transform: translateY(8px);
    transition: opacity 0.3s ease, transform 0.3s ease;
    pointer-events: none;
    margin-right: 0.5rem;
}

.service-row.is-active .service-row-actions {
    opacity: 1;
    transform: translateY(0);
    pointer-events: auto;
}

.service-row-cta {
    flex-shrink: 0;
    padding: 0.625rem 1.25rem;
    font-size: 0.8125rem;
}

@media (prefers-reduced-motion: reduce) {
    .service-row-media,
    .service-row-index,
    .service-row-title,
    .service-row-desc,
    .service-row-actions,
    .service-row-cta {
        transition: none;
    }
}

@media (max-width: 640px) {
    .service-row.is-active {
        height: 17rem;
    }

    .service-row-info {
        gap: 0.5rem;
    }

    .service-row-desc {
        display: block;
        width: 100%;
        margin-top: 0.25rem;
    }

    .service-row-actions {
        flex-direction: row;
        gap: 0.5rem;
        align-items: center;
        margin-right: 0;
    }

    .service-row-cta {
        padding: 0.4rem 0.75rem;
        font-size: 0.75rem;
    }
}
</style>
