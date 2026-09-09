<template>
    <div
        ref="gridRef"
        class="bento-grid"
        :style="gridStyle"
    >
        <slot></slot>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const props = defineProps({
    columns: {
        type: Number,
        default: 3,
    },
    gap: {
        type: String,
        default: '1rem',
    },
    staggerReveal: {
        type: Boolean,
        default: true,
    },
    staggerDelay: {
        type: Number,
        default: 0.1,
    },
})

const gridRef = ref(null)

const gridStyle = computed(() => ({
    gap: props.gap,
}))

onMounted(() => {
    if (!props.staggerReveal) return
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    const items = gridRef.value?.querySelectorAll('.bento-item')
    if (!items?.length) return

    gsap.set(items, { opacity: 0, y: 40 })

    gsap.to(items, {
        opacity: 1,
        y: 0,
        duration: 0.6,
        stagger: props.staggerDelay,
        ease: 'power2.out',
        scrollTrigger: {
            trigger: gridRef.value,
            start: 'top 80%',
        },
    })
})
</script>

<style scoped>
.bento-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
}

@media (max-width: 1023px) {
    .bento-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 639px) {
    .bento-grid {
        grid-template-columns: 1fr;
    }
}
</style>
