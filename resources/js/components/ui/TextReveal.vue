<template>
    <component :is="tag" ref="textRef" :class="$attrs.class">
        <span
            v-for="(segment, i) in segments"
            :key="i"
            class="inline-block overflow-hidden"
            :style="{ perspective: '400px' }"
        >
            <span class="inline-block" :data-text-segment="i">
                {{ segment }}{{ splitBy === 'word' && i < segments.length - 1 ? '\u00A0' : '' }}
            </span>
        </span>
    </component>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue'
import { gsap } from 'gsap'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

const props = defineProps({
    /** The text content to animate */
    text: { type: String, required: true },
    /** HTML tag to render (default: span) */
    tag: { type: String, default: 'span' },
    /** Split text by 'word' or 'char' */
    splitBy: { type: String, default: 'word' },
    /** Animation type: 'fadeUp', 'slideUp', 'rotateIn' */
    animation: { type: String, default: 'fadeUp' },
    /** Stagger delay between segments (seconds) */
    stagger: { type: Number, default: 0.05 },
    /** Animation duration (seconds) */
    duration: { type: Number, default: 0.6 },
    /** Initial delay before animation starts (seconds) */
    delay: { type: Number, default: 0 },
    /** Use scroll trigger (true) or animate immediately (false) */
    trigger: { type: Boolean, default: true },
    /** ScrollTrigger start position */
    start: { type: String, default: 'top 85%' },
})

const textRef = ref(null)

const segments = computed(() => {
    return props.splitBy === 'char'
        ? props.text.split('')
        : props.text.split(' ')
})

const ANIMATIONS = {
    fadeUp: { from: { y: '100%', opacity: 0 }, to: { y: '0%', opacity: 1 } },
    slideUp: { from: { y: '110%' }, to: { y: '0%' } },
    rotateIn: { from: { rotationX: -90, opacity: 0 }, to: { rotationX: 0, opacity: 1 } },
}

onMounted(() => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    const anim = ANIMATIONS[props.animation] || ANIMATIONS.fadeUp
    const targets = textRef.value?.querySelectorAll('[data-text-segment]')

    if (!targets?.length) return

    gsap.set(targets, anim.from)

    const config = {
        ...anim.to,
        duration: props.duration,
        stagger: props.stagger,
        ease: 'power3.out',
        delay: props.delay,
    }

    if (props.trigger) {
        config.scrollTrigger = {
            trigger: textRef.value,
            start: props.start,
            toggleActions: 'play none none none',
        }
    }

    gsap.to(targets, config)
})
</script>
