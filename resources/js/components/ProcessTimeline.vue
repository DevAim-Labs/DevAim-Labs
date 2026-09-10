<template>
    <section id="process" class="process-timeline-section" data-gsap="section-process">
        <div class="section-card">
            <div class="max-w-6xl mx-auto px-6 py-16 md:py-24">
                <header class="mb-12 md:mb-16 max-w-2xl">
                    <p class="section-eyebrow mb-3">{{ header.eyebrow }}</p>
                    <h2 class="text-3xl md:text-4xl section-title">{{ header.title }}</h2>
                    <p class="text-sm md:text-base text-[var(--color-text-muted)] mt-3 leading-relaxed">
                        {{ header.subtitle }}
                    </p>
                </header>

                <!-- Desktop Timeline -->
                <ol ref="timelineRef" class="hidden md:grid md:grid-cols-5 md:gap-4 relative list-none m-0 p-0">
                    <!-- Animated connecting line -->
                    <div
                        ref="lineRef"
                        class="absolute top-8 left-[10%] right-[10%] h-0.5 -translate-y-1/2 pointer-events-none overflow-hidden"
                        style="background: var(--color-border);"
                        aria-hidden="true"
                    >
                        <div
                            class="absolute inset-0"
                            style="background: linear-gradient(90deg, transparent, var(--color-accent), transparent); animation: line-pulse 3s ease-in-out infinite;"
                        ></div>
                    </div>

                    <li
                        v-for="step in steps"
                        :key="step.id"
                        class="relative flex flex-col items-center text-center px-2 group"
                    >
                        <!-- Step circle with icon -->
                        <div
                            class="step-circle relative z-10 flex h-16 w-16 shrink-0 items-center justify-center rounded-full border-2 transition-all duration-300 group-hover:scale-110 group-hover:shadow-lg"
                            style="border-color: var(--color-accent); background: var(--color-section);"
                            :style="{ boxShadow: 'inset 0 0 0 2px var(--color-surface-1)' }"
                        >
                            <span class="text-xl" style="color: var(--color-accent)" v-html="ICONS[step.icon]"></span>
                        </div>

                        <!-- Step number badge -->
                        <span
                            class="absolute top-0 right-1/2 translate-x-8 -translate-y-0 w-6 h-6 flex items-center justify-center rounded-full text-xs font-bold z-20"
                            style="background: var(--color-accent); color: var(--color-on-accent);"
                        >
                            {{ step.number }}
                        </span>

                        <h3 class="mt-5 text-sm font-semibold section-title leading-snug">
                            {{ step.title }}
                        </h3>

                        <!-- Highlight badge -->
                        <span
                            class="mt-2 px-2 py-0.5 rounded-full text-[10px] uppercase tracking-wide font-medium"
                            style="background: var(--color-accent-glow); color: var(--color-accent);"
                        >
                            {{ step.highlight }}
                        </span>

                        <p class="mt-2 text-xs leading-relaxed text-[var(--color-text-muted)]">
                            {{ step.body }}
                        </p>
                    </li>
                </ol>

                <!-- Mobile Timeline -->
                <ol ref="mobileTimelineRef" class="md:hidden list-none m-0 p-0 space-y-8">
                    <li
                        v-for="(step, i) in steps"
                        :key="'m-' + step.id"
                        class="relative flex gap-5 pl-1 mobile-step-item"
                    >
                        <!-- Connecting line: positioned absolute against the <li>, so its
                             horizontal offset never depends on a sibling's computed width. -->
                        <div
                            v-if="i < steps.length - 1"
                            class="mobile-step-line absolute w-px"
                            style="left: 2rem; top: 3.5rem; bottom: -2rem; transform-origin: top center; background: var(--color-border);"
                            aria-hidden="true"
                        ></div>

                        <div class="w-14 shrink-0 flex flex-col items-center">
                            <div class="relative mobile-step-circle">
                                <div
                                    class="flex h-14 w-14 items-center justify-center rounded-full border-2"
                                    style="border-color: var(--color-accent); background: var(--color-section);"
                                >
                                    <span class="text-lg" style="color: var(--color-accent)" v-html="ICONS[step.icon]"></span>
                                </div>
                                <!-- Number badge for mobile -->
                                <span
                                    class="absolute -top-1 -right-1 w-5 h-5 flex items-center justify-center rounded-full text-[10px] font-bold"
                                    style="background: var(--color-accent); color: var(--color-on-accent);"
                                >
                                    {{ step.number }}
                                </span>
                            </div>
                        </div>
                        <div class="pt-1 pb-2">
                            <h3 class="text-base font-semibold section-title leading-snug">
                                {{ step.title }}
                            </h3>
                            <span
                                class="inline-block mt-1 px-2 py-0.5 rounded-full text-[10px] uppercase tracking-wide font-medium"
                                style="background: var(--color-accent-glow); color: var(--color-accent);"
                            >
                                {{ step.highlight }}
                            </span>
                            <p class="mt-2 text-sm leading-relaxed text-[var(--color-text-muted)]">
                                {{ step.body }}
                            </p>
                        </div>
                    </li>
                </ol>

                <div class="mt-12 md:mt-14 text-center">
                    <a
                        :href="contactPath"
                        class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                        data-track="cta_click"
                        :data-track-label="header.cta"
                        data-track-location="process"
                    >
                        {{ header.cta }} →
                    </a>
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
const contactPath = isEn ? '/en/contact' : '/contact'

