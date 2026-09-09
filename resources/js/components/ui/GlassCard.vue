<template>
    <div
        class="glass-card relative overflow-hidden rounded-2xl"
        :class="[variantClass, borderClass]"
        :style="cardStyle"
    >
        <!-- Optional gradient mesh background -->
        <div
            v-if="meshGradient"
            class="absolute inset-0 pointer-events-none"
            :style="meshStyle"
        ></div>

        <!-- Content -->
        <div class="relative z-10" :style="contentStyle">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
    variant: {
        type: String,
        default: 'default',
        validator: (value) => ['default', 'heavy', 'light'].includes(value),
    },
    blur: {
        type: Number,
        default: 16,
    },
    opacity: {
        type: Number,
        default: 0.72,
    },
    border: {
        type: Boolean,
        default: true,
    },
    meshGradient: {
        type: Boolean,
        default: false,
    },
    meshColor1: {
        type: String,
        default: 'rgba(23, 199, 188, 0.1)',
    },
    meshColor2: {
        type: String,
        default: 'rgba(139, 92, 246, 0.08)',
    },
    padding: {
        type: String,
        default: '1.5rem',
    },
})

const variantClass = computed(() => {
    switch (props.variant) {
        case 'heavy':
            return 'glass-heavy'
        case 'light':
            return 'glass-light'
        default:
            return 'glass'
    }
})

const borderClass = computed(() => props.border ? 'glass-border' : '')

const cardStyle = computed(() => {
    const blurValue = props.variant === 'heavy' ? props.blur * 1.5 : props.blur
    return {
        backdropFilter: `blur(${blurValue}px)`,
        WebkitBackdropFilter: `blur(${blurValue}px)`,
    }
})

const meshStyle = computed(() => ({
    background: `
        radial-gradient(at 0% 0%, ${props.meshColor1} 0%, transparent 50%),
        radial-gradient(at 100% 100%, ${props.meshColor2} 0%, transparent 50%)
    `,
}))

const contentStyle = computed(() => ({
    padding: props.padding,
}))
</script>

<style scoped>
.glass-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.glass-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.2);
}

.glass-light {
    background: rgba(255, 255, 255, 0.05);
}

html[data-theme="light"] .glass-light {
    background: rgba(255, 255, 255, 0.6);
}
</style>
