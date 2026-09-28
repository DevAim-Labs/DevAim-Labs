import { onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'

/**
 * Composable for magnetic pull effect on elements.
 * Element moves toward cursor when hovered, creating a magnetic attraction effect.
 *
 * @param {Ref<HTMLElement>} elementRef - Vue ref to the element
 * @param {Object} options - Effect options
 * @param {number} options.strength - Pull strength (0-1, default: 0.35)
 * @param {number} options.duration - Animation duration (default: 0.3)
 * @param {Ref<HTMLElement>} options.contentRef - Optional inner content ref for secondary movement
 */
export function useMagneticEffect(elementRef, options = {}) {
    const { strength = 0.35, duration = 0.3, contentRef = null } = options
    let bounds = null

    const onEnter = () => {
        if (!elementRef.value) return
        bounds = elementRef.value.getBoundingClientRect()
    }

    const onMove = (e) => {
        if (!bounds || !elementRef.value) return
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

        const x = e.clientX - bounds.left - bounds.width / 2
        const y = e.clientY - bounds.top - bounds.height / 2

        gsap.to(elementRef.value, {
            x: x * strength,
            y: y * strength,
            duration,
            ease: 'power2.out',
        })

        if (contentRef?.value) {
            gsap.to(contentRef.value, {
                x: x * strength * 0.5,
                y: y * strength * 0.5,
                duration,
                ease: 'power2.out',
            })
        }
    }

    const onLeave = () => {
        if (!elementRef.value) return

        gsap.to(elementRef.value, {
            x: 0,
            y: 0,
            duration: duration * 1.5,
            ease: 'elastic.out(1, 0.5)',
        })

        if (contentRef?.value) {
            gsap.to(contentRef.value, {
                x: 0,
                y: 0,
                duration: duration * 1.5,
                ease: 'elastic.out(1, 0.5)',
            })
        }

        bounds = null
    }

    onMounted(() => {
        const el = elementRef.value
        if (!el) return

        // Skip on touch devices
        if ('ontouchstart' in window) return

        el.addEventListener('mouseenter', onEnter)
        el.addEventListener('mousemove', onMove)
        el.addEventListener('mouseleave', onLeave)
    })

    onUnmounted(() => {
        const el = elementRef.value
        if (!el) return

        el.removeEventListener('mouseenter', onEnter)
        el.removeEventListener('mousemove', onMove)
        el.removeEventListener('mouseleave', onLeave)
    })
}
