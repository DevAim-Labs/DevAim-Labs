import { onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

/**
 * Composable for parallax scrolling effects.
 * Element moves at a different speed than scroll, creating depth.
 *
 * @param {Ref<HTMLElement>} elementRef - Vue ref to the element
 * @param {Object} options - Parallax options
 * @param {number} options.speed - Parallax speed multiplier (default: 0.5, negative for opposite direction)
 * @param {string} options.direction - Movement direction: 'y' or 'x' (default: 'y')
 * @param {string} options.start - ScrollTrigger start (default: 'top bottom')
 * @param {string} options.end - ScrollTrigger end (default: 'bottom top')
 */
export function useParallax(elementRef, options = {}) {
    const { speed = 0.5, direction = 'y', start = 'top bottom', end = 'bottom top' } = options
    let animation = null

    onMounted(() => {
        if (!elementRef.value) return
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

        const distance = 100 * speed
        const props = direction === 'y' ? { y: distance } : { x: distance }

        animation = gsap.to(elementRef.value, {
            ...props,
            ease: 'none',
            scrollTrigger: {
                trigger: elementRef.value.parentElement || elementRef.value,
                start,
                end,
                scrub: true,
            },
        })
    })

    onUnmounted(() => {
        if (animation?.scrollTrigger) {
            animation.scrollTrigger.kill()
        }
        if (animation) {
            animation.kill()
        }
    })
}

/**
 * Composable for multiple parallax layers with different speeds.
 * Useful for hero sections with multiple moving elements.
 *
 * @param {Ref<HTMLElement>} containerRef - Vue ref to the container element
 * @param {Array} layers - Array of layer configurations
 * @param {string} layers[].selector - CSS selector for the layer element
 * @param {number} layers[].speed - Parallax speed for this layer
 * @param {string} layers[].direction - Movement direction: 'y' or 'x'
 */
export function useMultiLayerParallax(containerRef, layers = []) {
    let animations = []

    onMounted(() => {
        if (!containerRef.value) return
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

        layers.forEach(layer => {
            const elements = containerRef.value.querySelectorAll(layer.selector)
            if (!elements.length) return

            const distance = 100 * (layer.speed || 0.5)
            const props = (layer.direction || 'y') === 'y' ? { y: distance } : { x: distance }

            elements.forEach(el => {
                const anim = gsap.to(el, {
                    ...props,
                    ease: 'none',
                    scrollTrigger: {
                        trigger: containerRef.value,
                        start: 'top top',
                        end: 'bottom top',
                        scrub: layer.scrub || 1.5,
                    },
                })
                animations.push(anim)
            })
        })
    })

    onUnmounted(() => {
        animations.forEach(anim => {
            if (anim?.scrollTrigger) {
                anim.scrollTrigger.kill()
            }
            if (anim) {
                anim.kill()
            }
        })
        animations = []
    })
}
