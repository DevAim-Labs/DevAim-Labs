import { gsap, prefersReducedMotion } from './gsap-config'

/**
 * Spotlight effect - cursor-following glow on cards
 */
export function initSpotlight(container, options = {}) {
    if (prefersReducedMotion()) return

    const {
        color = 'rgba(23, 199, 188, 0.15)',
        size = 400,
        intensity = 1,
    } = options

    // Create spotlight element if not exists
    let spotlight = container.querySelector('.spotlight-glow')
    if (!spotlight) {
        spotlight = document.createElement('div')
        spotlight.className = 'spotlight-glow'
        spotlight.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            border-radius: 50%;
            pointer-events: none;
            opacity: 0;
            transition: opacity 0.3s ease;
            transform: translate(-50%, -50%);
            background: radial-gradient(circle, ${color} 0%, transparent 70%);
            z-index: 0;
        `
        container.style.position = 'relative'
        container.style.overflow = 'hidden'
        container.insertBefore(spotlight, container.firstChild)
    }

    const handleMouseMove = (e) => {
        const rect = container.getBoundingClientRect()
        const x = e.clientX - rect.left
        const y = e.clientY - rect.top

        gsap.to(spotlight, {
            x,
            y,
            duration: 0.3,
            ease: 'power2.out',
        })
    }

    const handleMouseEnter = () => {
        gsap.to(spotlight, { opacity: intensity, duration: 0.3 })
    }

    const handleMouseLeave = () => {
        gsap.to(spotlight, { opacity: 0, duration: 0.3 })
    }

    container.addEventListener('mousemove', handleMouseMove)
    container.addEventListener('mouseenter', handleMouseEnter)
    container.addEventListener('mouseleave', handleMouseLeave)

    // Return cleanup function
    return () => {
        container.removeEventListener('mousemove', handleMouseMove)
        container.removeEventListener('mouseenter', handleMouseEnter)
        container.removeEventListener('mouseleave', handleMouseLeave)
    }
}

/**
 * 3D tilt effect on hover
 */
export function initTilt(element, options = {}) {
    if (prefersReducedMotion()) return

    const {
        maxRotation = 8,
        perspective = 1000,
        scale = 1.02,
        speed = 0.4,
    } = options

    element.style.transformStyle = 'preserve-3d'
    element.style.perspective = `${perspective}px`

    const handleMouseMove = (e) => {
        const rect = element.getBoundingClientRect()
        const centerX = rect.left + rect.width / 2
        const centerY = rect.top + rect.height / 2
        const mouseX = e.clientX - centerX
        const mouseY = e.clientY - centerY

        const rotateY = (mouseX / (rect.width / 2)) * maxRotation
        const rotateX = -(mouseY / (rect.height / 2)) * maxRotation

        gsap.to(element, {
            rotateX,
            rotateY,
            scale,
            duration: speed,
            ease: 'power2.out',
        })
    }

    const handleMouseLeave = () => {
        gsap.to(element, {
            rotateX: 0,
            rotateY: 0,
            scale: 1,
            duration: speed,
            ease: 'power2.out',
        })
    }

    element.addEventListener('mousemove', handleMouseMove)
    element.addEventListener('mouseleave', handleMouseLeave)

    return () => {
        element.removeEventListener('mousemove', handleMouseMove)
        element.removeEventListener('mouseleave', handleMouseLeave)
    }
}

/**
 * Combined spotlight + tilt effect for cards
 */
export function initSpotlightCard(element, options = {}) {
    const {
        spotlightColor = 'rgba(23, 199, 188, 0.15)',
        spotlightSize = 400,
        tiltMaxRotation = 6,
        tiltScale = 1.02,
    } = options

    const cleanupSpotlight = initSpotlight(element, {
        color: spotlightColor,
        size: spotlightSize,
    })

    const cleanupTilt = initTilt(element, {
        maxRotation: tiltMaxRotation,
        scale: tiltScale,
    })

    return () => {
        cleanupSpotlight?.()
        cleanupTilt?.()
    }
}
