import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

/**
 * Animation presets for different reveal types.
 */
const ANIMATION_TYPES = {
    fadeUp: { from: { opacity: 0, y: 60 }, to: { opacity: 1, y: 0 } },
    fadeIn: { from: { opacity: 0 }, to: { opacity: 1 } },
    slideLeft: { from: { opacity: 0, x: 80 }, to: { opacity: 1, x: 0 } },
    slideRight: { from: { opacity: 0, x: -80 }, to: { opacity: 1, x: 0 } },
    scaleUp: { from: { opacity: 0, scale: 0.85 }, to: { opacity: 1, scale: 1 } },
    rotateIn: { from: { opacity: 0, rotation: -5 }, to: { opacity: 1, rotation: 0 } },
}

export function initScrollReveal() {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        // Make all elements visible immediately
        document.querySelectorAll('[data-gsap^="section-"]').forEach(el => {
            el.style.opacity = '1'
            el.style.transform = 'none'
        })
        return
    }

    // Section-level reveals with configurable animation types
    initSectionReveals()

    // Staggered children reveals for grids/lists
    initStaggeredReveals()

    // Text split reveals
    initTextReveals()

    // Parallax elements
    initParallaxElements()
}

/**
 * Animate sections as they enter viewport.
 */
function initSectionReveals() {
    const sections = gsap.utils.toArray('[data-gsap^="section-"]')

    sections.forEach(section => {
        // Check for custom animation type via data attribute
        const animType = section.dataset.gsapType || 'fadeUp'
        const anim = ANIMATION_TYPES[animType] || ANIMATION_TYPES.fadeUp

        gsap.fromTo(section, anim.from, {
            ...anim.to,
            duration: 0.85,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: section,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
        })
    })
}

/**
 * Staggered animation for child elements within containers.
 * Use data-gsap-stagger on parent, items get staggered entrance.
 */
function initStaggeredReveals() {
    const staggerContainers = document.querySelectorAll('[data-gsap-stagger]')

    staggerContainers.forEach(container => {
        const selector = container.dataset.gsapStagger || '> *'
        const children = container.querySelectorAll(selector)

        if (!children.length) return

        const animType = container.dataset.gsapType || 'fadeUp'
        const anim = ANIMATION_TYPES[animType] || ANIMATION_TYPES.fadeUp
        const stagger = parseFloat(container.dataset.gsapDelay) || 0.08

        gsap.fromTo(children, anim.from, {
            ...anim.to,
            duration: 0.6,
            stagger,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: container,
                start: 'top 80%',
                toggleActions: 'play none none none',
            },
        })
    })
}

/**
 * Text reveal animations with word/character splitting.
 * Use data-gsap-text="word" or data-gsap-text="char" on text elements.
 */
function initTextReveals() {
    const textElements = document.querySelectorAll('[data-gsap-text]')

    textElements.forEach(el => {
        const splitType = el.dataset.gsapText || 'word'
        const text = el.textContent || ''

        // Split text into spans
        const segments = splitType === 'char' ? text.split('') : text.split(' ')
        el.innerHTML = segments.map((seg, i) =>
            `<span class="overflow-hidden inline-block"><span class="inline-block" style="transform: translateY(100%)">${seg}${splitType === 'word' && i < segments.length - 1 ? '&nbsp;' : ''}</span></span>`
        ).join('')

        const innerSpans = el.querySelectorAll('span > span')

        gsap.to(innerSpans, {
            y: '0%',
            duration: 0.6,
            stagger: splitType === 'char' ? 0.02 : 0.05,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: el,
                start: 'top 85%',
                toggleActions: 'play none none none',
            },
        })
    })
}

/**
 * Subtle parallax movement for decorative elements.
 * Use data-gsap-parallax="0.5" (speed multiplier) on elements.
 */
function initParallaxElements() {
    const parallaxElements = document.querySelectorAll('[data-gsap-parallax]')

    parallaxElements.forEach(el => {
        const speed = parseFloat(el.dataset.gsapParallax) || 0.5
        const direction = el.dataset.gsapDirection || 'y'
        const distance = 100 * speed

        const props = direction === 'y' ? { y: distance } : { x: distance }

        gsap.to(el, {
            ...props,
            ease: 'none',
            scrollTrigger: {
                trigger: el.parentElement || el,
                start: 'top bottom',
                end: 'bottom top',
                scrub: true,
            },
        })
    })
}

/**
 * Utility to refresh ScrollTrigger after dynamic content changes.
 */
export function refreshScrollTrigger() {
    ScrollTrigger.refresh()
}
