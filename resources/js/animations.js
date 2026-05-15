import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

export function initHeroAnimation() {
    const tl = gsap.timeline({ delay: 0.15 })

    tl.fromTo('[data-gsap="hero-eyebrow"]',
        { opacity: 0, y: 16 },
        { opacity: 1, y: 0, duration: 0.5, ease: 'power2.out' }
    )
    .fromTo('[data-gsap="hero-headline"]',
        { opacity: 0, y: 36 },
        { opacity: 1, y: 0, duration: 0.75, ease: 'power3.out' },
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

export function initScrollReveal() {
    const sections = gsap.utils.toArray('[data-gsap^="section-"]')

    sections.forEach(section => {
        gsap.fromTo(section,
            { opacity: 0, y: 48 },
            {
                opacity: 1,
                y: 0,
                duration: 0.75,
                ease: 'power2.out',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 85%',
                    toggleActions: 'play none none none',
                },
            }
        )
    })
}
