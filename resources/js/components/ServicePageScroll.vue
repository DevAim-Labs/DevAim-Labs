<template>
    <div class="service-scroll-container" ref="containerRef">
        <!-- Pinned viewport -->
        <div class="service-viewport" ref="viewportRef">
            <!-- Phase 1: Hero -->
            <div
                class="phase phase-hero"
                :class="{ 'is-active': currentPhase === 0 }"
                :style="phaseStyle(0)"
            >
                <!-- Accent gradient orbs -->
                <div class="phase-bg phase-bg-hero" :class="`accent-bg-${content.accent}`"></div>
                <div class="phase-content">
                    <span class="phase-eyebrow">{{ isEn ? 'Service' : 'Dienst' }}</span>
                    <h1 class="phase-hero-title">{{ content.title }}</h1>
                    <p class="phase-hero-tagline">{{ content.tagline }}</p>
                    <div class="phase-hero-scroll-hint" v-if="!reducedMotion">
                        <span>{{ isEn ? 'Scroll to explore' : 'Scroll om te ontdekken' }}</span>
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Phase 2: Problem -->
            <div
                class="phase phase-problem"
                :class="{ 'is-active': currentPhase === 1 }"
                :style="phaseStyle(1)"
            >
                <!-- Subtle gradient background -->
                <div class="phase-bg phase-bg-problem"></div>
                <div class="phase-content phase-content-split">
                    <div class="phase-text">
                        <span class="phase-eyebrow phase-eyebrow-problem">{{ isEn ? 'The Problem' : 'Het Probleem' }}</span>
                        <h2 class="phase-headline">{{ content.problem.headline }}</h2>
                        <p class="phase-description">{{ content.problem.description }}</p>
                    </div>
                    <div class="phase-visual">
                        <div class="problem-illustration" :class="`accent-${content.accent}`">
                            <!-- More impactful broken/fragmented illustration -->
                            <svg viewBox="0 0 240 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Outer broken circle -->
                                <path d="M120 20 A100 100 0 0 1 220 120" stroke="currentColor" stroke-width="2" stroke-dasharray="4 8" opacity="0.2"/>
                                <path d="M220 120 A100 100 0 0 1 120 220" stroke="currentColor" stroke-width="2" stroke-dasharray="4 8" opacity="0.2"/>
                                <path d="M120 220 A100 100 0 0 1 20 120" stroke="currentColor" stroke-width="2" stroke-dasharray="4 8" opacity="0.2"/>
                                <path d="M20 120 A100 100 0 0 1 120 20" stroke="currentColor" stroke-width="2" stroke-dasharray="4 8" opacity="0.2"/>
                                <!-- Fragmented center pieces -->
                                <rect x="80" y="80" width="35" height="35" rx="4" fill="currentColor" opacity="0.15" transform="rotate(12 97.5 97.5)"/>
                                <rect x="115" y="85" width="45" height="45" rx="4" fill="currentColor" opacity="0.2" transform="rotate(-8 137.5 107.5)"/>
                                <rect x="85" y="115" width="40" height="40" rx="4" fill="currentColor" opacity="0.12" transform="rotate(5 105 135)"/>
                                <!-- X mark indicating problem -->
                                <path d="M100 100L140 140M140 100L100 140" stroke="currentColor" stroke-width="4" stroke-linecap="round" opacity="0.7"/>
                                <!-- Floating fragments -->
                                <circle cx="60" cy="60" r="8" fill="currentColor" opacity="0.3"/>
                                <circle cx="185" cy="70" r="6" fill="currentColor" opacity="0.25"/>
                                <circle cx="55" cy="175" r="5" fill="currentColor" opacity="0.2"/>
                                <circle cx="190" cy="165" r="7" fill="currentColor" opacity="0.28"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phase 3: Solution -->
            <div
                class="phase phase-solution"
                :class="{ 'is-active': currentPhase === 2 }"
                :style="phaseStyle(2)"
            >
                <!-- Subtle gradient background -->
                <div class="phase-bg phase-bg-solution"></div>
                <div class="phase-content phase-content-split phase-content-reverse">
                    <div class="phase-visual">
                        <div class="solution-illustration" :class="`accent-${content.accent}`">
                            <!-- Unified/complete illustration showing everything connected -->
                            <svg viewBox="0 0 240 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Outer complete circle -->
                                <circle cx="120" cy="120" r="100" stroke="currentColor" stroke-width="2" opacity="0.15"/>
                                <circle cx="120" cy="120" r="80" stroke="currentColor" stroke-width="2" opacity="0.25"/>
                                <!-- Central unified panel -->
                                <rect x="60" y="60" width="120" height="120" rx="16" fill="currentColor" opacity="0.1"/>
                                <rect x="70" y="70" width="100" height="100" rx="12" stroke="currentColor" stroke-width="2" opacity="0.4"/>
                                <!-- Checkmark -->
                                <path d="M95 120L112 137L147 102" stroke="currentColor" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" opacity="0.9"/>
                                <!-- Orbiting success elements -->
                                <circle cx="120" cy="30" r="10" fill="currentColor" opacity="0.4"/>
                                <circle cx="210" cy="120" r="8" fill="currentColor" opacity="0.35"/>
                                <circle cx="120" cy="210" r="9" fill="currentColor" opacity="0.38"/>
                                <circle cx="30" cy="120" r="7" fill="currentColor" opacity="0.32"/>
                                <!-- Connection lines -->
                                <line x1="120" y1="40" x2="120" y2="70" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>
                                <line x1="200" y1="120" x2="170" y2="120" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>
                                <line x1="120" y1="200" x2="120" y2="170" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>
                                <line x1="40" y1="120" x2="70" y2="120" stroke="currentColor" stroke-width="1.5" opacity="0.3"/>
                            </svg>
                        </div>
                    </div>
                    <div class="phase-text">
                        <span class="phase-eyebrow phase-eyebrow-solution">{{ isEn ? 'The Solution' : 'De Oplossing' }}</span>
                        <h2 class="phase-headline">{{ content.solution.headline }}</h2>
                        <p class="phase-description">{{ content.solution.description }}</p>
                    </div>
                </div>
            </div>

            <!-- Phase 4: Demo Preview -->
            <div
                class="phase phase-demo"
                :class="{ 'is-active': currentPhase === 3 }"
                :style="phaseStyle(3)"
            >
                <!-- Demo gradient background -->
                <div class="phase-bg phase-bg-demo" :class="`accent-bg-${content.accent}`"></div>
                <div class="phase-content phase-content-centered">
                    <span class="phase-eyebrow">{{ isEn ? 'See It In Action' : 'Bekijk Het In Actie' }}</span>
                    <h2 class="phase-demo-headline">{{ content.title }}</h2>

                    <!-- Show iframe demo for services with valid demo URL -->
                    <div v-if="hasValidDemo" class="demo-preview-container">
                        <div class="demo-browser-frame">
                            <div class="demo-browser-bar">
                                <div class="demo-browser-dots">
                                    <span></span><span></span><span></span>
                                </div>
                                <div class="demo-browser-url">{{ content.demoUrl }}</div>
                            </div>
                            <div class="demo-iframe-wrapper">
                                <iframe
                                    v-if="currentPhase >= 3"
                                    :src="content.demoUrl"
                                    class="demo-iframe"
                                    loading="lazy"
                                    :title="`Demo: ${content.title}`"
                                ></iframe>
                            </div>
                        </div>
                        <a
                            :href="content.demoUrl"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="btn-hover btn-hover-primary demo-cta"
                        >
                            <span class="btn-hover__dot" aria-hidden="true"></span>
                            <span class="btn-hover__label">{{ content.demoLabel || (isEn ? 'View live demo' : 'Bekijk live demo') }}</span>
                            <span class="btn-hover__reveal" aria-hidden="true">
                                <span>{{ content.demoLabel || (isEn ? 'View live demo' : 'Bekijk live demo') }}</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6M15 3h6v6M10 14L21 3" />
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Show SVG illustration for services without demo (API integrations) -->
                    <div v-else class="demo-illustration-container">
                        <div class="demo-illustration api-beam-illustration">
                            <!-- API Integration Network - Using Material Symbols like homepage -->
                            <svg viewBox="0 0 520 280" fill="none" xmlns="http://www.w3.org/2000/svg" class="api-network-svg">
                                <!-- Curved connection paths -->
                                <path v-for="node in apiNodes" :key="'wire-' + node.id" :d="node.path" fill="none" stroke="rgba(255,255,255,0.18)" stroke-width="1.5"/>

                                <!-- Animated traveling pulses -->
                                <g class="data-pulses" v-if="!reducedMotion">
                                    <circle v-for="(node, i) in apiNodes" :key="'pulse-' + node.id" r="4" fill="var(--color-accent)">
                                        <animateMotion :path="node.path" :dur="`${2.6 + i * 0.35}s`" :begin="`${i * 0.5}s`" repeatCount="indefinite"/>
                                    </circle>
                                </g>

                                <!-- Endpoint nodes with Material Symbols icons -->
                                <g v-for="node in apiNodes" :key="'node-' + node.id">
                                    <circle :cx="node.x" :cy="node.y" r="24" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.25)" stroke-width="1.5"/>
                                    <path :d="API_ICONS[node.icon]" fill="rgba(255,255,255,0.85)" :transform="iconTransform(node.x, node.y, 26)"/>
                                </g>

                                <!-- Central hub -->
                                <g class="central-hub">
                                    <circle :cx="apiHub.x" :cy="apiHub.y" r="30" fill="var(--color-accent)"/>
                                    <path :d="API_ICONS.hub" fill="var(--color-on-accent)" :transform="iconTransform(apiHub.x, apiHub.y, 30)"/>
                                </g>
                            </svg>
                        </div>
                        <p class="demo-illustration-caption">
                            {{ isEn ? 'Your systems, connected seamlessly' : 'Jouw systemen, naadloos verbonden' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Phase 5: Features -->
            <div
                class="phase phase-features"
                :class="{ 'is-active': currentPhase === 4 }"
                :style="phaseStyle(4)"
            >
                <!-- Features gradient background -->
                <div class="phase-bg phase-bg-features" :class="`accent-bg-${content.accent}`"></div>
                <div class="phase-content">
                    <span class="phase-eyebrow">{{ isEn ? 'What You Get' : 'Wat Je Krijgt' }}</span>
                    <div class="features-grid">
                        <div
                            v-for="(feature, index) in content.features"
                            :key="index"
                            class="feature-card"
                            :class="`accent-${content.accent}`"
                            :style="{ transitionDelay: `${index * 100}ms` }"
                        >
                            <div class="feature-number">{{ String(index + 1).padStart(2, '0') }}</div>
                            <h3 class="feature-title">{{ feature.title }}</h3>
                            <p class="feature-description">{{ feature.description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Phase 6: CTA -->
            <div
                class="phase phase-cta"
                :class="{ 'is-active': currentPhase === 5 }"
                :style="phaseStyle(5)"
            >
                <!-- CTA gradient background -->
                <div class="phase-bg phase-bg-cta"></div>
                <div class="phase-content phase-content-centered">
                    <h2 class="phase-cta-headline">{{ content.cta.headline }}</h2>
                    <a
                        :href="content.cta.link"
                        class="btn-hover btn-hover-primary phase-cta-button"
                        data-track="cta_click"
                        :data-track-label="content.cta.label"
                        :data-track-location="`service_${content.id}`"
                    >
                        <span class="btn-hover__dot" aria-hidden="true"></span>
                        <span class="btn-hover__label">{{ content.cta.label }}</span>
                        <span class="btn-hover__reveal" aria-hidden="true">
                            <span>{{ content.cta.label }}</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </span>
                    </a>
                    <a :href="isEn ? '/en/#services' : '/#services'" class="phase-cta-secondary">
                        {{ isEn ? 'View all services' : 'Bekijk alle diensten' }}
                    </a>
                </div>
            </div>

            <!-- Progress indicator -->
            <div class="phase-progress" v-if="!reducedMotion">
                <button
                    v-for="(_, i) in TOTAL_PHASES"
                    :key="i"
                    class="phase-progress-dot"
                    :class="{ 'is-active': currentPhase === i, 'is-past': currentPhase > i }"
                    @click="scrollToPhase(i)"
                    :aria-label="`${isEn ? 'Go to section' : 'Ga naar sectie'} ${i + 1}`"
                >
                    <span class="phase-progress-dot-inner"></span>
                </button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'
import { getServiceContent } from '../data/services.js'

gsap.registerPlugin(ScrollTrigger)

const props = defineProps({
    service: {
        type: String,
        required: true,
    },
    locale: {
        type: String,
        default: 'nl',
    },
})

const isEn = computed(() => props.locale === 'en')
const content = computed(() => getServiceContent(props.service, props.locale) || {
    title: 'Service',
    tagline: '',
    problem: { headline: '', description: '' },
    solution: { headline: '', description: '' },
    features: [],
    cta: { headline: '', label: '', link: '/' },
    accent: 'teal',
})

// Check if service has a valid demo URL (ends with .html)
const hasValidDemo = computed(() => {
    const demoUrl = content.value.demoUrl
    return demoUrl && demoUrl.endsWith('.html')
})

// API Integration illustration data (matching homepage IntegrationsBeam style)
// Hub: center at y=50, radius 30 → bottom edge at y=80
// Nodes: center at y=210, radius 24 → top edge at y=186
const apiHub = { x: 260, y: 50 }

const apiNodes = [
    { id: 'webhook', icon: 'webhook', x: 60, y: 210, path: 'M260,80 C260,140 60,130 60,186' },
    { id: 'person', icon: 'person', x: 160, y: 210, path: 'M260,80 C260,140 160,130 160,186' },
    { id: 'database', icon: 'database', x: 260, y: 210, path: 'M260,80 C260,140 260,130 260,186' },
    { id: 'payment', icon: 'payments', x: 360, y: 210, path: 'M260,80 C260,140 360,130 360,186' },
    { id: 'cloud', icon: 'cloud', x: 460, y: 210, path: 'M260,80 C260,140 460,130 460,186' },
]

// Material Symbols icon paths (viewBox 0 -960 960 960)
const API_ICONS = {
    hub: 'M240-40q-50 0-85-35t-35-85q0-50 35-85t85-35q14 0 26 3t23 8l57-71q-28-31-39-70t-5-78l-81-27q-17 25-43 40t-58 15q-50 0-85-35T0-580q0-50 35-85t85-35q50 0 85 35t35 85v8l81 28q20-36 53.5-61t75.5-32v-87q-39-11-64.5-42.5T360-840q0-50 35-85t85-35q50 0 85 35t35 85q0 42-26 73.5T510-724v87q42 7 75.5 32t53.5 61l81-28v-8q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-32 0-58.5-15T739-515l-81 27q6 39-5 77.5T614-340l57 70q11-5 23-7.5t26-2.5q50 0 85 35t35 85q0 50-35 85t-85 35q-50 0-85-35t-35-85q0-20 6.5-38.5T624-232l-57-71q-41 23-87.5 23T392-303l-56 71q11 15 17.5 33.5T360-160q0 50-35 85t-85 35ZM120-540q17 0 28.5-11.5T160-580q0-17-11.5-28.5T120-620q-17 0-28.5 11.5T80-580q0 17 11.5 28.5T120-540Zm120 420q17 0 28.5-11.5T280-160q0-17-11.5-28.5T240-200q-17 0-28.5 11.5T200-160q0 17 11.5 28.5T240-120Zm240-680q17 0 28.5-11.5T520-840q0-17-11.5-28.5T480-880q-17 0-28.5 11.5T440-840q0 17 11.5 28.5T480-800Zm0 440q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm240 240q17 0 28.5-11.5T760-160q0-17-11.5-28.5T720-200q-17 0-28.5 11.5T680-160q0 17 11.5 28.5T720-120Zm120-420q17 0 28.5-11.5T880-580q0-17-11.5-28.5T840-620q-17 0-28.5 11.5T800-580q0 17 11.5 28.5T840-540ZM480-840ZM120-580Zm360 120Zm360-120ZM240-160Zm480 0Z',
    webhook: 'M280-120q-83 0-141.5-58.5T80-320q0-73 45.5-127.5T240-516v83q-35 12-57.5 43T160-320q0 50 35 85t85 35q50 0 85-35t35-85v-40h235q8-9 19.5-14.5T680-380q25 0 42.5 17.5T740-320q0 25-17.5 42.5T680-260q-14 0-25.5-5.5T635-280H476q-14 69-68.5 114.5T280-120Zm400 0q-56 0-101.5-27.5T507-220h107q14 10 31 15t35 5q50 0 85-35t35-85q0-50-35-85t-85-35q-20 0-37 5.5T611-418L489-621q-21-4-35-20t-14-39q0-25 17.5-42.5T500-740q25 0 42.5 17.5T560-680v8.5q0 3.5-2 8.5l87 146q8-2 17-2.5t18-.5q83 0 141.5 58.5T880-320q0 83-58.5 141.5T680-120ZM280-260q-25 0-42.5-17.5T220-320q0-22 14-38t34-21l94-156q-29-27-45.5-64.5T300-680q0-83 58.5-141.5T500-880q83 0 141.5 58.5T700-680h-80q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 43 26 75.5t66 41.5L337-338q2 5 2.5 9t.5 9q0 25-17.5 42.5T280-260Z',
    person: 'M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Z',
    database: 'M480-120q-151 0-255.5-46.5T120-280v-400q0-66 105.5-113T480-840q149 0 254.5 47T840-680v400q0 67-104.5 113.5T480-120Zm0-479q89 0 179-25.5T760-679q-11-29-100.5-55T480-760q-91 0-178.5 25.5T200-679q14 30 101.5 55T480-599Zm0 199q42 0 81-4t74.5-11.5q35.5-7.5 67-18.5t57.5-25v-120q-26 14-57.5 25t-67 18.5Q600-528 561-524t-81 4q-42 0-82-4t-75.5-11.5Q287-543 256-554t-56-25v120q25 14 56 25t66.5 18.5Q358-408 398-404t82 4Zm0 200q46 0 93.5-7t87.5-18.5q40-11.5 67-26t32-29.5v-98q-26 14-57.5 25t-67 18.5Q600-328 561-324t-81 4q-42 0-82-4t-75.5-11.5Q287-343 256-354t-56-25v99q5 15 31.5 29t66.5 25.5q40 11.5 88 18.5t94 7Z',
    payments: 'M560-440q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35ZM280-320q-33 0-56.5-23.5T200-400v-320q0-33 23.5-56.5T280-800h560q33 0 56.5 23.5T920-720v320q0 33-23.5 56.5T840-320H280Zm80-80h400q0-33 23.5-56.5T840-480v-160q-33 0-56.5-23.5T760-720H360q0 33-23.5 56.5T280-640v160q33 0 56.5 23.5T360-400Zm440 240H120q-33 0-56.5-23.5T40-240v-440h80v440h680v80ZM280-400v-320 320Z',
    cloud: 'M260-160q-91 0-155.5-63T40-377q0-78 47-139t123-78q25-92 100-149t170-57q117 0 198.5 81.5T760-520q69 8 114.5 59.5T920-340q0 75-52.5 127.5T740-160H260Zm0-80h480q42 0 71-29t29-71q0-42-29-71t-71-29h-60v-40q0-83-58.5-141.5T480-680q-83 0-141.5 58.5T280-480h-20q-58 0-99 41t-41 99q0 58 41 99t99 41Zm220-240Z',
}

// Transform function to center Material Symbols icons (viewBox 960x960, origin at 0,-960)
function iconTransform(cx, cy, size) {
    const s = size / 960
    return `translate(${cx},${cy}) scale(${s}) translate(-480,480)`
}

const containerRef = ref(null)
const viewportRef = ref(null)
const currentPhase = ref(0)
const scrollProgress = ref(0)
const reducedMotion = ref(false)

let scrollTriggerInstance = null

const TOTAL_PHASES = 6
const SCROLL_PER_PHASE = 150 // Percentage of viewport height per phase

function phaseStyle(phaseIndex) {
    if (reducedMotion.value) {
        return {
            opacity: currentPhase.value === phaseIndex ? 1 : 0,
            pointerEvents: currentPhase.value === phaseIndex ? 'auto' : 'none',
        }
    }

    // Calculate where we are in the scroll (0 to TOTAL_PHASES)
    const phaseProgress = scrollProgress.value
    const phaseStart = phaseIndex
    const phaseEnd = phaseIndex + 1

    // How far into this phase's range are we (0 to 1)
    const localProgress = phaseProgress - phaseIndex

    let opacity = 0
    let transform = 'translateY(60px)'

    // Special case: First phase (Hero) - visible immediately, exits earlier
    if (phaseIndex === 0) {
        if (phaseProgress < 0.3) {
            // Hero is fully visible until we start scrolling past 30%
            opacity = 1
            transform = 'translateY(0)'
        } else if (phaseProgress < 0.7) {
            // Hero exits between 30% and 70%
            const exitProgress = (phaseProgress - 0.3) / 0.4
            const eased = easeOutCubic(exitProgress)
            opacity = 1 - eased
            transform = `translateY(${-eased * 40}px)`
        } else {
            // Hero is gone after 70%
            opacity = 0
            transform = 'translateY(-40px)'
        }
    } else if (phaseProgress < phaseStart) {
        // Not yet reached this phase - waiting below
        opacity = 0
        transform = 'translateY(60px)'
    } else if (phaseProgress >= phaseStart && phaseProgress < phaseStart + 0.3) {
        // Phase entering (first 30% of scroll range)
        const enterProgress = localProgress / 0.3
        const eased = easeOutCubic(enterProgress)
        opacity = eased
        transform = `translateY(${60 - eased * 60}px)`
    } else if (phaseProgress >= phaseStart + 0.3 && phaseProgress < phaseStart + 0.7) {
        // Phase fully visible (middle 40% of scroll range)
        opacity = 1
        transform = 'translateY(0)'
    } else if (phaseProgress >= phaseStart + 0.7 && phaseProgress < phaseEnd) {
        // Phase exiting (last 30% of scroll range)
        const exitProgress = (localProgress - 0.7) / 0.3
        const eased = easeOutCubic(exitProgress)
        opacity = 1 - eased
        transform = `translateY(${-eased * 40}px)`
    } else {
        // Past this phase
        opacity = 0
        transform = 'translateY(-40px)'
    }

    return {
        opacity,
        transform,
        pointerEvents: opacity > 0.5 ? 'auto' : 'none',
    }
}

function easeOutCubic(t) {
    return 1 - Math.pow(1 - t, 3)
}

function scrollToPhase(phaseIndex) {
    if (!containerRef.value || reducedMotion.value) return

    // Calculate target scroll position for this phase (center of phase visibility)
    const totalScrollDistance = (TOTAL_PHASES * SCROLL_PER_PHASE / 100) * window.innerHeight
    const targetProgress = (phaseIndex + 0.5) / TOTAL_PHASES // Center of phase
    const targetScroll = containerRef.value.offsetTop + (targetProgress * totalScrollDistance)

    window.scrollTo({
        top: targetScroll,
        behavior: 'smooth',
    })
}

onMounted(() => {
    reducedMotion.value = window.matchMedia('(prefers-reduced-motion: reduce)').matches

    if (reducedMotion.value) {
        // Fallback: simple scroll-snap behavior
        currentPhase.value = 0
        return
    }

    // GSAP ScrollTrigger setup - more scroll distance for smoother transitions
    scrollTriggerInstance = ScrollTrigger.create({
        trigger: containerRef.value,
        start: 'top top',
        end: `+=${TOTAL_PHASES * SCROLL_PER_PHASE}%`,
        pin: viewportRef.value,
        scrub: 1.5, // Smoother scrubbing
        onUpdate: (self) => {
            // Map scroll progress (0-1) to phase progress (0 to TOTAL_PHASES)
            scrollProgress.value = self.progress * TOTAL_PHASES
            currentPhase.value = Math.min(
                Math.floor(scrollProgress.value),
                TOTAL_PHASES - 1
            )
        },
    })

    // Animate phases in
    gsap.fromTo(
        '.phase-hero .phase-content > *',
        { opacity: 0, y: 30 },
        {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.15,
            ease: 'power3.out',
            delay: 0.3,
        }
    )
})

onUnmounted(() => {
    if (scrollTriggerInstance) {
        scrollTriggerInstance.kill()
    }
})
</script>

<style scoped>
.service-scroll-container {
    min-height: 950vh; /* 6 phases × 150% + extra buffer */
    position: relative;
}

.service-viewport {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
    background: var(--color-surface);
}

/* Phase background gradients */
.phase-bg {
    position: absolute;
    inset: 0;
    pointer-events: none;
    opacity: 0.6;
}

.phase-bg-problem {
    background: radial-gradient(ellipse 80% 60% at 80% 30%, rgba(248, 113, 113, 0.08) 0%, transparent 60%);
}

.phase-bg-solution {
    background: radial-gradient(ellipse 80% 60% at 20% 70%, rgba(52, 211, 153, 0.08) 0%, transparent 60%);
}

.phase-bg-hero {
    background: radial-gradient(ellipse 60% 50% at 50% 40%, rgba(45, 212, 191, 0.06) 0%, transparent 70%);
}

.phase-bg-hero.accent-bg-violet {
    background: radial-gradient(ellipse 60% 50% at 50% 40%, rgba(139, 92, 246, 0.06) 0%, transparent 70%);
}

.phase-bg-hero.accent-bg-green {
    background: radial-gradient(ellipse 60% 50% at 50% 40%, rgba(52, 211, 153, 0.06) 0%, transparent 70%);
}

.phase-bg-hero.accent-bg-blue {
    background: radial-gradient(ellipse 60% 50% at 50% 40%, rgba(96, 165, 250, 0.06) 0%, transparent 70%);
}

.phase-bg-features {
    background: radial-gradient(ellipse 70% 50% at 80% 20%, rgba(45, 212, 191, 0.04) 0%, transparent 60%);
}

.phase-bg-features.accent-bg-violet {
    background: radial-gradient(ellipse 70% 50% at 80% 20%, rgba(139, 92, 246, 0.04) 0%, transparent 60%);
}

.phase-bg-features.accent-bg-green {
    background: radial-gradient(ellipse 70% 50% at 80% 20%, rgba(52, 211, 153, 0.04) 0%, transparent 60%);
}

.phase-bg-features.accent-bg-blue {
    background: radial-gradient(ellipse 70% 50% at 80% 20%, rgba(96, 165, 250, 0.04) 0%, transparent 60%);
}

.phase-bg-demo {
    background: radial-gradient(ellipse 60% 40% at 50% 30%, rgba(45, 212, 191, 0.05) 0%, transparent 60%);
}

.phase-bg-demo.accent-bg-violet {
    background: radial-gradient(ellipse 60% 40% at 50% 30%, rgba(139, 92, 246, 0.05) 0%, transparent 60%);
}

.phase-bg-demo.accent-bg-green {
    background: radial-gradient(ellipse 60% 40% at 50% 30%, rgba(52, 211, 153, 0.05) 0%, transparent 60%);
}

.phase-bg-demo.accent-bg-blue {
    background: radial-gradient(ellipse 60% 40% at 50% 30%, rgba(96, 165, 250, 0.05) 0%, transparent 60%);
}

.phase-bg-cta {
    background:
        radial-gradient(ellipse 50% 40% at 30% 60%, rgba(45, 212, 191, 0.05) 0%, transparent 60%),
        radial-gradient(ellipse 50% 40% at 70% 40%, rgba(139, 92, 246, 0.04) 0%, transparent 60%);
}

/* Phases */
.phase {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: clamp(5rem, 12vh, 8rem) clamp(1.5rem, 5vw, 4rem);
    will-change: transform, opacity;
}

@media (prefers-reduced-motion: reduce) {
    .phase {
        transition: opacity 0.3s ease;
        transform: none !important;
    }
}

.phase-content {
    max-width: 72rem;
    width: 100%;
    margin: 0 auto;
}

.phase-content-split {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(2rem, 6vw, 5rem);
    align-items: center;
}

.phase-content-reverse {
    direction: rtl;
}

.phase-content-reverse > * {
    direction: ltr;
}

.phase-content-centered {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
}

@media (max-width: 768px) {
    .phase-content-split {
        grid-template-columns: 1fr;
        gap: 2rem;
    }

    .phase-content-reverse {
        direction: ltr;
    }

    .phase-visual {
        order: -1;
    }
}

/* Eyebrow */
.phase-eyebrow {
    display: inline-block;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--color-accent);
    margin-bottom: 1rem;
}

.phase-eyebrow-problem {
    color: #f87171;
}

.phase-eyebrow-solution {
    color: #34d399;
}

/* Demo Preview phase */
.phase-demo-headline {
    font-size: clamp(1.5rem, 3vw, 2rem);
    font-weight: 700;
    letter-spacing: -0.02em;
    color: var(--color-text);
    margin-bottom: 0.5rem;
}

.demo-preview-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2rem;
    width: 100%;
    max-width: 56rem;
}

.demo-browser-frame {
    width: 100%;
    border-radius: 0.75rem;
    overflow: hidden;
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.demo-browser-bar {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 0.75rem 1rem;
    background: var(--color-surface-2);
    border-bottom: 1px solid var(--color-border-dim);
}

.demo-browser-dots {
    display: flex;
    gap: 0.375rem;
}

.demo-browser-dots span {
    width: 0.625rem;
    height: 0.625rem;
    border-radius: 50%;
    background: var(--color-text-dim);
    opacity: 0.5;
}

.demo-browser-dots span:first-child {
    background: #f87171;
    opacity: 1;
}

.demo-browser-dots span:nth-child(2) {
    background: #fbbf24;
    opacity: 1;
}

.demo-browser-dots span:nth-child(3) {
    background: #34d399;
    opacity: 1;
}

.demo-browser-url {
    flex: 1;
    font-size: 0.75rem;
    font-family: var(--font-mono);
    color: var(--color-text-dim);
    background: var(--color-surface-1);
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.demo-iframe-wrapper {
    position: relative;
    width: 100%;
    height: 0;
    padding-bottom: 62.5%; /* 16:10 aspect ratio - taller to show more content */
    background: var(--color-surface);
    overflow: hidden;
}

.demo-iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 177.78%; /* Scale up to show desktop layout */
    height: 177.78%;
    border: none;
    background: #fff;
    transform: scale(0.5625); /* Scale back down to fit */
    transform-origin: top left;
    pointer-events: none; /* Disable interaction in preview */
}

.demo-cta {
    margin-top: 0.5rem;
}

/* Demo illustration for services without iframe demo */
.demo-illustration-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
    width: 100%;
    max-width: 40rem;
}

.demo-illustration {
    width: 100%;
    aspect-ratio: 5/3;
    display: flex;
    align-items: center;
    justify-content: center;
}

.api-beam-illustration {
    background: var(--color-surface-1);
    border-radius: 1rem;
    padding: 1.5rem;
    border: 1px solid var(--color-border-dim);
}

.api-network-svg {
    width: 100%;
    height: 100%;
}

.demo-illustration-caption {
    font-size: 1rem;
    color: var(--color-text-muted);
    text-align: center;
}

/* Hide data pulses when reduced motion is preferred */
@media (prefers-reduced-motion: reduce) {
    .data-pulses {
        display: none;
    }
}

@media (max-width: 768px) {
    .demo-iframe-wrapper {
        padding-bottom: 80%; /* Taller on mobile */
    }

    .demo-iframe {
        width: 200%;
        height: 200%;
        transform: scale(0.5);
    }

    .demo-illustration-container {
        max-width: 100%;
    }
}

/* Hero phase */
.phase-hero .phase-content {
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.phase-hero-title {
    font-size: clamp(2.5rem, 8vw, 5rem);
    font-weight: 800;
    letter-spacing: -0.03em;
    line-height: 1.1;
    color: var(--color-text);
    margin-bottom: 1rem;
    max-width: 14ch;
}

.phase-hero-tagline {
    font-size: clamp(1.125rem, 2.5vw, 1.5rem);
    color: var(--color-text-muted);
    max-width: 40ch;
    line-height: 1.5;
}

.phase-hero-scroll-hint {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin-top: 3rem;
    font-size: 0.875rem;
    color: var(--color-text-dim);
    animation: bounce-subtle 2s ease-in-out infinite;
}

@keyframes bounce-subtle {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(6px); }
}

/* Text content */
.phase-headline {
    font-size: clamp(1.75rem, 4vw, 2.75rem);
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1.2;
    color: var(--color-text);
    margin-bottom: 1rem;
}

.phase-description {
    font-size: clamp(1rem, 1.5vw, 1.125rem);
    line-height: 1.7;
    color: var(--color-text-muted);
    max-width: 50ch;
}

/* Visual/Illustrations */
.phase-visual {
    display: flex;
    align-items: center;
    justify-content: center;
}

.problem-illustration,
.solution-illustration {
    width: clamp(200px, 30vw, 320px);
    height: clamp(200px, 30vw, 320px);
    display: flex;
    align-items: center;
    justify-content: center;
}

.problem-illustration svg,
.solution-illustration svg {
    width: 100%;
    height: 100%;
}

/* Accent colors for illustrations */
.accent-teal { color: var(--color-accent); }
.accent-violet { color: var(--color-violet); }
.accent-green { color: #34d399; }
.accent-blue { color: #60a5fa; }

/* Features grid */
.features-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-top: 2rem;
}

@media (max-width: 640px) {
    .features-grid {
        grid-template-columns: 1fr;
    }
}

.feature-card {
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    border-radius: 1rem;
    padding: 1.5rem;
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                border-color 0.3s ease,
                box-shadow 0.4s ease,
                opacity 0.5s ease;
    position: relative;
    overflow: hidden;
}

/* Subtle glow effect on hover */
.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--color-accent), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.feature-card:hover::before {
    opacity: 0.6;
}

.feature-card:hover {
    transform: translateY(-4px);
    border-color: var(--color-accent);
    box-shadow: 0 12px 40px -12px rgba(45, 212, 191, 0.15);
}

.feature-card.accent-violet::before {
    background: linear-gradient(90deg, transparent, var(--color-violet), transparent);
}

.feature-card.accent-violet:hover {
    border-color: var(--color-violet);
    box-shadow: 0 12px 40px -12px rgba(139, 92, 246, 0.15);
}

.feature-card.accent-green::before {
    background: linear-gradient(90deg, transparent, #34d399, transparent);
}

.feature-card.accent-green:hover {
    border-color: #34d399;
    box-shadow: 0 12px 40px -12px rgba(52, 211, 153, 0.15);
}

.feature-card.accent-blue::before {
    background: linear-gradient(90deg, transparent, #60a5fa, transparent);
}

.feature-card.accent-blue:hover {
    border-color: #60a5fa;
    box-shadow: 0 12px 40px -12px rgba(96, 165, 250, 0.15);
}

.feature-number {
    font-size: 0.875rem;
    font-weight: 700;
    font-variant-numeric: tabular-nums;
    font-family: var(--font-mono);
    color: var(--color-accent);
    margin-bottom: 0.75rem;
    opacity: 0.7;
}

.feature-card.accent-violet .feature-number {
    color: var(--color-violet);
}

.feature-card.accent-green .feature-number {
    color: #34d399;
}

.feature-card.accent-blue .feature-number {
    color: #60a5fa;
}

.feature-title {
    font-size: 1.125rem;
    font-weight: 600;
    color: var(--color-text);
    margin-bottom: 0.5rem;
}

.feature-description {
    font-size: 0.9375rem;
    line-height: 1.6;
    color: var(--color-text-muted);
}

/* CTA phase */
.phase-cta-headline {
    font-size: clamp(2rem, 5vw, 3.5rem);
    font-weight: 700;
    letter-spacing: -0.02em;
    line-height: 1.2;
    color: var(--color-text);
    max-width: 20ch;
}

.phase-cta-button {
    margin-top: 1rem;
}

.phase-cta-secondary {
    font-size: 0.9375rem;
    color: var(--color-text-muted);
    text-decoration: underline;
    text-underline-offset: 3px;
    transition: color 0.2s ease;
}

.phase-cta-secondary:hover {
    color: var(--color-accent);
}

/* Progress indicator */
.phase-progress {
    position: fixed;
    right: clamp(1rem, 3vw, 2rem);
    top: 50%;
    transform: translateY(-50%);
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    z-index: 10;
}

@media (max-width: 768px) {
    .phase-progress {
        right: 0.75rem;
        gap: 0.5rem;
    }
}

.phase-progress-dot {
    width: 12px;
    height: 12px;
    padding: 0;
    border: none;
    background: transparent;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.phase-progress-dot-inner {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--color-text-dim);
    transition: transform 0.3s ease, background-color 0.3s ease;
}

.phase-progress-dot:hover .phase-progress-dot-inner {
    transform: scale(1.3);
}

.phase-progress-dot.is-active .phase-progress-dot-inner {
    background: var(--color-accent);
    transform: scale(1.4);
}

.phase-progress-dot.is-past .phase-progress-dot-inner {
    background: var(--color-text-muted);
}

/* Reduced motion fallback - simple stacked sections */
@media (prefers-reduced-motion: reduce) {
    .service-scroll-container {
        min-height: auto;
    }

    .service-viewport {
        height: auto;
        overflow: visible;
    }

    .phase {
        position: relative;
        min-height: 100vh;
        opacity: 1 !important;
    }

    .phase-progress {
        display: none;
    }
}
</style>
