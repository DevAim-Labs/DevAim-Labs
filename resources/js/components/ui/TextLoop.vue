<script setup>
import { ref, onMounted, onUnmounted, computed } from 'vue'

const props = defineProps({
    words: {
        type: Array,
        required: true
    },
    interval: {
        type: Number,
        default: 3000
    },
    gradient: {
        type: Boolean,
        default: true
    }
})

const currentIndex = ref(0)
const isLeaving = ref(false)
let intervalId = null

const currentWord = computed(() => props.words[currentIndex.value] || '')

function nextWord() {
    isLeaving.value = true

    setTimeout(() => {
        currentIndex.value = (currentIndex.value + 1) % props.words.length
        isLeaving.value = false
    }, 300)
}

onMounted(() => {
    // Respect reduced motion
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return
    }

    intervalId = setInterval(nextWord, props.interval)
})

onUnmounted(() => {
    if (intervalId) clearInterval(intervalId)
})
</script>

<template>
    <span class="text-loop-wrapper">
        <span
            class="text-loop-word"
            :class="[
                { 'text-gradient-premium': gradient },
                { 'is-leaving': isLeaving }
            ]"
        >
            {{ currentWord }}
        </span>
    </span>
</template>

<style scoped>
.text-loop-wrapper {
    display: inline-block;
    position: relative;
    overflow: hidden;
    vertical-align: bottom;
}

.text-loop-word {
    display: inline-block;
    white-space: nowrap;
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.text-loop-word.is-leaving {
    opacity: 0;
    transform: translateY(-100%);
}

/* Gradient text */
.text-gradient-premium {
    background: linear-gradient(135deg, var(--color-accent-bright) 0%, var(--color-violet) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .text-loop-word {
        transition: none;
    }

    .text-loop-word.is-leaving {
        opacity: 1;
        transform: none;
    }
}
</style>
