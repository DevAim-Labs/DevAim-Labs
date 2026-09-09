<template>
    <div
        ref="cardRef"
        :class="['animated-card', $attrs.class]"
        @mouseenter="onEnter"
        @mousemove="onMove"
        @mouseleave="onLeave"
    >
        <div ref="glowRef" class="card-spotlight"></div>
        <div class="card-content">
            <slot />
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { gsap } from 'gsap'

const props = defineProps({
    /** 3D tilt strength in degrees (default: 15) */
    tiltStrength: { type: Number, default: 15 },
    /** Spotlight glow size in pixels (default: 300) */
    glowSize: { type: Number, default: 300 },
    /** Spotlight glow opacity (0-1, default: 0.15) */
    glowOpacity: { type: Number, default: 0.15 },
    /** Enable 3D tilt effect (default: true) */
    enableTilt: { type: Boolean, default: true },
    /** Enable spotlight glow (default: true) */
    enableGlow: { type: Boolean, default: true },
})

const cardRef = ref(null)
const glowRef = ref(null)

let bounds = null

const onEnter = () => {
    bounds = cardRef.value?.getBoundingClientRect()
    if (props.enableGlow && glowRef.value) {
        gsap.to(glowRef.value, { opacity: props.glowOpacity, duration: 0.3 })
    }
}

const onMove = (e) => {
    if (!bounds || !cardRef.value) return
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return
    if ('ontouchstart' in window) return // Skip on touch devices

    const x = e.clientX - bounds.left
    const y = e.clientY - bounds.top
    const centerX = bounds.width / 2
    const centerY = bounds.height / 2

    // 3D tilt effect
    if (props.enableTilt) {
        const rotateX = ((y - centerY) / centerY) * -props.tiltStrength
        const rotateY = ((x - centerX) / centerX) * props.tiltStrength

        gsap.to(cardRef.value, {
            rotateX,
            rotateY,
            duration: 0.4,
            ease: 'power2.out',
            transformPerspective: 1000,
        })
    }

    // Spotlight glow following cursor
    if (props.enableGlow && glowRef.value) {
        gsap.to(glowRef.value, {
            x: x - props.glowSize / 2,
            y: y - props.glowSize / 2,
            duration: 0.2,
        })
    }
}

const onLeave = () => {
    if (props.enableTilt && cardRef.value) {
        gsap.to(cardRef.value, {
            rotateX: 0,
            rotateY: 0,
            duration: 0.5,
            ease: 'power3.out',
        })
    }

    if (props.enableGlow && glowRef.value) {
        gsap.to(glowRef.value, { opacity: 0, duration: 0.3 })
    }

    bounds = null
}
</script>

<style scoped>
.animated-card {
    position: relative;
    transform-style: preserve-3d;
    will-change: transform;
}

.card-spotlight {
    position: absolute;
    width: v-bind('glowSize + "px"');
    height: v-bind('glowSize + "px"');
    background: radial-gradient(circle, var(--color-accent) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
    opacity: 0;
    filter: blur(40px);
    z-index: 0;
}

.card-content {
    position: relative;
    z-index: 1;
}
</style>
