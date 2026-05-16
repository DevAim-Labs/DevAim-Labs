<template>
    <section id="services" data-gsap="section-services" class="reveal-hidden">
        <div class="section-card">
        <div class="max-w-6xl mx-auto px-6 py-24">
            <div class="mb-16">
                <p class="section-eyebrow mb-3">What I build</p>
                <h2 class="text-4xl section-title">Services</h2>
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
                            class="mt-8 inline-flex px-5 py-2.5 rounded-md text-sm font-semibold transition-colors duration-200 self-start"
                            style="background: var(--color-accent); color: var(--color-surface);"
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
        title: 'Custom Websites',
        description: 'Marketing sites, landing pages, and portfolios built for performance.',
        detail: 'Pixel-perfect marketing sites, landing pages, and portfolios. Built with clean semantics, fast load times, and full CMS control if needed. Every page is tuned for conversions and optimised for search.',
        image: null,
    },
    {
        id: 2,
        icon: '⬡',
        title: 'Web Applications',
        description: 'Full-stack apps with authentication, roles, business logic, and clean APIs.',
        detail: 'From idea to production — auth flows, user roles, multi-tenancy, and business logic that holds up as your product scales. Clean architecture from day one so the codebase stays manageable.',
        image: null,
    },
    {
        id: 3,
        icon: '▦',
        title: 'Dashboards & Systems',
        description: 'Admin panels, reporting tools, and internal tooling your team actually wants to use.',
        detail: 'Internal tools your team will actually use. KPI dashboards, reporting suites, inventory management, and admin panels built around real workflows — not generic templates.',
        image: null,
    },
    {
        id: 4,
        icon: '◎',
        title: 'Integrations',
        description: 'Third-party APIs, webhooks, and service integrations that extend what your application can do.',
        detail: "Stripe, HubSpot, Slack, or whatever your stack needs. Clean integrations that extend your application without tightly coupling it — so swapping providers later doesn't break everything.",
        image: null,
    },
    {
        id: 5,
        icon: '◈',
        title: 'Payment Systems',
        description: 'Subscriptions, webhooks, invoicing, and checkout flows.',
        detail: 'Subscription billing, one-time charges, usage-based pricing, webhooks, invoicing, and checkout flows. Built on Stripe with proper failure handling, retry logic, and customer portal support.',
        image: null,
    },
    {
        id: 6,
        icon: '⬡',
        title: 'API Development',
        description: 'REST APIs and backend services that other systems can rely on at scale.',
        detail: 'REST APIs designed for long-term reliability. Versioned endpoints, clear contracts, rate limiting, and documentation that makes your API easy to consume — by your team or third-party clients.',
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
