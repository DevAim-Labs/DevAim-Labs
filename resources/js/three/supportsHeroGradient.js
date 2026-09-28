// Deliberately separate from heroGradient.js, which statically imports the
// (large, ~120KB gzipped) three.js library. Keeping this check in its own
// tiny module means reduced-motion/low-end visitors never download three.js
// at all — HeroGradientCanvas.vue imports *this* file first, and only
// dynamically imports heroGradient.js when it returns true.
export function supportsHeroGradient() {
    if (typeof window === 'undefined') return false
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return false
    const canvas = document.createElement('canvas')
    const gl = canvas.getContext('webgl2')
    if (!gl) return false
    // Rough low-end heuristic: very few logical cores usually means an
    // old/low-power device where a persistent WebGL loop isn't worth it —
    // the CSS gradient fallback looks good enough there.
    if (typeof navigator.hardwareConcurrency === 'number' && navigator.hardwareConcurrency <= 2) return false
    return true
}
