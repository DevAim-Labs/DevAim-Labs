<template>
    <section id="services" data-gsap="section-services" class="reveal-hidden">
        <div class="section-card">
            <div class="max-w-6xl mx-auto px-6 py-24">
                <header class="mb-16 text-center max-w-2xl mx-auto">
                    <p class="section-eyebrow mb-3">Maatwerksoftware</p>
                    <h2 class="section-title mb-4">Wat we voor je kunnen bouwen</h2>
                    <p class="text-sm md:text-base" style="color: var(--color-text-muted);">
                        Software die past bij hoe jouw bedrijf werkt.
                    </p>
                </header>

                <!-- Bento Grid with Code Cards -->
                <div ref="gridRef" class="bento-grid gap-5">
                    <CodeCard
                        v-for="(service, index) in services"
                        :key="service.id"
                        :title="service.icon"
                        :show-dots="true"
                        :colored-dots="true"
                        :spotlight="true"
                        :accent-color="getSpotlightColor(index)"
                        :class="[
                            'bento-item cursor-pointer',
                            service.featured ? 'bento-span-2' : '',
                        ]"
                        :style="{ minHeight: service.featured ? '300px' : '260px' }"
                        @click="selectService(service)"
                    >
                        <div class="h-full flex flex-col">
                            <!-- Header with icon and badge -->
                            <div class="flex items-start justify-between mb-5">
                                <div
                                    :class="service.featured ? 'text-3xl' : 'text-2xl'"
                                    class="inline-flex leading-none"
                                    :style="{ color: getIconColor(index) }"
                                    v-html="ICONS[service.icon]"
                                ></div>
                                <span
                                    v-if="service.featured"
                                    class="text-[10px] uppercase tracking-wide px-2.5 py-1 rounded-full font-medium"
                                    style="background: var(--color-accent-glow); color: var(--color-accent);"
                                >
                                    Populair
                                </span>
                            </div>

                            <!-- Content -->
                            <h3
                                :class="service.featured ? 'font-bold text-xl mb-3' : 'font-semibold text-lg mb-2'"
                                style="color: var(--color-text); font-family: var(--font-sans);"
                            >
                                {{ service.title }}
                            </h3>
                            <p
                                :class="service.featured ? 'text-sm leading-relaxed max-w-lg' : 'text-sm leading-relaxed'"
                                style="color: var(--color-text-muted); font-family: var(--font-body);"
                            >
                                {{ service.description }}
                            </p>

                            <!-- Feature badges for featured card -->
                            <div v-if="service.features" class="flex flex-wrap gap-2 mt-5">
                                <span
                                    v-for="feature in service.features.slice(0, service.featured ? 3 : 2)"
                                    :key="feature"
                                    class="px-2.5 py-1 rounded-md text-xs font-medium"
                                    style="background: var(--color-surface-2); color: var(--color-text-muted); border: 1px solid var(--color-border-dim);"
                                >
                                    {{ feature }}
                                </span>
                            </div>

                            <!-- Footer -->
                            <div class="mt-auto pt-5">
                                <span class="text-xs font-medium flex items-center gap-1.5 transition-colors" style="color: var(--color-accent);">
                                    Meer info
                                    <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </CodeCard>
                </div>

                <!-- Expanded detail view -->
                <div
                    v-if="selected"
                    ref="expandedRef"
                    class="mt-8 glass-card overflow-hidden"
                    style="opacity: 0;"
                >
                    <div class="flex flex-col md:flex-row" style="min-height: 420px;">
                        <!-- Left content -->
                        <div class="md:w-2/5 p-8 flex flex-col justify-between">
                            <div>
                                <button
                                    class="mb-8 text-xs uppercase tracking-widest flex items-center gap-2 transition-colors duration-200 hover:text-[var(--color-accent)]"
                                    style="color: var(--color-text-dim);"
                                    @click="closeExpanded"
                                >
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Terug naar overzicht
                                </button>

                                <div class="inline-flex text-5xl mb-6" style="color: var(--color-accent);" v-html="ICONS[selected.icon]"></div>
                                <h3 class="font-bold text-2xl mb-4 leading-snug" style="color: var(--color-text); font-family: var(--font-sans); letter-spacing: -0.02em;">
                                    {{ selected.title }}
                                </h3>
                                <p class="text-sm leading-relaxed mb-8" style="color: var(--color-text-muted); font-family: var(--font-body);">
                                    {{ selected.detail }}
                                </p>

                                <!-- Feature badges -->
                                <div v-if="selected.features" class="flex flex-wrap gap-2">
                                    <span
                                        v-for="feature in selected.features"
                                        :key="feature"
                                        class="px-3 py-1.5 rounded-lg text-xs font-medium border transition-all duration-200 hover:bg-[var(--color-accent)] hover:text-[var(--color-on-accent)] hover:border-[var(--color-accent)] cursor-default"
                                        style="border-color: var(--color-border); color: var(--color-text-muted); background: var(--color-surface-2);"
                                    >
                                        {{ feature }}
                                    </span>
                                </div>
                            </div>

                            <a
                                href="/contact"
                                class="btn-primary mt-8 inline-flex items-center gap-2 px-7 py-3.5 rounded-xl text-sm font-semibold self-start"
                                data-track="cta_click"
                                data-track-label="Start een project"
                                data-track-location="services_expanded"
                                style="box-shadow: 0 8px 24px -8px var(--color-accent-glow);"
                            >
                                Start een project
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </a>
                        </div>

                        <!-- Divider -->
                        <div class="hidden md:block w-px shrink-0" style="background: var(--color-border-dim);"></div>

                        <!-- Right preview -->
                        <div class="md:w-3/5 relative overflow-hidden" style="background: var(--color-surface-2); min-height: 280px;">
                            <a
                                v-if="selected.image"
                                :href="selected.demoUrl"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="group/preview absolute inset-0 block"
                                data-track="cta_click"
                                :data-track-label="'Bekijk live voorbeeld: ' + selected.title"
                                data-track-location="services_expanded"
                            >
                                <img
                                    :src="selected.image"
                                    :alt="'Voorbeeld: ' + selected.title"
                                    class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-500 group-hover/preview:scale-105"
                                >
                                <div class="absolute inset-0 transition-opacity duration-300 group-hover/preview:opacity-70" style="background: linear-gradient(to top, var(--color-surface) 0%, transparent 50%);"></div>
                                <div
                                    class="absolute bottom-6 left-6 inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold transition-transform duration-300 group-hover/preview:translate-x-1"
                                    style="background: var(--color-accent); color: var(--color-on-accent);"
                                >
                                    Bekijk live
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                </div>
                            </a>
                            <template v-else>
                                <div class="absolute inset-0 bg-grid opacity-20"></div>
                                <div class="absolute inset-0 gradient-mesh-subtle"></div>
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="inline-flex text-[12rem] leading-none select-none" style="color: var(--color-accent); opacity: 0.06;" v-html="ICONS[selected.icon]"></span>
                                </div>
                                <div class="absolute bottom-6 left-6 flex items-center gap-2 text-xs uppercase tracking-widest font-medium" style="color: var(--color-text-dim);">
                                    <span class="w-2 h-2 rounded-full animate-pulse" style="background: var(--color-accent);"></span>
                                    Preview binnenkort
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, nextTick, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import CodeCard from './ui/CodeCard.vue'

