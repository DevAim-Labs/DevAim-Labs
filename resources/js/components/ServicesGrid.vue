<template>
    <section id="services" data-gsap="section-services" class="reveal-hidden">
        <div class="section-card">
        <div class="max-w-6xl mx-auto px-6 py-24">
            <div class="mb-16">
                <p class="section-eyebrow mb-3">Custom software</p>
                <h2 class="text-4xl section-title">What we can build for you</h2>
            </div>

            <!-- Grid — always in DOM, hidden via display:none during expansion -->
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
                    <p class="mt-auto pt-4 text-xs" style="color: var(--color-accent);opacity:0.6">Click to explore →</p>
                </div>
            </div>

            <!-- Expanded panel — rendered only when a service is selected -->
            <div
                v-if="selected"
                ref="expandedRef"
                class="card-glow rounded-xl border overflow-hidden"
                style="border-color: var(--color-border); background: var(--color-surface-1); opacity:0;"
            >
                <div class="flex flex-col md:flex-row" style="min-height:380px;">

                    <!-- Left 25% — text content -->
                    <div class="md:w-1/4 p-8 flex flex-col justify-between">
                        <div>
                            <button
                                class="mb-8 text-xs uppercase tracking-widest flex items-center gap-2 transition-colors duration-200"
                                style="color: var(--color-text-dim);"
                                @mouseover="$event.currentTarget.style.color='var(--color-accent)'"
                                @mouseleave="$event.currentTarget.style.color='var(--color-text-dim)'"
                                @click="closeExpanded"
                            >← Back</button>

                            <div class="text-3xl mb-4" style="color: var(--color-accent)">{{ selected.icon }}</div>
                            <h3 class="font-bold text-xl mb-4 leading-snug" style="color: var(--color-text)">{{ selected.title }}</h3>
                            <p class="text-sm leading-relaxed" style="color: var(--color-text-muted)">{{ selected.detail }}</p>
                        </div>

                        <a
                            href="#contact"
                            class="btn-primary mt-8 inline-flex px-5 py-2.5 rounded-md text-sm font-semibold self-start"
                            @click="closeExpanded"
                        >Start a project →</a>
                    </div>

                    <!-- Divider (desktop only) -->
                    <div class="hidden md:block w-px shrink-0" style="background: var(--color-border);"></div>

                    <!-- Right 75% — image / placeholder -->
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
                            <div class="absolute bottom-5 left-6 text-xs uppercase tracking-widest" style="color: var(--color-accent);opacity:0.45">Preview coming soon</div>
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
        title: 'Websites & landing pages',
        description: 'Fast, SEO-friendly marketing sites built to convert.',
        detail: 'Landing pages, company sites, and campaign pages with solid semantics, Core Web Vitals in mind, and clear CTAs. Optional CMS or content workflows when you need to update copy without a developer.',
        image: null,
    },
    {
        id: 2,
        icon: '▦',
        title: 'Admin panels & internal tools',
        description: 'Replace spreadsheets with software your team actually wants to use.',
        detail: 'Role-based admin panels, approval flows, inventory, and operations tooling shaped around how your business runs — one source of truth instead of fragmented files and tabs.',
        image: null,
    },
    {
        id: 3,
        icon: '⬡',
        title: 'KPI dashboards & reporting',
        description: 'Realtime insight, exports, and alerts when metrics move off track.',
        detail: 'Dashboards that pull live data from your stack — filters, charts, PDF or Excel exports, and notifications when KPIs cross thresholds. Built for decision-makers, not vanity metrics.',
        image: null,
    },
    {
        id: 4,
        icon: '◎',
        title: 'API integrations',
        description: 'Connect CRM, accounting, logistics, and internal systems.',
        detail: 'REST APIs, webhooks, and sync jobs between Stripe, HubSpot, ERP, or custom backends. Integrations are designed so you can change providers later without rewriting the product.',
        image: null,
    },
    {
        id: 5,
        icon: '◈',
        title: 'Payment systems',
        description: 'Checkout, subscriptions, invoicing, and webhooks. Stripe and Mollie.',
        detail: 'One-time payments, subscriptions, usage-based billing, customer portals, and webhook handling with retries and failure paths. Production-ready flows for Dutch and international customers.',
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
