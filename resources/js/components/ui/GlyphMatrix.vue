<template>
    <canvas ref="canvasEl" class="glyph-matrix" aria-hidden="true"></canvas>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    // Characters to randomly pick from
    glyphs: { type: String, default: '01·•+*/\\<>=' },
    // Cell size in px (also font size)
    cellSize: { type: Number, default: 14 },
    // Probability (0-1) a cell mutates each tick
    mutationRate: { type: Number, default: 0.04 },
    // Tick interval in ms
    interval: { type: Number, default: 90 },
    // Fade out toward bottom (0 = no fade)
    fadeBottom: { type: Number, default: 0.6 },
    // Any CSS color, or a CSS custom property name (e.g. '--color-accent').
    // Resolved once on mount against the page's computed style.
    color: { type: String, default: '--color-text-dim' },
})

const canvasEl = ref(null)

let ctx = null
let cols = 0
let rows = 0
let cells = []
let alphas = []
let rgba = { r: 107, g: 114, b: 128, a: 1 }
let raf = 0
let last = 0
let stopped = false
let resizeObserver = null

function resolveColor(value) {
    const cssValue = value.trim().startsWith('--')
        ? getComputedStyle(document.documentElement).getPropertyValue(value).trim()
        : value

    const probe = document.createElement('canvas')
    probe.width = 1
    probe.height = 1
    const probeCtx = probe.getContext('2d')
    if (!probeCtx) return { r: 107, g: 114, b: 128, a: 1 }

    // Seed with a sane default so an unresolvable color falls back to it
    // instead of silently turning black.
    probeCtx.fillStyle = '#6B7280'
    probeCtx.fillStyle = cssValue || '#6B7280'
    probeCtx.fillRect(0, 0, 1, 1)
    const [r, g, b, a] = probeCtx.getImageData(0, 0, 1, 1).data
    return { r, g, b, a: a / 255 }
}

function resize() {
    const canvas = canvasEl.value
    if (!canvas || !ctx) return

    const dpr = window.devicePixelRatio || 1
    const { clientWidth: w, clientHeight: h } = canvas
    canvas.width = w * dpr
    canvas.height = h * dpr
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0)

    cols = Math.ceil(w / props.cellSize)
    rows = Math.ceil(h / props.cellSize)

    cells = new Array(cols * rows).fill(0).map(() => props.glyphs[Math.floor(Math.random() * props.glyphs.length)])
    alphas = new Array(cols * rows).fill(0).map(() => 0.05 + Math.random() * 0.35)
}

function draw() {
    const canvas = canvasEl.value
    if (!canvas || !ctx) return

    const { clientWidth: w, clientHeight: h } = canvas
    ctx.clearRect(0, 0, w, h)
    ctx.font = `${props.cellSize - 2}px ui-monospace, SFMono-Regular, Menlo, monospace`
    ctx.textBaseline = 'top'

    for (let y = 0; y < rows; y++) {
        const fade = props.fadeBottom > 0 ? 1 - (y / rows) * props.fadeBottom : 1
        for (let x = 0; x < cols; x++) {
            const i = y * cols + x
            const a = alphas[i] * fade * rgba.a
            ctx.fillStyle = `rgba(${rgba.r}, ${rgba.g}, ${rgba.b}, ${a})`
            ctx.fillText(cells[i], x * props.cellSize, y * props.cellSize)
        }
    }
}

function tick(t) {
    if (stopped) return

    if (t - last >= props.interval) {
        last = t
        const total = cols * rows
        const mutations = Math.max(1, Math.floor(total * props.mutationRate))

        for (let n = 0; n < mutations; n++) {
            const i = Math.floor(Math.random() * total)
            cells[i] = props.glyphs[Math.floor(Math.random() * props.glyphs.length)]
            alphas[i] = 0.05 + Math.random() * 0.45
        }

        draw()
    }

    raf = requestAnimationFrame(tick)
}

onMounted(() => {
    const canvas = canvasEl.value
    if (!canvas) return

    ctx = canvas.getContext('2d')
    if (!ctx) return

    rgba = resolveColor(props.color)

    resize()
    draw()

    if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        raf = requestAnimationFrame(tick)
    }

    resizeObserver = new ResizeObserver(() => {
        resize()
        draw()
    })
    resizeObserver.observe(canvas)
})

onUnmounted(() => {
    stopped = true
    cancelAnimationFrame(raf)
    resizeObserver?.disconnect()
})
</script>

<style scoped>
.glyph-matrix {
    width: 100%;
    height: 100%;
    display: block;
    pointer-events: none;
}
</style>
