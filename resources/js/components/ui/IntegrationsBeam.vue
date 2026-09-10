<template>
    <svg
        class="beam-svg"
        viewBox="0 0 520 240"
        preserveAspectRatio="xMidYMid meet"
        aria-hidden="true"
    >
        <!-- Static connector wires -->
        <path
            v-for="node in nodes"
            :key="'wire-' + node.id"
            :d="node.path"
            fill="none"
            stroke="rgba(255,255,255,0.18)"
            stroke-width="1.5"
        />

        <!-- Traveling pulses -->
        <template v-if="!reducedMotion">
            <circle v-for="(node, i) in nodes" :key="'pulse-' + node.id" r="4" fill="var(--color-accent)">
                <animateMotion
                    :path="node.path"
                    :dur="`${2.6 + i * 0.35}s`"
                    :begin="`${i * 0.5}s`"
                    repeatCount="indefinite"
                />
            </circle>
        </template>

        <!-- Outer nodes -->
        <g v-for="node in nodes" :key="'node-' + node.id">
            <circle :cx="node.x" :cy="node.y" r="19" fill="rgba(255,255,255,0.06)" stroke="rgba(255,255,255,0.25)" stroke-width="1.5" />
            <path :d="ICONS[node.icon]" fill="rgba(255,255,255,0.85)" :transform="iconTransform(node.x, node.y, 20)" />
        </g>

        <!-- Hub node -->
        <g>
            <circle :cx="hub.x" :cy="hub.y" r="24" fill="var(--color-accent)" />
            <path :d="ICONS.hub" fill="var(--color-on-accent)" :transform="iconTransform(hub.x, hub.y, 24)" />
        </g>
    </svg>
</template>

<script setup>
import { ref, onMounted } from 'vue'

const reducedMotion = ref(false)

onMounted(() => {
    reducedMotion.value = window.matchMedia('(prefers-reduced-motion: reduce)').matches
})

// Hub ("your system") sits at the top; beams fan downward to each
// connected service, matching how an API call actually flows. Spread wide
// and kept well clear of the bottom edge, since the row's title/CTA sit
// on top of this area.
const hub = { x: 260, y: 40 }

const nodes = [
    { id: 'webhook', icon: 'webhook', x: 60, y: 172, path: 'M260,40 C260,112 60,100 60,172' },
    { id: 'storefront', icon: 'storefront', x: 187, y: 172, path: 'M260,40 C260,112 187,100 187,172' },
    { id: 'database', icon: 'database', x: 314, y: 172, path: 'M260,40 C260,112 314,100 314,172' },
    { id: 'receipt', icon: 'receipt_long', x: 440, y: 172, path: 'M260,40 C260,112 440,100 440,172' },
]

// Icons are drawn as plain SVG paths (not foreignObject + HTML), since
// nested HTML inside foreignObject sizes unreliably across browsers
// (WebKit in particular). Each icon's own viewBox is 960x960 with its
// origin at (0,-960); this maps that box's center (480,-480) onto the
// node's position at the given pixel size, so every icon is geometrically
// centered on its node regardless of how its glyph fills its box.
function iconTransform(cx, cy, size) {
    const s = size / 960
    return `translate(${cx},${cy}) scale(${s}) translate(-480,480)`
}

