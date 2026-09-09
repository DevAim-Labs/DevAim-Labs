<template>
    <div
        ref="containerRef"
        class="marquee-container overflow-hidden"
        :style="containerStyle"
    >
        <div
            ref="trackRef"
            class="marquee-track flex"
            :style="trackStyle"
        >
            <slot></slot>
            <!-- Duplicate content for seamless loop -->
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'

const props = defineProps({
    speed: {
        type: Number,
        default: 40,
    },
    direction: {
        type: String,
        default: 'left',
        validator: (value) => ['left', 'right'].includes(value),
    },
    pauseOnHover: {
        type: Boolean,
        default: true,
    },
    gap: {
        type: String,
        default: '3rem',
    },
    fadeEdges: {
        type: Boolean,
        default: true,
    },
    vertical: {
        type: Boolean,
        default: false,
    },
})

const containerRef = ref(null)
const trackRef = ref(null)
let animation = null

const containerStyle = computed(() => ({
    maskImage: props.fadeEdges
        ? props.vertical
            ? 'linear-gradient(180deg, transparent, black 10%, black 90%, transparent)'
            : 'linear-gradient(90deg, transparent, black 10%, black 90%, transparent)'
        : 'none',
    WebkitMaskImage: props.fadeEdges
        ? props.vertical
            ? 'linear-gradient(180deg, transparent, black 10%, black 90%, transparent)'
            : 'linear-gradient(90deg, transparent, black 10%, black 90%, transparent)'
        : 'none',
}))

const trackStyle = computed(() => ({
    gap: props.gap,
    flexDirection: props.vertical ? 'column' : 'row',
}))

onMounted(() => {
    const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches
    if (reducedMotion || !trackRef.value) return

    const track = trackRef.value
    const isVertical = props.vertical
    const trackSize = isVertical ? track.scrollHeight / 2 : track.scrollWidth / 2
    const duration = trackSize / props.speed

    const animProps = isVertical
        ? { y: props.direction === 'up' ? -trackSize : trackSize }
        : { x: props.direction === 'left' ? -trackSize : trackSize }

    animation = gsap.to(track, {
        ...animProps,
        duration,
        ease: 'none',
        repeat: -1,
    })

    if (props.pauseOnHover) {
        containerRef.value.addEventListener('mouseenter', () => animation?.pause())
        containerRef.value.addEventListener('mouseleave', () => animation?.play())
    }
})

onUnmounted(() => {
    animation?.kill()
})
</script>

<style scoped>
.marquee-track {
    width: max-content;
}
</style>
