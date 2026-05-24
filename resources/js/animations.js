import { gsap } from 'gsap'

export function initHeroAnimation() {
    const targets = '[data-gsap="hero-eyebrow"], [data-gsap="hero-sub"], [data-gsap="hero-cta"]'

    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return
    }

    // Alleen subtiele beweging — geen opacity:0 (blijft zichtbaar op mobiel)
    gsap.fromTo(
        targets,
        { y: 14, opacity: 1 },
        { y: 0, duration: 0.55, ease: 'power2.out', stagger: 0.08 }
    )
}
