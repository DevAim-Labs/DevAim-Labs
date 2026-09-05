<template>
    <section id="services" data-gsap="section-services" class="reveal-hidden">
        <div class="section-card">
        <div class="max-w-6xl mx-auto px-6 py-24">
            <div class="mb-16">
                <p class="section-eyebrow mb-3">Maatwerksoftware</p>
                <h2 class="text-4xl section-title">Wat we voor je kunnen bouwen</h2>
            </div>

            <div ref="gridRef" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
                <div
                    v-for="service in services"
                    :key="service.id"
                    :class="service.featured
                        ? 'sm:col-span-2 p-8 border-[var(--color-border)] hover:border-[var(--color-text-dim)]'
                        : 'p-6 border-[var(--color-border)] hover:border-[var(--color-text-dim)]'"
                    class="card-glow group relative rounded-xl border bg-[var(--color-surface)] transition-all duration-300 cursor-pointer select-none flex flex-col"
                    @click="selectService(service)"
                >
                    <div class="flex items-start justify-between mb-4">
                        <div :class="service.featured ? 'text-3xl' : 'text-2xl'" class="inline-flex leading-none" style="color: var(--color-accent)" v-html="ICONS[service.icon]"></div>
                        <span v-if="service.featured" class="text-[10px] uppercase tracking-wide px-2 py-0.5 rounded-full border" style="color: var(--color-accent); border-color: var(--color-accent);">Populair</span>
                    </div>
                    <h3 :class="service.featured ? 'font-bold text-base mb-2' : 'font-semibold text-sm mb-2'" style="color: var(--color-text)">{{ service.title }}</h3>
                    <p :class="service.featured ? 'text-sm leading-relaxed max-w-md' : 'text-sm leading-relaxed'" style="color: var(--color-text-muted)">{{ service.description }}</p>
                    <p class="mt-auto pt-4 text-xs" style="color: var(--color-accent);opacity:0.6">Klik voor meer →</p>
                </div>
            </div>

            <div
                v-if="selected"
                ref="expandedRef"
                class="card-glow rounded-xl border overflow-hidden"
                style="border-color: var(--color-border); background: var(--color-surface-1); opacity:0;"
            >
                <div class="flex flex-col md:flex-row" style="min-height:380px;">
                    <div class="md:w-1/4 p-8 flex flex-col justify-between">
                        <div>
                            <button
                                class="mb-8 text-xs uppercase tracking-widest flex items-center gap-2 transition-colors duration-200"
                                style="color: var(--color-text-dim);"
                                @mouseover="$event.currentTarget.style.color='var(--color-accent)'"
                                @mouseleave="$event.currentTarget.style.color='var(--color-text-dim)'"
                                @click="closeExpanded"
                            >← Terug</button>

                            <div class="inline-flex text-3xl mb-4" style="color: var(--color-accent)" v-html="ICONS[selected.icon]"></div>
                            <h3 class="font-bold text-xl mb-4 leading-snug" style="color: var(--color-text)">{{ selected.title }}</h3>
                            <p class="text-sm leading-relaxed" style="color: var(--color-text-muted)">{{ selected.detail }}</p>
                        </div>

                        <a
                            href="/contact"
                            class="btn-primary mt-8 inline-flex px-5 py-2.5 rounded-md text-sm font-semibold self-start"
                            data-track="cta_click"
                            data-track-label="Start een project"
                            data-track-location="services_expanded"
                            @click="closeExpanded"
                        >Start een project →</a>
                    </div>

                    <div class="hidden md:block w-px shrink-0" style="background: var(--color-border);"></div>

                    <div class="md:w-3/4 relative overflow-hidden" style="background: var(--color-surface-2); min-height:220px;">
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
                                class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-300 group-hover/preview:scale-[1.02]"
                            >
                            <div class="absolute inset-0 transition-colors duration-300" style="background: color-mix(in srgb, var(--color-surface) 35%, transparent);" aria-hidden="true"></div>
                            <div
                                class="absolute bottom-5 left-6 inline-flex items-center gap-2 px-3 py-1.5 rounded-md text-xs font-semibold"
                                style="background: var(--color-accent); color: var(--color-on-accent, #fff);"
                            >Bekijk live voorbeeld →</div>
                        </a>
                        <template v-else>
                            <div class="absolute inset-0 bg-grid opacity-20"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="inline-flex text-[10rem] leading-none select-none" style="color: var(--color-accent);opacity:0.12" v-html="ICONS[selected.icon]"></span>
                            </div>
                            <div class="absolute bottom-5 left-6 text-xs uppercase tracking-widest" style="color: var(--color-accent);opacity:0.45">Preview volgt binnenkort</div>
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

