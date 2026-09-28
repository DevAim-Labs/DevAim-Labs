<template>
    <span ref="textRef" class="text-scramble" :class="{ 'opacity-0': !revealed }">
        {{ displayText }}
    </span>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'

const props = defineProps({
    text: {
        type: String,
        required: true,
    },
    trigger: {
        type: Boolean,
        default: false,
    },
    triggerOnMount: {
        type: Boolean,
        default: true,
    },
    duration: {
        type: Number,
        default: 1500,
    },
    scrambleSpeed: {
        type: Number,
        default: 30,
    },
    chars: {
        type: String,
        default: '!<>-_\\/[]{}—=+*^?#________',
    },
    delay: {
        type: Number,
        default: 0,
    },
})

const emit = defineEmits(['complete'])

const textRef = ref(null)
const displayText = ref('')
const revealed = ref(false)

const scramble = () => {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        displayText.value = props.text
        revealed.value = true
        emit('complete')
        return
    }

    revealed.value = true
    const finalText = props.text
    const length = finalText.length
    const frameTime = 1000 / props.scrambleSpeed
    const totalFrames = Math.ceil(props.duration / frameTime)

    let frame = 0
    const revealedChars = new Array(length).fill(false)

    const interval = setInterval(() => {
        let newText = ''

        for (let i = 0; i < length; i++) {
            const char = finalText[i]

            if (char === ' ') {
                newText += ' '
                revealedChars[i] = true
                continue
            }

            if (revealedChars[i]) {
                newText += char
                continue
            }

            // Calculate reveal probability based on position and progress
            const progress = frame / totalFrames
            const positionFactor = i / length
            const revealThreshold = progress - (positionFactor * 0.3)

            if (revealThreshold > 0.5 + Math.random() * 0.3) {
                revealedChars[i] = true
                newText += char
            } else {
                newText += props.chars[Math.floor(Math.random() * props.chars.length)]
            }
        }

        displayText.value = newText
        frame++

        if (revealedChars.every(Boolean) || frame >= totalFrames) {
            clearInterval(interval)
            displayText.value = finalText
            emit('complete')
        }
    }, frameTime)
}

watch(() => props.trigger, (newVal) => {
    if (newVal) {
        setTimeout(scramble, props.delay)
    }
})

onMounted(() => {
    if (props.triggerOnMount) {
        setTimeout(scramble, props.delay)
    } else {
        displayText.value = ''
    }
})
</script>

<style scoped>
.text-scramble {
    display: inline-block;
    font-family: inherit;
    transition: opacity 0.2s ease;
}
</style>