// Header translations
const header = computed(() => isEn ? {
    eyebrow: 'Process',
    title: 'Custom software, step by step.',
    subtitle: 'From the first conversation to delivery and beyond.',
    cta: 'Discuss your project'
} : {
    eyebrow: 'Werkwijze',
    title: 'Maatwerksoftware, stap voor stap.',
    subtitle: 'Van het eerste gesprek tot oplevering en daarna.',
    cta: 'Bespreek je project'
})

// Material Symbols (Outlined, 24px)
const ICONS = {
    handshake: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M475-140q5 0 11.5-2.5T497-149l337-337q13-13 19.5-29.5T860-552q0-20-6.5-37.5T834-618L654-798q-11-11-27.5-17.5T590-822q-20 0-36.5 6.5T524-796L380-652q-14 14-14 34.5t14 34.5l56 56q6 6 14 6t14-6q6-6 6-14t-6-14l-56-56 144-144 180 180-338 338q-8 8-12.5 18t-4.5 22q0 25 17.5 42.5T432-138h43Zm3-60h-46l302-302-56-56-302 302v46l102-102 56 56-56 56ZM100-180v-304q0-26 9.5-49t27.5-42l174-174q11-11 27.5-17.5T375-773q20 0 36.5 6.5T441-749l50 50-56 56-50-50-174 174v232h-32q-13 0-21.5 8.5T149-257v17l31 60h-80Zm314-164 56-56-56-56-56 56 56 56Z"/></svg>',
    calendar_month: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-320Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-320Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-320ZM480-160q-17 0-28.5-11.5T440-200q0-17 11.5-28.5T480-240q17 0 28.5 11.5T520-200q0 17-11.5 28.5T480-160Zm-160 0q-17 0-28.5-11.5T280-200q0-17 11.5-28.5T320-240q17 0 28.5 11.5T360-200q0 17-11.5 28.5T320-160Zm320 0q-17 0-28.5-11.5T600-200q0-17 11.5-28.5T640-240q17 0 28.5 11.5T680-200q0 17-11.5 28.5T640-160Z"/></svg>',
    construction: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M756-120 537-339l84-84 219 219-84 84Zm-552 0-84-84 276-276-68-68-28 28-51-51v82l-28 28-121-121 28-28h82l-50-50 142-142q20-20 43-29t47-9q24 0 47 9t43 29l-92 92 50 50-28 28 68 68 90-90q-4-11-6.5-23t-2.5-24q0-59 40.5-99.5T701-841q15 0 28.5 3t27.5 9l-99 99 72 72 99-99q7 14 9.5 27.5T841-701q0 59-40.5 99.5T701-561q-12 0-24-2t-23-7L204-120Z"/></svg>',
    computer: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="M40-120v-80h880v80H40Zm120-120q-33 0-56.5-23.5T80-320v-440q0-33 23.5-56.5T160-840h640q33 0 56.5 23.5T880-760v440q0 33-23.5 56.5T800-240H160Zm0-80h640v-440H160v440Zm0 0v-440 440Z"/></svg>',
    trending_up: '<svg viewBox="0 -960 960 960" fill="currentColor" width="1em" height="1em"><path d="m136-240-56-56 296-298 160 160 208-206H640v-80h240v240h-80v-104L536-320 376-480 136-240Z"/></svg>',
}