// Material Symbols (Outlined, 24px) — https://fonts.google.com/icons
const ICONS = {
    language: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-82q26-36 45-75t31-83H404q12 44 31 83t45 75Zm-104-16q-18-33-31.5-68.5T322-320H204q29 50 72.5 87t99.5 55Zm208 0q56-18 99.5-55t72.5-87H638q-9 38-22.5 73.5T584-178ZM170-400h136q-3-20-4.5-39.5T300-480q0-21 1.5-40.5T306-560H170q-5 20-7.5 39.5T160-480q0 21 2.5 40.5T170-400Zm216 0h188q3-20 4.5-39.5T580-480q0-21-1.5-40.5T574-560H386q-3 20-4.5 39.5T380-480q0 21 1.5 40.5T386-400Zm268 0h136q5-20 7.5-39.5T800-480q0-21-2.5-40.5T790-560H654q3 20 4.5 39.5T660-480q0 21-1.5 40.5T654-400Zm-16-240h118q-29-50-72.5-87T584-782q18 33 31.5 68.5T638-640Zm-234 0h152q-12-44-31-83t-45-75q-26 36-45 75t-31 83Zm-200 0h118q9-38 22.5-73.5T376-782q-56 18-99.5 55T204-640Z"/></svg>',
    admin_panel_settings: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M680-280q25 0 42.5-17.5T740-340q0-25-17.5-42.5T680-400q-25 0-42.5 17.5T620-340q0 25 17.5 42.5T680-280Zm0 120q31 0 57-14.5t42-38.5q-22-13-47-20t-52-7q-27 0-52 7t-47 20q16 24 42 38.5t57 14.5ZM480-80q-139-35-229.5-159.5T160-516v-244l320-120 320 120v227q-19-8-39-14.5t-41-9.5v-147l-240-90-240 90v188q0 47 12.5 94t35 89.5Q310-290 342-254t71 60q11 32 29 61t41 52q-1 0-1.5.5t-1.5.5Zm200 0q-83 0-141.5-58.5T480-280q0-83 58.5-141.5T680-480q83 0 141.5 58.5T880-280q0 83-58.5 141.5T680-80ZM480-494Z"/></svg>',
    monitoring: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M120-120v-80l80-80v160h-80Zm160 0v-240l80-80v320h-80Zm160 0v-320l80 81v239h-80Zm160 0v-239l80-80v319h-80Zm160 0v-400l80-80v480h-80ZM120-327v-113l280-280 160 160 280-280v113L560-447 400-607 120-327Z"/></svg>',
    hub: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M240-40q-50 0-85-35t-35-85q0-50 35-85t85-35q14 0 26 3t23 8l57-71q-28-31-39-70t-5-78l-81-27q-17 25-43 40t-58 15q-50 0-85-35T0-580q0-50 35-85t85-35q50 0 85 35t35 85v8l81 28q20-36 53.5-61t75.5-32v-87q-39-11-64.5-42.5T360-840q0-50 35-85t85-35q50 0 85 35t35 85q0 42-26 73.5T510-724v87q42 7 75.5 32t53.5 61l81-28v-8q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-32 0-58.5-15T739-515l-81 27q6 39-5 77.5T614-340l57 70q11-5 23-7.5t26-2.5q50 0 85 35t35 85q0 50-35 85t-85 35q-50 0-85-35t-35-85q0-20 6.5-38.5T624-232l-57-71q-41 23-87.5 23T392-303l-56 71q11 15 17.5 33.5T360-160q0 50-35 85t-85 35ZM120-540q17 0 28.5-11.5T160-580q0-17-11.5-28.5T120-620q-17 0-28.5 11.5T80-580q0 17 11.5 28.5T120-540Zm120 420q17 0 28.5-11.5T280-160q0-17-11.5-28.5T240-200q-17 0-28.5 11.5T200-160q0 17 11.5 28.5T240-120Zm240-680q17 0 28.5-11.5T520-840q0-17-11.5-28.5T480-880q-17 0-28.5 11.5T440-840q0 17 11.5 28.5T480-800Zm0 440q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm240 240q17 0 28.5-11.5T760-160q0-17-11.5-28.5T720-200q-17 0-28.5 11.5T680-160q0 17 11.5 28.5T720-120Zm120-420q17 0 28.5-11.5T880-580q0-17-11.5-28.5T840-620q-17 0-28.5 11.5T800-580q0 17 11.5 28.5T840-540ZM480-840ZM120-580Zm360 120Zm360-120ZM240-160Zm480 0Z"/></svg>',
    payments: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z"/></svg>',
}