gsap.registerPlugin(ScrollTrigger)

// Material Symbols (Outlined, 24px)
const ICONS = {
    code: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M320-240 80-480l240-240 57 57-184 183 184 183-57 57Zm320 0-57-57 184-183-184-183 57-57 240 240-240 240Z"/></svg>',
    language: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-82q26-36 45-75t31-83H404q12 44 31 83t45 75Zm-104-16q-18-33-31.5-68.5T322-320H204q29 50 72.5 87t99.5 55Zm208 0q56-18 99.5-55t72.5-87H638q-9 38-22.5 73.5T584-178ZM170-400h136q-3-20-4.5-39.5T300-480q0-21 1.5-40.5T306-560H170q-5 20-7.5 39.5T160-480q0 21 2.5 40.5T170-400Zm216 0h188q3-20 4.5-39.5T580-480q0-21-1.5-40.5T574-560H386q-3 20-4.5 39.5T380-480q0 21 1.5 40.5T386-400Zm268 0h136q5-20 7.5-39.5T800-480q0-21-2.5-40.5T790-560H654q3 20 4.5 39.5T660-480q0 21-1.5 40.5T654-400Zm-16-240h118q-29-50-72.5-87T584-782q18 33 31.5 68.5T638-640Zm-234 0h152q-12-44-31-83t-45-75q-26 36-45 75t-31 83Zm-200 0h118q9-38 22.5-73.5T376-782q-56 18-99.5 55T204-640Z"/></svg>',
    admin_panel_settings: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M680-280q25 0 42.5-17.5T740-340q0-25-17.5-42.5T680-400q-25 0-42.5 17.5T620-340q0 25 17.5 42.5T680-280Zm0 120q31 0 57-14.5t42-38.5q-22-13-47-20t-52-7q-27 0-52 7t-47 20q16 24 42 38.5t57 14.5ZM480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v227q-19-8-39-14.5t-41-9.5v-147l-240-90-240 90v188q0 47 12.5 94t35 89.5Q310-290 342-254t71 60q11 32 29 61t41 52q-1 0-1.5.5t-1.5.5Zm200 0q-83 0-141.5-58.5T480-280q0-83 58.5-141.5T680-480q83 0 141.5 58.5T880-280q0 83-58.5 141.5T680-80ZM480-494Z"/></svg>',
    monitoring: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>',
    hub: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M240-40q-50 0-85-35t-35-85q0-50 35-85t85-35q14 0 26 3t23 8l57-71q-28-31-39-70t-5-78l-81-27q-17 25-43 40t-58 15q-50 0-85-35T0-580q0-50 35-85t85-35q50 0 85 35t35 85v8l81 28q20-36 53.5-61t75.5-32v-87q-39-11-64.5-42.5T360-840q0-50 35-85t85-35q50 0 85 35t35 85q0 42-26 73.5T510-724v87q42 7 75.5 32t53.5 61l81-28v-8q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-32 0-58.5-15T739-515l-81 27q6 39-5 77.5T614-340l57 70q11-5 23-7.5t26-2.5q50 0 85 35t35 85q0 50-35 85t-85 35q-50 0-85-35t-35-85q0-20 6.5-38.5T624-232l-57-71q-41 23-87.5 23T392-303l-56 71q11 15 17.5 33.5T360-160q0 50-35 85t-85 35ZM120-540q17 0 28.5-11.5T160-580q0-17-11.5-28.5T120-620q-17 0-28.5 11.5T80-580q0 17 11.5 28.5T120-540Zm120 420q17 0 28.5-11.5T280-160q0-17-11.5-28.5T240-200q-17 0-28.5 11.5T200-160q0 17 11.5 28.5T240-120Zm240-680q17 0 28.5-11.5T520-840q0-17-11.5-28.5T480-880q-17 0-28.5 11.5T440-840q0 17 11.5 28.5T480-800Zm0 440q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm240 240q17 0 28.5-11.5T760-160q0-17-11.5-28.5T720-200q-17 0-28.5 11.5T680-160q0 17 11.5 28.5T720-120Zm120-420q17 0 28.5-11.5T880-580q0-17-11.5-28.5T840-620q-17 0-28.5 11.5T800-580q0 17 11.5 28.5T840-540ZM480-840ZM120-580Zm360 120Zm360-120ZM240-160Zm480 0Z"/></svg>',
    payments: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/></svg>',
}