const stepsNl = [
    {
        id: 1,
        number: 1,
        icon: 'handshake',
        title: 'Kennismaking',
        highlight: 'Idee en doelen',
        body: 'Ik bespreek je idee, doelen en randvoorwaarden, en check of maatwerksoftware de juiste keuze is.',
    },
    {
        id: 2,
        number: 2,
        icon: 'calendar_month',
        title: 'Scope en planning',
        highlight: 'Plan van aanpak',
        body: 'Heldere milestones en een duidelijke planning, zodat je vooraf weet wat er te verwachten staat.',
    },
    {
        id: 3,
        number: 3,
        icon: 'construction',
        title: 'Bouwen',
        highlight: "Demo's elke 2 weken",
        body: 'Ik ontwikkel iteratief, met demo\'s om de 1 tot 2 weken. Hierbij kan ik feedback krijgen en hierop verbeteringen uitvoeren.',
    },
    {
        id: 4,
        number: 4,
        icon: 'computer',
        title: 'Oplevering',
        highlight: 'Overdraging',
        body: 'Ik deploy, draag over en documenteer, zodat je team het vanaf dag één kan gebruiken.',
    },
    {
        id: 5,
        number: 5,
        icon: 'trending_up',
        title: 'Doorontwikkeling',
        highlight: 'Flexibele support',
        body: 'Onder overleg kan ik beschikbaar blijven voor verbeteringen, nieuwe features en ondersteuning voor je product.',
    },
]

const stepsEn = [
    {
        id: 1,
        number: 1,
        icon: 'handshake',
        title: 'Introduction',
        highlight: 'Free consultation',
        body: 'I discuss your idea, goals and requirements, and check if custom software is the right choice.',
    },
    {
        id: 2,
        number: 2,
        icon: 'calendar_month',
        title: 'Scope & Planning',
        highlight: 'Fixed price',
        body: 'Clear milestones and a transparent timeline, so you know what success looks like upfront.',
    },
    {
        id: 3,
        number: 3,
        icon: 'construction',
        title: 'Build',
        highlight: 'Demos every 2 weeks',
        body: 'I develop iteratively, with demos every two weeks.',
    },
    {
        id: 4,
        number: 4,
        icon: 'computer',
        title: 'Delivery',
        highlight: 'You own the code',
        body: 'I deploy, hand over and document, so your team can use it from day one.',
    },
    {
        id: 5,
        number: 5,
        icon: 'trending_up',
        title: 'Growth',
        highlight: 'Flexible support',
        body: 'I remain available for improvements, new features and support as your product grows.',
    },
]

const steps = computed(() => isEn ? stepsEn : stepsNl)

const timelineRef = ref(null)
const lineRef = ref(null)
const mobileTimelineRef = ref(null)

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    // Mobile timeline: staggered entrance for each step and its connecting line.
    // Runs regardless of viewport size (the desktop <ol> is hidden via CSS on
    // mobile, so it can't drive this — the mobile-only <ol> needs its own trigger).
    if (mobileTimelineRef.value) {
        const mobileItems = mobileTimelineRef.value.querySelectorAll('.mobile-step-item')
        if (mobileItems.length) {
            gsap.fromTo(mobileItems,
                { opacity: 0, y: 24 },
                {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    stagger: 0.15,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: mobileTimelineRef.value,
                        start: 'top 85%',
                    },
                }
            )
        }

        const mobileLines = mobileTimelineRef.value.querySelectorAll('.mobile-step-line')
        if (mobileLines.length) {
            gsap.fromTo(mobileLines,
                { scaleY: 0 },
                {
                    scaleY: 1,
                    duration: 0.4,
                    stagger: 0.15,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: mobileTimelineRef.value,
                        start: 'top 85%',
                    },
                }
            )
        }
    }

    if (!timelineRef.value) return

    // Animate connecting line
    if (lineRef.value) {
        gsap.fromTo(lineRef.value,
            { scaleX: 0, transformOrigin: 'left center' },
            {
                scaleX: 1,
                duration: 1.2,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: timelineRef.value,
                    start: 'top 75%',
                },
            }
        )
    }

    // Stagger step circles with bounce effect
    const circles = timelineRef.value.querySelectorAll('.step-circle')
    if (circles.length) {
        gsap.fromTo(circles,
            { scale: 0, opacity: 0 },
            {
                scale: 1,
                opacity: 1,
                duration: 0.5,
                stagger: 0.12,
                ease: 'back.out(1.7)',
                scrollTrigger: {
                    trigger: timelineRef.value,
                    start: 'top 80%',
                },
            }
        )
    }

    // Stagger text content
    const textContent = timelineRef.value.querySelectorAll('h3, p, span:not(.step-circle span)')
    if (textContent.length) {
        gsap.fromTo(textContent,
            { opacity: 0, y: 20 },
            {
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.05,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: timelineRef.value,
                    start: 'top 75%',
                },
            }
        )
    }
})
</script>

<style scoped>
@keyframes line-pulse {
    0%, 100% {
        transform: translateX(-100%);
    }
    50% {
        transform: translateX(100%);
    }
}

.step-circle {
    will-change: transform;
}
</style>
