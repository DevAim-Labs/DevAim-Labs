import { gsap, prefersReducedMotion } from './gsap-config'

/**
 * Infinite marquee/ticker animation
 */
export function initMarquee(container, options = {}) {
    if (prefersReducedMotion()) {
        // Just show content without animation
        const track = container.querySelector('.marquee-track')
        if (track) {
            track.style.animation = 'none'
        }
        return
    }

    const {
        speed = 40,
        direction = 'left',
        pauseOnHover = true,
    } = options

    const track = container.querySelector('.marquee-track')
    if (!track) return

    // Clone content for seamless loop
    const items = track.innerHTML
    track.innerHTML = items + items

    // Calculate animation duration based on content width
    const trackWidth = track.scrollWidth / 2
    const duration = trackWidth / speed

    // Create GSAP animation for smoother control
    const tl = gsap.to(track, {
        x: direction === 'left' ? -trackWidth : trackWidth,
        duration,
        ease: 'none',
        repeat: -1,
    })

    if (pauseOnHover) {
        container.addEventListener('mouseenter', () => tl.pause())
        container.addEventListener('mouseleave', () => tl.play())
    }

    return tl
}

/**
 * Vertical marquee (for testimonials, etc.)
 */
export function initVerticalMarquee(container, options = {}) {
    if (prefersReducedMotion()) return

    const {
        speed = 30,
        direction = 'up',
        pauseOnHover = true,
    } = options

    const track = container.querySelector('.marquee-track')
    if (!track) return

    // Clone content
    const items = track.innerHTML
    track.innerHTML = items + items

    const trackHeight = track.scrollHeight / 2
    const duration = trackHeight / speed

    const tl = gsap.to(track, {
        y: direction === 'up' ? -trackHeight : trackHeight,
        duration,
        ease: 'none',
        repeat: -1,
    })

    if (pauseOnHover) {
        container.addEventListener('mouseenter', () => tl.pause())
        container.addEventListener('mouseleave', () => tl.play())
    }

    return tl
}

/**
 * Scroll-linked marquee (moves based on scroll direction)
 */
export function initScrollMarquee(container, options = {}) {
    if (prefersReducedMotion()) return

    const {
        speed = 0.5,
        baseSpeed = 1,
    } = options

    const track = container.querySelector('.marquee-track')
    if (!track) return

    // Clone content
    const items = track.innerHTML
    track.innerHTML = items + items

    let currentScroll = 0
    let targetScroll = 0
    let scrollVelocity = 0
    let lastScroll = window.scrollY

    const updateScroll = () => {
        const newScroll = window.scrollY
        scrollVelocity = newScroll - lastScroll
        lastScroll = newScroll
    }

    const animate = () => {
        targetScroll += baseSpeed + (scrollVelocity * speed)
        currentScroll += (targetScroll - currentScroll) * 0.1

        const trackWidth = track.scrollWidth / 2
        if (currentScroll >= trackWidth) {
            currentScroll -= trackWidth
            targetScroll -= trackWidth
        } else if (currentScroll <= -trackWidth) {
            currentScroll += trackWidth
            targetScroll += trackWidth
        }

        gsap.set(track, { x: -currentScroll })
        requestAnimationFrame(animate)
    }

    window.addEventListener('scroll', updateScroll)
    animate()

    return () => {
        window.removeEventListener('scroll', updateScroll)
    }
}
