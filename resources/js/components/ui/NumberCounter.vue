<template>
    <span ref="counterRef">
        {{ prefix }}{{ formattedValue }}{{ suffix }}
    </span>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const props = defineProps({
    /** Target number value */
    value: { type: Number, required: true },
    /** Animation duration in seconds */
    duration: { type: Number, default: 2 },
    /** Delay before animation starts (seconds) */
    delay: { type: Number, default: 0 },
    /** Number of decimal places */
    decimals: { type: Number, default: 0 },
    /** Prefix text (e.g., '$', '€') */
    prefix: { type: String, default: '' },
    /** Suffix text (e.g., '%', '+', 'k') */
    suffix: { type: String, default: '' },
    /** Thousands separator (default: '.') */
    separator: { type: String, default: '.' },
    /** Decimal separator (default: ',') */
    decimalSeparator: { type: String, default: ',' },
    /** Use scroll trigger (default: true) */
    trigger: { type: Boolean, default: true },
})

const counterRef = ref(null)
const currentValue = ref(0)

const formattedValue = computed(() => {
    const formatted = currentValue.value.toFixed(props.decimals)
    if (props.separator) {
        const parts = formatted.split('.')
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, props.separator)
        if (parts.length > 1) {
            return parts[0] + props.decimalSeparator + parts[1]
        }
        return parts[0]
    }
    return formatted
})

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        currentValue.value = props.value
        return
    }

    const animObj = { val: 0 }

    const config = {
        val: props.value,
        duration: props.duration,
        delay: props.delay,
        ease: 'power2.out',
        onUpdate: () => {
            currentValue.value = animObj.val
        },
    }

    if (props.trigger) {
        config.scrollTrigger = {
            trigger: counterRef.value,
            start: 'top 85%',
            toggleActions: 'play none none none',
        }
    }

    gsap.to(animObj, config)
})
</script>
