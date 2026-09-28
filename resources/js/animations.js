import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

export function initHeroAnimation() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return
    }

    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } })

    // Eyebrow animation with line expansion
    const eyebrowLine = document.querySelector('[data-gsap="hero-eyebrow"] span:first-child')
    const eyebrowText = document.querySelector('[data-gsap="hero-eyebrow"] span:last-child')

    if (eyebrowLine && eyebrowText) {
        tl.fromTo(eyebrowLine,
            { width: 0, opacity: 0 },
            { width: '1rem', opacity: 1, duration: 0.4 }
        )
        .fromTo(eyebrowText,
            { opacity: 0, x: -10 },
            { opacity: 1, x: 0, duration: 0.5 },
            '-=0.2'
        )
    }

    // Headline with clip-path reveal
    const headline = document.querySelector('[data-gsap="hero-headline"]')
    if (headline) {
        tl.fromTo(headline,
            { opacity: 0, y: 30, clipPath: 'inset(100% 0 0 0)' },
            { opacity: 1, y: 0, clipPath: 'inset(0% 0 0 0)', duration: 0.8 },
            '-=0.3'
        )
    }

    // Sub-copy slide up
    const subCopy = document.querySelector('[data-gsap="hero-sub"]')
    if (subCopy) {
        tl.fromTo(subCopy,
            { opacity: 0, y: 20 },
            { opacity: 1, y: 0, duration: 0.6 },
            '-=0.4'
        )
    }

    // CTAs with stagger
    const ctaContainer = document.querySelector('[data-gsap="hero-cta"]')
    if (ctaContainer) {
        const ctas = ctaContainer.querySelectorAll('a, button')
        if (ctas.length) {
            tl.fromTo(ctas,
                { opacity: 0, y: 15 },
                { opacity: 1, y: 0, duration: 0.5, stagger: 0.1 },
                '-=0.3'
            )
        }
    }

    // Initialize hero parallax effects
    initHeroParallax()
}

function initHeroParallax() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    const heroSection = document.querySelector('.hero-section, [data-section="hero"], section:first-of-type')
    if (!heroSection) return

    // Floating cubes move at different speeds
    const cubes = document.querySelectorAll('.hero-cube, [class*="cube-rotate"]')
    if (cubes.length) {
        gsap.to(cubes, {
            y: -100,
            scrollTrigger: {
                trigger: heroSection,
                start: 'top top',
                end: 'bottom top',
                scrub: 1.5,
            },
        })
    }

    // Orb subtle scale and fade
    const orb = document.querySelector('.hero-orb, [class*="orb"]')
    if (orb) {
        gsap.to(orb, {
            scale: 1.1,
            opacity: 0.5,
            scrollTrigger: {
                trigger: heroSection,
                start: 'top top',
                end: 'bottom top',
                scrub: 2,
            },
        })
    }

    // Background image parallax
    const bgImg = document.querySelector('.hero-bg-img, [class*="hero"] img:first-of-type')
    if (bgImg) {
        gsap.to(bgImg, {
            y: 80,
            scrollTrigger: {
                trigger: heroSection,
                start: 'top top',
                end: 'bottom top',
                scrub: 1,
            },
        })
    }

    // Hero content moves up slightly as you scroll
    const heroContent = document.querySelector('.hero-content, [data-gsap="hero-cta"]')?.parentElement
    if (heroContent) {
        gsap.to(heroContent, {
            y: -30,
            opacity: 0.8,
            scrollTrigger: {
                trigger: heroSection,
                start: 'top top',
                end: 'center top',
                scrub: 1,
            },
        })
    }
}
