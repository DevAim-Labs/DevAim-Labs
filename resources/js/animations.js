import { gsap } from 'gsap'

export function initHeroAnimation() {
    const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches
    if (prefersReduced) return

    const tl = gsap.timeline({ delay: 0.1 })

    tl.fromTo('[data-gsap="hero-eyebrow"]',
        { opacity: 0, y: 16 },
        { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }
    )
    .fromTo('[data-gsap="hero-headline"]',
        { y: 28 },
        { y: 0, duration: 0.75, ease: 'power3.out' },
        '-=0.2'
    )
    .fromTo('[data-gsap="hero-sub"]',
        { opacity: 0, y: 20 },
        { opacity: 1, y: 0, duration: 0.6, ease: 'power2.out' },
        '-=0.45'
    )
    .fromTo('[data-gsap="hero-cta"]',
        { opacity: 0, y: 16 },
        { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' },
        '-=0.35'
    )
}
