<script setup>
// Subtle animated gradient-mesh background for a hero section — the one
// WebGL surface on the site (see design plan). Always renders the CSS
// fallback gradient first (so there's never a blank/missing background);
// the canvas only mounts on top when the device/motion-preference actually
// supports it, and it fully pauses off-screen and on a hidden tab.
import { ref, onMounted, onBeforeUnmount } from 'vue'

const canvasEl = ref(null)
const rootEl = ref(null)
const active = ref(false)

let controls = null
let intersectionObserver = null

function onVisibilityChange() {
    if (!controls) return
    if (document.hidden) controls.stop()
    else if (active.value) controls.start()
}

onMounted(async () => {
    // Cheap, three.js-free check first — reduced-motion/low-end/no-WebGL2
    // visitors never download the (~120KB gzipped) three.js bundle at all.
    const { supportsHeroGradient } = await import('../../three/supportsHeroGradient.js')
    if (!supportsHeroGradient() || !canvasEl.value) return

    const { createHeroGradient } = await import('../../three/heroGradient.js')
    if (!canvasEl.value) return // unmounted while the chunk was loading

    controls = createHeroGradient(canvasEl.value)
    active.value = true

    intersectionObserver = new IntersectionObserver(
        ([entry]) => {
            if (entry.isIntersecting && !document.hidden) controls.start()
            else controls.stop()
        },
        { threshold: 0.05 }
    )
    intersectionObserver.observe(rootEl.value)
    document.addEventListener('visibilitychange', onVisibilityChange)
})

onBeforeUnmount(() => {
    intersectionObserver?.disconnect()
    document.removeEventListener('visibilitychange', onVisibilityChange)
    controls?.destroy()
})
</script>

<template>
    <div ref="rootEl" class="hero-gradient-root" aria-hidden="true">
        <div class="hero-gradient-css"></div>
        <canvas ref="canvasEl" class="hero-gradient-canvas" :class="{ 'is-visible': active }"></canvas>
    </div>
</template>

<style scoped>
.hero-gradient-root {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
}

/* Static fallback: shown alone under reduced-motion/no-WebGL2/low-end, and
   underneath the canvas everywhere else while it fades in — a faint,
   static signal-grid so the two states read as the same idea, not a
   glow-vs-lines mismatch. */
.hero-gradient-css {
    position: absolute;
    inset: 0;
    background-image:
        repeating-linear-gradient(0deg, var(--color-border-dim) 0, var(--color-border-dim) 1px, transparent 1px, transparent 56px),
        repeating-linear-gradient(90deg, var(--color-border-dim) 0, var(--color-border-dim) 1px, transparent 1px, transparent 56px),
        radial-gradient(ellipse 55% 45% at 50% 25%, var(--color-accent-glow), transparent 65%);
}

.hero-gradient-canvas {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    /* Entering content: ease-out, ~250ms, opacity-only (see the `animate`
       skill) — a crossfade from the static grid to the live one. */
    transition: opacity 0.25s cubic-bezier(0.23, 1, 0.32, 1);
}
.hero-gradient-canvas.is-visible {
    opacity: 1;
}

@media (prefers-reduced-motion: reduce) {
    .hero-gradient-canvas {
        transition: none;
    }
}
</style>