const services = [
    {
        id: 1,
        icon: 'language',
        featured: true,
        title: 'Websites en landingspagina\'s',
        description: 'Landingspagina laten maken. Snelle, SEO-vriendelijke sites die converteren.',
        detail: 'Landingspagina\'s, bedrijfswebsites en campagnepagina\'s met goede semantiek, Core Web Vitals en duidelijke call-to-actions.',
        image: '/service-previews/website.webp',
        demoUrl: '/demo/website.html',
    },
    {
        id: 2,
        icon: 'admin_panel_settings',
        title: 'Adminpanelen en interne tools',
        description: 'Adminpaneel bouwen met Laravel en Vue. Spreadsheets vervangen door echt tooling.',
        detail: 'Adminpanelen met rollen en rechten, goedkeuringsflows, voorraad en operationele tooling die past bij hoe je bedrijf werkt: één bron van waarheid in plaats van losse bestanden.',
        image: '/service-previews/adminpaneel.webp',
        demoUrl: '/demo/adminpaneel.html',
    },
    {
        id: 3,
        icon: 'monitoring',
        title: 'KPI-dashboards en rapportages',
        description: 'KPI-dashboard voor bedrijfsrapportages met realtime inzicht en alerts.',
        detail: 'Dashboards met live data uit je stack. Filters, grafieken, PDF- of Excel-export en meldingen wanneer KPI\'s drempels passeren.',
        image: '/service-previews/kpi.webp',
        demoUrl: '/demo/kpi-dashboard.html',
    },
    {
        id: 4,
        icon: 'hub',
        title: 'API-integraties',
        description: 'API-koppelingen tussen andere systemen.',
        detail: 'REST API\'s, webhooks en syncjobs tussen custom backends. Zo kun je later van leverancier wisselen zonder alles opnieuw te bouwen.',
        image: null,
    },
    {
        id: 5,
        icon: 'payments',
        title: 'Betaalsystemen',
        description: 'Stripe- en Mollie-integratie webshop, checkout, abonnementen en facturatie.',
        detail: 'Eenmalige betalingen, abonnementen, usage-based billing, klantportalen en webhook-afhandeling met retries. Productieklaar voor Nederlandse en internationale klanten.',
        image: '/service-previews/betaal.webp',
        demoUrl: '/demo/betaalsysteem.html',
    },
]

const selected    = ref(null)
const gridRef     = ref(null)
const expandedRef = ref(null)
let animating     = false

function selectService(service) {
    if (animating || selected.value?.id === service.id) return
    animating = true
    gsap.to(gridRef.value, {
        opacity: 0, y: -10, duration: 0.18, ease: 'power2.in',
        onComplete: async () => {
            gridRef.value.style.display = 'none'
            selected.value = service
            await nextTick()
            gsap.fromTo(expandedRef.value,
                { opacity: 0, y: 14 },
                { opacity: 1, y: 0, duration: 0.28, ease: 'power2.out',
                  onComplete: () => { animating = false } }
            )
        },
    })
}

function closeExpanded() {
    if (animating || !selected.value) return
    animating = true
    gsap.to(expandedRef.value, {
        opacity: 0, y: -10, duration: 0.18, ease: 'power2.in',
        onComplete: async () => {
            selected.value = null
            gridRef.value.style.display = ''
            gsap.set(gridRef.value, { opacity: 0, y: 14 })
            await nextTick()
            gsap.to(gridRef.value, {
                opacity: 1, y: 0, duration: 0.28, ease: 'power2.out',
                onComplete: () => { animating = false },
            })
        },
    })
}

function onKey(e) {
    if (e.key === 'Escape' && selected.value) closeExpanded()
}

onMounted(()   => window.addEventListener('keydown', onKey))
onUnmounted(() => window.removeEventListener('keydown', onKey))
</script>
