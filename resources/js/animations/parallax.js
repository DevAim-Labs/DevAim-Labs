import { gsap, ScrollTrigger, prefersReducedMotion } from './gsap-config'

/**
 * Simple parallax effect on scroll
 */
export function initParallax(element, options = {}) {
    if (prefersReducedMotion()) return

    const {
        speed = 0.5,
        direction = 'vertical',
        trigger = null,
        start = 'top bottom',
        end = 'bottom top',
    } = options

    const yPercent = direction === 'vertical' ? speed * 100 : 0
    const xPercent = direction === 'horizontal' ? speed * 100 : 0

    gsap.to(element, {
        yPercent: -yPercent,
        xPercent: -xPercent,
        ease: 'none',
        scrollTrigger: {
            trigger: trigger || element,
            start,
            end,
            scrub: true,
        },
    })
}

/**
 * Multi-layer parallax effect
 */
export function initLayeredParallax(container, options = {}) {
    if (prefersReducedMotion()) return

    const {
        selector = '[data-parallax-speed]',
        start = 'top bottom',
        end = 'bottom top',
    } = options

    const layers = container.querySelectorAll(selector)

    layers.forEach(layer => {
        const speed = parseFloat(layer.dataset.parallaxSpeed) || 0.5
        const direction = layer.dataset.parallaxDirection || 'vertical'

        initParallax(layer, { speed, direction, trigger: container, start, end })
    })
}

/**
 * Horizontal scroll section
 */
export function initHorizontalScroll(container, options = {}) {
    if (prefersReducedMotion()) return

    const {
        selector = '.horizontal-panel',
        pinSpacing = true,
    } = options

    const panels = container.querySelectorAll(selector)
    const totalWidth = Array.from(panels).reduce((acc, panel) => acc + panel.offsetWidth, 0)

    gsap.to(panels, {
        xPercent: -100 * (panels.length - 1),
        ease: 'none',
        scrollTrigger: {
            trigger: container,
            pin: true,
            pinSpacing,
            scrub: 1,
            snap: 1 / (panels.length - 1),
            end: () => `+=${totalWidth}`,
        },
    })
}

/**
 * Depth effect - elements move at different speeds based on z-index
 */
export function initDepthEffect(container, options = {}) {
    if (prefersReducedMotion()) return

    const {
        selector = '[data-depth]',
        baseSpeed = 0.1,
        start = 'top bottom',
        end = 'bottom top',
    } = options

    const elements = container.querySelectorAll(selector)

    elements.forEach(el => {
        const depth = parseFloat(el.dataset.depth) || 1
        const speed = baseSpeed * depth

        gsap.to(el, {
            yPercent: -speed * 100,
            ease: 'none',
            scrollTrigger: {
                trigger: container,
                start,
                end,
                scrub: true,
            },
        })
    })
}

/**
 * Mouse move parallax effect (not scroll-based)
 */
export function initMouseParallax(container, options = {}) {
    if (prefersReducedMotion()) return

    const {
        selector = '[data-mouse-parallax]',
        intensity = 0.1,
        smooth = 0.1,
    } = options

    const elements = container.querySelectorAll(selector)
    let mouseX = 0
    let mouseY = 0
    let currentX = 0
    let currentY = 0

    const handleMouseMove = (e) => {
        const rect = container.getBoundingClientRect()
        mouseX = (e.clientX - rect.left - rect.width / 2) / rect.width
        mouseY = (e.clientY - rect.top - rect.height / 2) / rect.height
    }

    const animate = () => {
        currentX += (mouseX - currentX) * smooth
        currentY += (mouseY - currentY) * smooth

        elements.forEach(el => {
            const depth = parseFloat(el.dataset.mouseParallax) || 1
            const moveX = currentX * intensity * depth * 100
            const moveY = currentY * intensity * depth * 100

            gsap.set(el, {
                x: moveX,
                y: moveY,
            })
        })

        requestAnimationFrame(animate)
    }

    container.addEventListener('mousemove', handleMouseMove)
    animate()

    return () => {
        container.removeEventListener('mousemove', handleMouseMove)
    }
}
