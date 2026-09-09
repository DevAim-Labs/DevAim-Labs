<template>
    <div v-if="!isTouch" class="custom-cursor-wrapper">
        <div
            ref="cursorOuter"
            class="cursor-outer"
            :class="{ active: isHovering, clicking: isClicking }"
        ></div>
        <div
            ref="cursorInner"
            class="cursor-inner"
            :class="{ active: isHovering }"
        ></div>
        <div
            ref="cursorLabel"
            class="cursor-label"
            :class="{ visible: !!labelText }"
        >
            {{ labelText }}
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { gsap } from 'gsap'

const cursorOuter = ref(null)
const cursorInner = ref(null)
const cursorLabel = ref(null)
const isHovering = ref(false)
const isClicking = ref(false)
const labelText = ref('')
const isTouch = ref(true)

let mouseX = 0
let mouseY = 0
let rafId = null

onMounted(() => {
    // Detect touch device
    isTouch.value = 'ontouchstart' in window || navigator.maxTouchPoints > 0

    if (isTouch.value) return
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return

    document.addEventListener('mousemove', onMouseMove)
    document.addEventListener('mousedown', onMouseDown)
    document.addEventListener('mouseup', onMouseUp)

    // Hide default cursor
    document.body.style.cursor = 'none'

    // Detect hoverable elements
    setupHoverListeners()

    // Watch for dynamically added elements
    const observer = new MutationObserver(() => {
        setupHoverListeners()
    })
    observer.observe(document.body, { childList: true, subtree: true })

    // Start animation loop
    gsap.ticker.add(updateCursor)
})

onUnmounted(() => {
    if (isTouch.value) return

    document.removeEventListener('mousemove', onMouseMove)
    document.removeEventListener('mousedown', onMouseDown)
    document.removeEventListener('mouseup', onMouseUp)
    gsap.ticker.remove(updateCursor)

    // Restore default cursor
    document.body.style.cursor = ''

    if (rafId) {
        cancelAnimationFrame(rafId)
    }
})

function setupHoverListeners() {
    const hoverables = document.querySelectorAll('a, button, [data-cursor], input, textarea, select, [role="button"]')

    hoverables.forEach((el) => {
        if (el.dataset.cursorBound) return
        el.dataset.cursorBound = 'true'

        el.addEventListener('mouseenter', () => {
            isHovering.value = true
            labelText.value = el.dataset.cursorLabel || ''
        })
        el.addEventListener('mouseleave', () => {
            isHovering.value = false
            labelText.value = ''
        })
    })
}

function onMouseMove(e) {
    mouseX = e.clientX
    mouseY = e.clientY
}

function onMouseDown() {
    isClicking.value = true
}

function onMouseUp() {
    isClicking.value = false
}

function updateCursor() {
    if (!cursorInner.value || !cursorOuter.value) return

    // Inner cursor follows exactly
    gsap.set(cursorInner.value, { x: mouseX, y: mouseY })

    // Outer cursor follows with slight delay
    gsap.to(cursorOuter.value, {
        x: mouseX,
        y: mouseY,
        duration: 0.15,
        ease: 'power2.out',
    })

    // Label follows with more delay
    if (labelText.value && cursorLabel.value) {
        gsap.to(cursorLabel.value, {
            x: mouseX + 20,
            y: mouseY + 20,
            duration: 0.2,
            ease: 'power2.out',
        })
    }
}
</script>

<style scoped>
.custom-cursor-wrapper {
    pointer-events: none;
    position: fixed;
    inset: 0;
    z-index: 9999;
}

.cursor-outer {
    position: fixed;
    width: 40px;
    height: 40px;
    border: 1px solid var(--color-accent);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.2s, height 0.2s, border-color 0.2s, opacity 0.2s;
    opacity: 0.5;
}

.cursor-outer.active {
    width: 60px;
    height: 60px;
    border-color: var(--color-accent-bright);
    opacity: 0.3;
}

.cursor-outer.clicking {
    width: 30px;
    height: 30px;
}

.cursor-inner {
    position: fixed;
    width: 8px;
    height: 8px;
    background: var(--color-accent);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: transform 0.1s;
}

.cursor-inner.active {
    transform: translate(-50%, -50%) scale(1.5);
}

.cursor-label {
    position: fixed;
    font-size: 12px;
    font-weight: 500;
    color: var(--color-accent);
    background: var(--color-surface);
    padding: 4px 10px;
    border-radius: 4px;
    opacity: 0;
    transition: opacity 0.2s;
    white-space: nowrap;
}

.cursor-label.visible {
    opacity: 1;
}

/* Light theme adjustments */
html[data-theme="light"] .cursor-outer,
html[data-theme="light"] .cursor-inner {
    mix-blend-mode: difference;
}

/* Hide on touch devices via media query */
@media (pointer: coarse) {
    .custom-cursor-wrapper {
        display: none;
    }
}
</style>