const services = [
    {
        id: 1,
        icon: 'code',
        featured: true,
        title: 'Maatwerksoftware op maat',
        description: 'Van idee tot werkende applicatie. Software die precies doet wat jouw bedrijf nodig heeft, gebouwd door developers die je direct spreekt.',
        detail: 'Wij bouwen software die past bij hoe jouw bedrijf werkt. Geen kant-en-klare pakketten met functies die je niet gebruikt, maar applicaties die precies doen wat nodig is. Van het eerste gesprek tot livegang werk je met dezelfde developers.',
        image: null,
        demoUrl: null,
        features: ['Korte lijnen', 'Iteratief bouwen', 'Volledige eigenaarschap'],
    },
    {
        id: 2,
        icon: 'language',
        title: 'Websites en portfolio\'s',
        description: 'Snelle, SEO-vriendelijke websites en portfolio\'s die converteren.',
        detail: 'Landingspagina\'s, bedrijfswebsites, portfolio\'s en campagnepagina\'s met goede semantiek, Core Web Vitals en duidelijke call-to-actions. Gebouwd om te presteren en te converteren.',
        image: '/service-previews/website.webp',
        demoUrl: '/demo/website.html',
        features: ['SEO-geoptimaliseerd', 'Mobile-first', 'Snelle laadtijden'],
    },
    {
        id: 3,
        icon: 'monitoring',
        title: 'KPI-dashboards',
        description: 'Realtime inzicht in je bedrijfsdata met live cijfers en alerts.',
        detail: 'Dashboards met live data uit je stack. Filters, grafieken, PDF- of Excel-export en meldingen wanneer KPI\'s drempels passeren. Eén centrale plek voor al je bedrijfscijfers.',
        image: '/service-previews/kpi.webp',
        demoUrl: '/demo/kpi-dashboard.html',
        features: ['Live data', 'Automatische exports', 'Slimme alerts'],
    },
    {
        id: 4,
        icon: 'admin_panel_settings',
        title: 'Adminpanelen',
        description: 'Vervang spreadsheets door echte tooling met rollen en rechten.',
        detail: 'Adminpanelen met rollen en rechten, goedkeuringsflows, voorraad en operationele tooling die past bij hoe je bedrijf werkt. Eén bron van waarheid in plaats van losse bestanden.',
        image: '/service-previews/adminpaneel.webp',
        demoUrl: '/demo/adminpaneel.html',
        features: ['Rollen & rechten', 'Goedkeuringsflows', 'Volledige audit trail'],
    },
    {
        id: 5,
        icon: 'payments',
        title: 'Betaalintegraties',
        description: 'Stripe en Mollie voor checkout, abonnementen en facturatie.',
        detail: 'Eenmalige betalingen, abonnementen, usage-based billing, klantportalen en webhook-afhandeling met retries. Productieklaar voor Nederlandse en internationale klanten.',
        image: '/service-previews/betaal.webp',
        demoUrl: '/demo/betaalsysteem.html',
        features: ['Stripe & Mollie', 'Abonnementen', 'Automatische facturatie'],
    },
    {
        id: 6,
        icon: 'hub',
        title: 'API-koppelingen',
        description: 'REST API\'s, webhooks en synchronisaties tussen je systemen.',
        detail: 'REST API\'s, webhooks en syncjobs tussen custom backends. Zodat je later van leverancier kunt wisselen zonder alles opnieuw te bouwen.',
        image: null,
        demoUrl: null,
        features: ['REST API\'s', 'Webhooks', 'Toekomstbestendig'],
    },
]

