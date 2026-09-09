import Lenis from 'lenis'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

let lenis = null

/**
 * Initialize Lenis smooth scroll with GSAP ScrollTrigger integration.
 * Respects prefers-reduced-motion for accessibility.
 */
export function initSmoothScroll() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return null
    }

    lenis = new Lenis({
        duration: 1.2,
        easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // easeOutExpo
        orientation: 'vertical',
        gestureOrientation: 'vertical',
        smoothWheel: true,
        wheelMultiplier: 1,
        touchMultiplier: 2,
    })

    // Integrate with GSAP ScrollTrigger
    lenis.on('scroll', ScrollTrigger.update)

    gsap.ticker.add((time) => {
        lenis.raf(time * 1000)
    })
    gsap.ticker.lagSmoothing(0)

    return lenis
}

/**
 * Smooth scroll to a target element or position.
 * @param {string|HTMLElement|number} target - CSS selector, element, or scroll position
 * @param {Object} options - Scroll options
 * @param {number} options.offset - Offset from target (default: 0)
 * @param {number} options.duration - Animation duration (default: 1.2)
 * @param {boolean} options.immediate - Skip animation (default: false)
 */
export function scrollTo(target, options = {}) {
    if (lenis) {
        lenis.scrollTo(target, {
            offset: options.offset || 0,
            duration: options.duration || 1.2,
            immediate: options.immediate || false,
            ...options
        })
    } else {
        // Fallback for reduced motion or if Lenis not initialized
        const element = typeof target === 'string' ? document.querySelector(target) : target
        if (element instanceof HTMLElement) {
            element.scrollIntoView({ behavior: 'auto', block: 'start' })
        } else if (typeof target === 'number') {
            window.scrollTo({ top: target, behavior: 'auto' })
        }
    }
}

/**
 * Get the Lenis instance for direct control.
 * @returns {Lenis|null}
 */
export function getLenis() {
    return lenis
}

/**
 * Stop Lenis scrolling (useful for modals/overlays).
 */
export function stopScroll() {
    if (lenis) {
        lenis.stop()
    }
}

/**
 * Resume Lenis scrolling.
 */
export function startScroll() {
    if (lenis) {
        lenis.start()
    }
}

/**
 * Destroy Lenis instance (cleanup).
 */
export function destroyScroll() {
    if (lenis) {
        lenis.destroy()
        lenis = null
    }
}
