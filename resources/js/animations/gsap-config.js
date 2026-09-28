import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

// Default easing curves
export const EASE = {
    smooth: 'power2.out',
    smoothIn: 'power2.in',
    smoothInOut: 'power2.inOut',
    bounce: 'back.out(1.7)',
    elastic: 'elastic.out(1, 0.5)',
    snap: 'power4.out',
    expo: 'expo.out',
}

// Default animation durations
export const DURATION = {
    fast: 0.3,
    normal: 0.5,
    slow: 0.8,
    verySlow: 1.2,
}

// Check for reduced motion preference
export function prefersReducedMotion() {
    return window.matchMedia('(prefers-reduced-motion: reduce)').matches
}

// Safe animation wrapper that respects reduced motion
export function animate(targets, vars, options = {}) {
    if (prefersReducedMotion() && !options.forceAnimate) {
        // Set final state immediately
        gsap.set(targets, {
            opacity: vars.opacity ?? 1,
            x: vars.x ?? 0,
            y: vars.y ?? 0,
            scale: vars.scale ?? 1,
            rotation: vars.rotation ?? 0,
        })
        return
    }
    return gsap.to(targets, vars)
}

// ScrollTrigger defaults
export const defaultScrollTrigger = {
    start: 'top 80%',
    end: 'bottom 20%',
    toggleActions: 'play none none reverse',
}

export { gsap, ScrollTrigger }