const selected = ref(null)
const gridRef = ref(null)
const expandedRef = ref(null)
let animating = false

const spotlightColors = ['accent', 'violet', 'accent', 'warm', 'accent', 'violet']
const iconColors = [
    'var(--color-accent)',
    'var(--color-violet)',
    'var(--color-accent)',
    'var(--color-warm)',
    'var(--color-accent)',
    'var(--color-violet)',
]

function getSpotlightColor(index) {
    return spotlightColors[index % spotlightColors.length]
}

function getIconColor(index) {
    return iconColors[index % iconColors.length]
}

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    const cards = gridRef.value?.querySelectorAll('.bento-item')
    if (!cards?.length) return

    gsap.fromTo(cards,
        { opacity: 0, y: 40, scale: 0.96 },
        {
            opacity: 1,
            y: 0,
            scale: 1,
            duration: 0.6,
            stagger: 0.1,
            ease: 'power2.out',
            scrollTrigger: {
                trigger: gridRef.value,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
        }
    )
})

function selectService(service) {
    if (animating || selected.value?.id === service.id) return
    animating = true

    gsap.to(gridRef.value, {
        opacity: 0,
        y: -20,
        duration: 0.25,
        ease: 'power2.in',
        onComplete: async () => {
            gridRef.value.style.display = 'none'
            selected.value = service
            await nextTick()
            gsap.fromTo(expandedRef.value,
                { opacity: 0, y: 30 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.4,
                    ease: 'power2.out',
                    onComplete: () => { animating = false }
                }
            )
        },
    })
}

function closeExpanded() {
    if (animating || !selected.value) return
    animating = true

    gsap.to(expandedRef.value, {
        opacity: 0,
        y: -20,
        duration: 0.25,
        ease: 'power2.in',
        onComplete: async () => {
            selected.value = null
            gridRef.value.style.display = ''
            gsap.set(gridRef.value, { opacity: 0, y: 30 })
            await nextTick()
            gsap.to(gridRef.value, {
                opacity: 1,
                y: 0,
                duration: 0.4,
                ease: 'power2.out',
                onComplete: () => { animating = false },
            })
        },
    })
}

function onKey(e) {
    if (e.key === 'Escape' && selected.value) closeExpanded()
}

onMounted(() => window.addEventListener('keydown', onKey))
onUnmounted(() => window.removeEventListener('keydown', onKey))
</script>
