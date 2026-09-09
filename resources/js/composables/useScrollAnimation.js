import { ref, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

/**
 * Composable for scroll-triggered animations.
 * @param {Ref<HTMLElement>} targetRef - Vue ref to the element to animate
 * @param {Object} options - Animation options
 * @param {string} options.start - ScrollTrigger start position (default: 'top 85%')
 * @param {string} options.toggleActions - ScrollTrigger toggle actions
 * @param {Object} options.from - Initial animation state
 * @param {Object} options.to - Final animation state
 * @param {number} options.duration - Animation duration (default: 0.6)
 * @param {string} options.ease - Easing function (default: 'power3.out')
 */
export function useScrollAnimation(targetRef, options = {}) {
    const isVisible = ref(false)
    let scrollTrigger = null
    let animation = null

    const defaults = {
        start: 'top 85%',
        toggleActions: 'play none none none',
        from: { opacity: 0, y: 40 },
        to: { opacity: 1, y: 0 },
        duration: 0.6,
        ease: 'power3.out',
        ...options,
    }

    onMounted(() => {
        if (!targetRef.value) return
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            isVisible.value = true
            return
        }

        gsap.set(targetRef.value, defaults.from)

        animation = gsap.to(targetRef.value, {
            ...defaults.to,
            duration: defaults.duration,
            ease: defaults.ease,
            scrollTrigger: {
                trigger: targetRef.value,
                start: defaults.start,
                toggleActions: defaults.toggleActions,
                onEnter: () => {
                    isVisible.value = true
                },
            },
        })

        scrollTrigger = animation.scrollTrigger
    })

    onUnmounted(() => {
        if (animation) {
            animation.kill()
        }
        if (scrollTrigger) {
            scrollTrigger.kill()
        }
    })

    return { isVisible }
}

/**
 * Composable for staggered scroll animations on multiple children.
 * @param {Ref<HTMLElement>} containerRef - Vue ref to the container element
 * @param {string} childSelector - CSS selector for children to animate
 * @param {Object} options - Animation options
 */
export function useStaggeredScrollAnimation(containerRef, childSelector, options = {}) {
    const isVisible = ref(false)
    let scrollTrigger = null

    const defaults = {
        start: 'top 80%',
        from: { opacity: 0, y: 40, scale: 0.95 },
        to: { opacity: 1, y: 0, scale: 1 },
        duration: 0.6,
        stagger: 0.08,
        ease: 'power3.out',
        ...options,
    }

    onMounted(() => {
        if (!containerRef.value) return
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            isVisible.value = true
            return
        }

        const children = containerRef.value.querySelectorAll(childSelector)
        if (!children.length) return

        gsap.fromTo(children, defaults.from, {
            ...defaults.to,
            duration: defaults.duration,
            stagger: defaults.stagger,
            ease: defaults.ease,
            scrollTrigger: {
                trigger: containerRef.value,
                start: defaults.start,
                toggleActions: 'play none none none',
                onEnter: () => {
                    isVisible.value = true
                },
            },
        })
    })

    onUnmounted(() => {
        if (scrollTrigger) {
            scrollTrigger.kill()
        }
    })

    return { isVisible }
}
