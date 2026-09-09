<template>
    <div
        ref="cardRef"
        class="spotlight-card relative overflow-hidden rounded-2xl transition-all duration-300"
        :class="[cardClasses]"
        :style="cardStyle"
    >
        <!-- Spotlight glow -->
        <div
            ref="spotlightRef"
            class="spotlight-glow absolute pointer-events-none opacity-0 transition-opacity duration-300"
            :style="spotlightStyle"
        ></div>

        <!-- Border glow effect -->
        <div
            v-if="borderGlow"
            class="absolute inset-0 rounded-2xl pointer-events-none transition-opacity duration-300"
            :class="{ 'opacity-100': isHovered, 'opacity-0': !isHovered }"
            :style="borderGlowStyle"
        ></div>

        <!-- Content -->
        <div class="relative z-10" :style="contentStyle">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'

const props = defineProps({
    color: {
        type: String,
        default: 'accent',
        validator: (value) => ['accent', 'violet', 'warm'].includes(value),
    },
    intensity: {
        type: Number,
        default: 0.15,
    },
    size: {
        type: Number,
        default: 400,
    },
    tilt: {
        type: Boolean,
        default: true,
    },
    maxRotation: {
        type: Number,
        default: 6,
    },
    scale: {
        type: Number,
        default: 1.02,
    },
    borderGlow: {
        type: Boolean,
        default: true,
    },
    bg: {
        type: String,
        default: 'var(--color-surface-1)',
    },
    padding: {
        type: String,
        default: '1.5rem',
    },
})

const cardRef = ref(null)
const spotlightRef = ref(null)
const isHovered = ref(false)
const reducedMotion = ref(false)

const colorMap = {
    accent: 'rgba(23, 199, 188, VAR)',
    violet: 'rgba(139, 92, 246, VAR)',
    warm: 'rgba(245, 166, 35, VAR)',
}

const cardClasses = computed(() => [
    'border',
    'border-[var(--color-border-dim)]',
    { 'card-3d': props.tilt && !reducedMotion.value },
])

const cardStyle = computed(() => ({
    background: props.bg,
    transformStyle: props.tilt ? 'preserve-3d' : 'flat',
    perspective: props.tilt ? '1000px' : 'none',
}))

const spotlightStyle = computed(() => ({
    width: `${props.size}px`,
    height: `${props.size}px`,
    borderRadius: '50%',
    background: `radial-gradient(circle, ${colorMap[props.color].replace('VAR', props.intensity)} 0%, transparent 70%)`,
    transform: 'translate(-50%, -50%)',
}))

const borderGlowStyle = computed(() => ({
    boxShadow: `inset 0 0 0 1px ${colorMap[props.color].replace('VAR', '0.3')}`,
}))

const contentStyle = computed(() => ({
    padding: props.padding,
}))

onMounted(() => {
    reducedMotion.value = window.matchMedia('(prefers-reduced-motion: reduce)').matches
    if (reducedMotion.value || !cardRef.value) return

    const card = cardRef.value
    const spotlight = spotlightRef.value

    const handleMouseMove = (e) => {
        const rect = card.getBoundingClientRect()
        const x = e.clientX - rect.left
        const y = e.clientY - rect.top

        // Move spotlight
        gsap.to(spotlight, {
            x,
            y,
            duration: 0.3,
            ease: 'power2.out',
        })

        // Tilt effect
        if (props.tilt) {
            const centerX = rect.width / 2
            const centerY = rect.height / 2
            const rotateY = ((x - centerX) / centerX) * props.maxRotation
            const rotateX = -((y - centerY) / centerY) * props.maxRotation

            gsap.to(card, {
                rotateX,
                rotateY,
                scale: props.scale,
                duration: 0.4,
                ease: 'power2.out',
            })
        }
    }

    const handleMouseEnter = () => {
        isHovered.value = true
        gsap.to(spotlight, { opacity: 1, duration: 0.3 })
    }

    const handleMouseLeave = () => {
        isHovered.value = false
        gsap.to(spotlight, { opacity: 0, duration: 0.3 })

        if (props.tilt) {
            gsap.to(card, {
                rotateX: 0,
                rotateY: 0,
                scale: 1,
                duration: 0.4,
                ease: 'power2.out',
            })
        }
    }

    card.addEventListener('mousemove', handleMouseMove)
    card.addEventListener('mouseenter', handleMouseEnter)
    card.addEventListener('mouseleave', handleMouseLeave)

    onUnmounted(() => {
        card.removeEventListener('mousemove', handleMouseMove)
        card.removeEventListener('mouseenter', handleMouseEnter)
        card.removeEventListener('mouseleave', handleMouseLeave)
    })
})
</script>

<style scoped>
.spotlight-card {
    will-change: transform;
}

.spotlight-card:hover {
    border-color: var(--color-border);
}
</style>
