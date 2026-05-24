import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

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
