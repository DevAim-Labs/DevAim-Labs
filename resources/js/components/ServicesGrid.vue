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
                    class="card-glow group relative p-6 rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)] hover:border-[var(--color-accent)]/30 transition-all duration-300 cursor-pointer select-none flex flex-col"
                    @click="selectService(service)"
                >
                    <div class="mb-4 text-2xl leading-none" style="color: var(--color-accent)">{{ service.icon }}</div>
                    <h3 class="font-semibold text-sm mb-2" style="color: var(--color-text)">{{ service.title }}</h3>
                    <p class="text-sm leading-relaxed" style="color: var(--color-text-muted)">{{ service.description }}</p>
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

                            <div class="text-3xl mb-4" style="color: var(--color-accent)">{{ selected.icon }}</div>
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
                        <img
                            v-if="selected.image"
                            :src="selected.image"
                            :alt="selected.title"
                            class="absolute inset-0 w-full h-full object-cover"
                        >
                        <template v-else>
                            <div class="absolute inset-0 bg-grid opacity-20"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <span class="text-[10rem] leading-none select-none" style="color: var(--color-accent);opacity:0.12">{{ selected.icon }}</span>
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

const services = [
    {
        id: 1,
        icon: '◈',
        title: 'Websites & landingspagina\'s',
        description: 'Landingspagina laten maken. Snelle, SEO-vriendelijke sites die converteren.',
        detail: 'Landingspagina\'s, bedrijfswebsites en campagnepagina\'s met goede semantiek, Core Web Vitals en duidelijke call-to-actions.',
        image: null,
    },
    {
        id: 2,
        icon: '▦',
        title: 'Adminpanelen & interne tools',
        description: 'Adminpaneel bouwen met Laravel en Vue. Spreadsheets vervangen door echt tooling.',
        detail: 'Role-based adminpanelen, goedkeuringsflows, voorraad en operationele tooling die past bij hoe je bedrijf werkt — één bron van waarheid in plaats van losse bestanden.',
        image: null,
    },
    {
        id: 3,
        icon: '⬡',
        title: 'KPI-dashboards & rapportages',
        description: 'KPI-dashboard voor bedrijfsrapportages met realtime inzicht en alerts.',
        detail: 'Dashboards met live data uit je stack. Filters, grafieken, PDF- of Excel-export en meldingen wanneer KPI\'s drempels passeren.',
        image: null,
    },
    {
        id: 4,
        icon: '◎',
        title: 'API-integraties',
        description: 'API-koppelingen tussen andere systemen.',
        detail: 'REST API\'s, webhooks en syncjobs tussen custom backends. Zo kun je later van leverancier wisselen zonder alles opnieuw te bouwen.',
        image: null,
    },
    {
        id: 5,
        icon: '◈',
        title: 'Betaalsystemen',
        description: 'Stripe- en Mollie-integratie webshop — checkout, abonnementen en facturatie.',
        detail: 'Eenmalige betalingen, abonnementen, usage-based billing, klantportalen en webhook-afhandeling met retries. Productieklaar voor Nederlandse en internationale klanten.',
        image: null,
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
