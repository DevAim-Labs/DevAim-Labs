// Central animation exports
export * from './gsap-config'
export * from './text-effects'
export * from './spotlight'
export * from './parallax'
export * from './marquee'

// Re-export commonly used utilities
export { gsap, ScrollTrigger, EASE, DURATION, prefersReducedMotion } from './gsap-config'
export { textScramble, wordReveal, charReveal, splitText, typewriter } from './text-effects'
export { initSpotlight, initTilt, initSpotlightCard } from './spotlight'
export { initParallax, initLayeredParallax, initDepthEffect, initMouseParallax } from './parallax'
export { initMarquee, initVerticalMarquee, initScrollMarquee } from './marquee'
