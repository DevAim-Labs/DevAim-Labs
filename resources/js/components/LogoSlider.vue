<template>
    <section class="py-12 md:py-16 overflow-hidden" style="background: var(--color-surface);">
        <div class="max-w-6xl mx-auto px-6">
            <p v-if="displayTitle" class="section-eyebrow mb-8 text-center">{{ displayTitle }}</p>

            <!-- Horizontal Loop Marquee -->
            <div
                ref="marqueeContainer"
                class="marquee-container"
            >
                <div ref="marqueeTrack" class="marquee-track">
                    <!-- First set of logos -->
                    <div
                        v-for="(logo, index) in logos"
                        :key="'a-' + index"
                        class="logo-item"
                    >
                        <img
                            :src="logo.src"
                            :alt="logo.alt"
                            class="logo-img"
                            :class="{ 'grayscale hover:grayscale-0': grayscale }"
                            loading="lazy"
                        />
                    </div>
                    <!-- Duplicate set for seamless infinite loop -->
                    <div
                        v-for="(logo, index) in logos"
                        :key="'b-' + index"
                        class="logo-item"
                    >
                        <img
                            :src="logo.src"
                            :alt="logo.alt"
                            class="logo-img"
                            :class="{ 'grayscale hover:grayscale-0': grayscale }"
                            loading="lazy"
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'

// Import logo assets
import lokantaLogo from '../../assets/lokanta.webp'
import slowdownLogo from '../../assets/slowdown.webp'

const locale = window.__LOCALE__ || 'nl'
const isEn = locale === 'en'

const defaultTitle = computed(() => isEn ? 'Trusted by' : 'Vertrouwd door')

const props = defineProps({
    title: {
        type: String,
        default: null
    },
    grayscale: {
        type: Boolean,
        default: true
    },
    speed: {
        type: Number,
        default: 40 // pixels per second
    },
    direction: {
        type: String,
        default: 'left', // 'left' or 'right'
        validator: (value) => ['left', 'right'].includes(value)
    }
})

const displayTitle = computed(() => props.title || defaultTitle.value)

// Logo data - add your logos here
const logos = [
    { src: lokantaLogo, alt: 'Lokanta' },
    { src: slowdownLogo, alt: 'Slowdown' },
    { src: lokantaLogo, alt: 'Lokanta' },
    { src: slowdownLogo, alt: 'Slowdown' },
    { src: lokantaLogo, alt: 'Lokanta' },
    { src: slowdownLogo, alt: 'Slowdown' },
]

const marqueeContainer = ref(null)
const marqueeTrack = ref(null)
let animation = null

onMounted(() => {
    // Respect reduced motion preference
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return
    if (!marqueeTrack.value) return

    const track = marqueeTrack.value
    const trackWidth = track.scrollWidth / 2
    const duration = trackWidth / props.speed

    // Create infinite loop animation
    animation = gsap.to(track, {
        x: props.direction === 'left' ? -trackWidth : trackWidth,
        duration,
        ease: 'none',
        repeat: -1,
    })

    // Set initial position for right direction
    if (props.direction === 'right') {
        gsap.set(track, { x: -trackWidth })
    }

    // Pause on hover for better UX
    const container = marqueeContainer.value
    const handleMouseEnter = () => animation?.pause()
    const handleMouseLeave = () => animation?.play()

    container?.addEventListener('mouseenter', handleMouseEnter)
    container?.addEventListener('mouseleave', handleMouseLeave)
})

onUnmounted(() => {
    animation?.kill()
})
</script>

<style scoped>
.marquee-container {
    overflow: hidden;
    /* Smooth fade edges */
    mask-image: linear-gradient(
        90deg,
        transparent 0%,
        black 10%,
        black 90%,
        transparent 100%
    );
    -webkit-mask-image: linear-gradient(
        90deg,
        transparent 0%,
        black 10%,
        black 90%,
        transparent 100%
    );
}

.marquee-track {
    display: flex;
    align-items: center;
    width: max-content;
    gap: 4rem;
}

.logo-item {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    /* No background - transparent */
}

.logo-img {
    height: 2.5rem;
    width: auto;
    max-width: 140px;
    object-fit: contain;
    opacity: 0.5;
    transition: opacity 0.3s ease, filter 0.3s ease, transform 0.3s ease;
    /* Ensure transparent background is visible */
    background: transparent;
}

.logo-img:hover {
    opacity: 1;
    transform: scale(1.05);
}

/* Light theme adjustment */
html[data-theme="light"] .logo-img {
    filter: brightness(0.2);
}

html[data-theme="light"] .logo-img:hover {
    filter: brightness(0);
}

html[data-theme="light"] .logo-img.grayscale {
    filter: brightness(0.2) grayscale(1);
}

html[data-theme="light"] .logo-img.grayscale:hover {
    filter: brightness(0) grayscale(0);
}

@media (min-width: 768px) {
    .marquee-track {
        gap: 5rem;
    }

    .logo-img {
        height: 3rem;
        max-width: 160px;
    }
}

@media (min-width: 1024px) {
    .marquee-track {
        gap: 6rem;
    }

    .logo-img {
        height: 3.5rem;
        max-width: 180px;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .marquee-track {
        animation: none !important;
    }

    .logo-img {
        transition: none;
    }
}
</style>
