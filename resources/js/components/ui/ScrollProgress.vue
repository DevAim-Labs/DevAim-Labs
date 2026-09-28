<template>
    <div
        v-if="!reducedMotion"
        ref="progressRef"
        class="scroll-progress"
        :style="progressStyle"
    ></div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const props = defineProps({
    gradient: {
        type: Boolean,
        default: true,
    },
    color: {
        type: String,
        default: 'var(--color-accent)',
    },
    gradientEnd: {
        type: String,
        default: 'var(--color-violet)',
    },
    height: {
        type: String,
        default: '3px',
    },
    zIndex: {
        type: Number,
        default: 9999,
    },
})

const progressRef = ref(null)
const reducedMotion = ref(false)

const progressStyle = computed(() => ({
    height: props.height,
    zIndex: props.zIndex,
    background: props.gradient
        ? `linear-gradient(90deg, ${props.color}, ${props.gradientEnd})`
        : props.color,
    transformOrigin: 'left',
    transform: 'scaleX(0)',
}))

onMounted(() => {
    reducedMotion.value = window.matchMedia('(prefers-reduced-motion: reduce)').matches
    if (reducedMotion.value || !progressRef.value) return

    gsap.to(progressRef.value, {
        scaleX: 1,
        ease: 'none',
        scrollTrigger: {
            trigger: document.documentElement,
            start: 'top top',
            end: 'bottom bottom',
            scrub: 0.3,
        },
    })
})

onUnmounted(() => {
    ScrollTrigger.getAll().forEach(trigger => {
        if (trigger.vars?.trigger === document.documentElement) {
            trigger.kill()
        }
    })
})
</script>

<style scoped>
.scroll-progress {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    pointer-events: none;
}
</style>