// Material Symbols (Outlined, 24px) path data
const ICONS = {
    hub: 'M240-40q-50 0-85-35t-35-85q0-50 35-85t85-35q14 0 26 3t23 8l57-71q-28-31-39-70t-5-78l-81-27q-17 25-43 40t-58 15q-50 0-85-35T0-580q0-50 35-85t85-35q50 0 85 35t35 85v8l81 28q20-36 53.5-61t75.5-32v-87q-39-11-64.5-42.5T360-840q0-50 35-85t85-35q50 0 85 35t35 85q0 42-26 73.5T510-724v87q42 7 75.5 32t53.5 61l81-28v-8q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35q-32 0-58.5-15T739-515l-81 27q6 39-5 77.5T614-340l57 70q11-5 23-7.5t26-2.5q50 0 85 35t35 85q0 50-35 85t-85 35q-50 0-85-35t-35-85q0-20 6.5-38.5T624-232l-57-71q-41 23-87.5 23T392-303l-56 71q11 15 17.5 33.5T360-160q0 50-35 85t-85 35ZM120-540q17 0 28.5-11.5T160-580q0-17-11.5-28.5T120-620q-17 0-28.5 11.5T80-580q0 17 11.5 28.5T120-540Zm120 420q17 0 28.5-11.5T280-160q0-17-11.5-28.5T240-200q-17 0-28.5 11.5T200-160q0 17 11.5 28.5T240-120Zm240-680q17 0 28.5-11.5T520-840q0-17-11.5-28.5T480-880q-17 0-28.5 11.5T440-840q0 17 11.5 28.5T480-800Zm0 440q42 0 71-29t29-71q0-42-29-71t-71-29q-42 0-71 29t-29 71q0 42 29 71t71 29Zm240 240q17 0 28.5-11.5T760-160q0-17-11.5-28.5T720-200q-17 0-28.5 11.5T680-160q0 17 11.5 28.5T720-120Zm120-420q17 0 28.5-11.5T880-580q0-17-11.5-28.5T840-620q-17 0-28.5 11.5T800-580q0 17 11.5 28.5T840-540ZM480-840ZM120-580Zm360 120Zm360-120ZM240-160Zm480 0Z',
    webhook: 'M280-120q-83 0-141.5-58.5T80-320q0-73 45.5-127.5T240-516v83q-35 12-57.5 43T160-320q0 50 35 85t85 35q50 0 85-35t35-85v-40h235q8-9 19.5-14.5T680-380q25 0 42.5 17.5T740-320q0 25-17.5 42.5T680-260q-14 0-25.5-5.5T635-280H476q-14 69-68.5 114.5T280-120Zm400 0q-56 0-101.5-27.5T507-220h107q14 10 31 15t35 5q50 0 85-35t35-85q0-50-35-85t-85-35q-20 0-37 5.5T611-418L489-621q-21-4-35-20t-14-39q0-25 17.5-42.5T500-740q25 0 42.5 17.5T560-680v8.5q0 3.5-2 8.5l87 146q8-2 17-2.5t18-.5q83 0 141.5 58.5T880-320q0 83-58.5 141.5T680-120ZM280-260q-25 0-42.5-17.5T220-320q0-22 14-38t34-21l94-156q-29-27-45.5-64.5T300-680q0-83 58.5-141.5T500-880q83 0 141.5 58.5T700-680h-80q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 43 26 75.5t66 41.5L337-338q2 5 2.5 9t.5 9q0 25-17.5 42.5T280-260Z',
    storefront: 'M841-518v318q0 33-23.5 56.5T761-120H201q-33 0-56.5-23.5T121-200v-318q-23-21-35.5-54t-.5-72l42-136q8-26 28.5-43t47.5-17h556q27 0 47 16.5t29 43.5l42 136q12 39-.5 71T841-518Zm-272-42q27 0 41-18.5t11-41.5l-22-140h-78v148q0 21 14 36.5t34 15.5Zm-180 0q23 0 37.5-15.5T441-612v-148h-78l-22 140q-4 24 10.5 42t37.5 18Zm-178 0q18 0 31.5-13t16.5-33l22-154h-78l-40 134q-6 20 6.5 43t41.5 23Zm540 0q29 0 42-23t6-43l-42-134h-76l22 154q3 20 16.5 33t31.5 13ZM201-200h560v-282q-5 2-6.5 2H751q-27 0-47.5-9T663-518q-18 18-41 28t-49 10q-27 0-50.5-10T481-518q-17 18-39.5 28T393-480q-29 0-52.5-10T299-518q-21 21-41.5 29.5T211-480h-4.5q-2.5 0-5.5-2v282Zm560 0H201h560Z',
    database: 'M480-120q-151 0-255.5-46.5T120-280v-400q0-66 105.5-113T480-840q149 0 254.5 47T840-680v400q0 67-104.5 113.5T480-120Zm0-479q89 0 179-25.5T760-679q-11-29-100.5-55T480-760q-91 0-178.5 25.5T200-679q14 30 101.5 55T480-599Zm0 199q42 0 81-4t74.5-11.5q35.5-7.5 67-18.5t57.5-25v-120q-26 14-57.5 25t-67 18.5Q600-528 561-524t-81 4q-42 0-82-4t-75.5-11.5Q287-543 256-554t-56-25v120q25 14 56 25t66.5 18.5Q358-408 398-404t82 4Zm0 200q46 0 93.5-7t87.5-18.5q40-11.5 67-26t32-29.5v-98q-26 14-57.5 25t-67 18.5Q600-328 561-324t-81 4q-42 0-82-4t-75.5-11.5Q287-343 256-354t-56-25v99q5 15 31.5 29t66.5 25.5q40 11.5 88 18.5t94 7Z',
    receipt_long: 'M240-80q-50 0-85-35t-35-85v-120h120v-560l60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60 60 60 60-60v680q0 50-35 85t-85 35H240Zm480-80q17 0 28.5-11.5T760-200v-560H320v440h360v120q0 17 11.5 28.5T720-160ZM360-600v-80h240v80H360Zm0 120v-80h240v80H360Zm320-120q-17 0-28.5-11.5T640-640q0-17 11.5-28.5T680-680q17 0 28.5 11.5T720-640q0 17-11.5 28.5T680-600Zm0 120q-17 0-28.5-11.5T640-520q0-17 11.5-28.5T680-560q17 0 28.5 11.5T720-520q0 17-11.5 28.5T680-480ZM240-160h360v-80H200v40q0 17 11.5 28.5T240-160Zm-40 0v-80 80Z',
}
</script>

<style scoped>
/* Sized by natural (2:1) ratio, not stretched to the container — the
   container is usually much wider than tall, and covering it would blow
   the illustration up far past its designed scale. Centered horizontally
   at the top of the row. */
.beam-svg {
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    height: 100%;
    width: auto;
    max-width: 52rem;
    display: block;
}
</style>
