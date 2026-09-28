<template>
    <component
        :is="tag"
        ref="buttonRef"
        :class="['magnetic-button', $attrs.class]"
        @mouseenter="onEnter"
        @mousemove="onMove"
        @mouseleave="onLeave"
    >
        <span ref="contentRef" class="magnetic-content">
            <slot />
        </span>
    </component>
</template>

<script setup>
import { ref } from 'vue'
import { gsap } from 'gsap'

const props = defineProps({
    /** HTML tag to render (default: button) */
    tag: { type: String, default: 'button' },
    /** Magnetic pull strength (0-1, default: 0.35) */
    strength: { type: Number, default: 0.35 },
    /** Animation duration (seconds) */
    duration: { type: Number, default: 0.3 },
})

const buttonRef = ref(null)
const contentRef = ref(null)
let bounds = null

const onEnter = () => {
    bounds = buttonRef.value?.getBoundingClientRect()
}

const onMove = (e) => {
    if (!bounds || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return
    if ('ontouchstart' in window) return // Skip on touch devices

    const x = e.clientX - bounds.left - bounds.width / 2
    const y = e.clientY - bounds.top - bounds.height / 2

    gsap.to(buttonRef.value, {
        x: x * props.strength,
        y: y * props.strength,
        duration: props.duration,
        ease: 'power2.out',
    })

    gsap.to(contentRef.value, {
        x: x * props.strength * 0.5,
        y: y * props.strength * 0.5,
        duration: props.duration,
        ease: 'power2.out',
    })
}

const onLeave = () => {
    gsap.to([buttonRef.value, contentRef.value], {
        x: 0,
        y: 0,
        duration: props.duration * 1.5,
        ease: 'elastic.out(1, 0.5)',
    })
    bounds = null
}
</script>

<style scoped>
.magnetic-button {
    display: inline-flex;
    position: relative;
    will-change: transform;
}
.magnetic-content {
    display: inherit;
    align-items: inherit;
    justify-content: inherit;
    will-change: transform;
}
</style>
