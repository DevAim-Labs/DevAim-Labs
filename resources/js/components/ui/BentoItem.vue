<template>
    <div
        class="bento-item"
        :class="[spanClass, rowSpanClass]"
        :style="itemStyle"
    >
        <SpotlightCard
            v-if="spotlight"
            :color="spotlightColor"
            :tilt="tilt"
            :padding="padding"
            :bg="bg"
            class="h-full"
        >
            <slot></slot>
        </SpotlightCard>
        <div
            v-else
            class="h-full rounded-2xl border border-[var(--color-border-dim)]"
            :style="{ background: bg, padding }"
        >
            <slot></slot>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue'
import SpotlightCard from './SpotlightCard.vue'

const props = defineProps({
    span: {
        type: Number,
        default: 1,
        validator: (value) => [1, 2].includes(value),
    },
    rowSpan: {
        type: Number,
        default: 1,
        validator: (value) => [1, 2].includes(value),
    },
    spotlight: {
        type: Boolean,
        default: true,
    },
    spotlightColor: {
        type: String,
        default: 'accent',
    },
    tilt: {
        type: Boolean,
        default: true,
    },
    minHeight: {
        type: String,
        default: '220px',
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

const spanClass = computed(() => props.span === 2 ? 'bento-span-2' : '')
const rowSpanClass = computed(() => props.rowSpan === 2 ? 'bento-span-row-2' : '')

const itemStyle = computed(() => ({
    minHeight: props.minHeight,
}))
</script>

<style scoped>
.bento-item {
    will-change: transform, opacity;
}

.bento-span-2 {
    grid-column: span 2;
}

.bento-span-row-2 {
    grid-row: span 2;
}

@media (max-width: 639px) {
    .bento-span-2,
    .bento-span-row-2 {
        grid-column: span 1;
        grid-row: span 1;
    }
}
</style>
