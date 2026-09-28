<script setup>
import { computed } from 'vue'

// Small hand-authored icon set (24x24, stroke-based, Lucide-style) so the
// landing page needs no extra icon dependency. Always aria-hidden: the
// accessible label lives in the surrounding text/button, never on the icon
// itself (see .btn-hover comment in app.css for the same convention).
const PATHS = {
    arrowRight: 'M5 12h14M13 5l7 7-7 7',
    arrowUpRight: 'M7 17 17 7M8 7h9v9',
    menu: 'M4 7h16M4 12h16M4 17h16',
    close: 'M6 6l12 12M18 6 6 18',
    check: 'M5 13l4 4L19 7',
    mail: 'M4 6h16v12H4z M4 7l8 6 8-6',
    phone: 'M6.6 10.8c1.4 2.8 3.8 5.2 6.6 6.6l2.2-2.2c.3-.3.7-.4 1-.2 1.1.4 2.3.6 3.6.6.6 0 1 .4 1 1V20c0 .6-.4 1-1 1C10.6 21 3 13.4 3 4c0-.6.4-1 1-1h3.2c.6 0 1 .4 1 1 0 1.3.2 2.5.6 3.6.1.4 0 .8-.2 1.1l-2 2.1z',
    pause: 'M7 5h3v14H7zM14 5h3v14h-3z',
    play: 'M7 5l12 7-12 7V5z',
    layers: 'M12 3 2 8l10 5 10-5-10-5zM2 16l10 5 10-5M2 12l10 5 10-5',
    shield: 'M12 3l8 3v6c0 4.5-3.4 7.9-8 9-4.6-1.1-8-4.5-8-9V6l8-3z',
    repeat: 'M4 7h13l-3-3M20 17H7l3 3M4 12v-2a3 3 0 0 1 3-3h13M20 12v2a3 3 0 0 1-3 3H4',
    handshake: 'M2 12l4-4 4 3 4-3 4 4M6 8l3 8M14 8l3 8M8 20h8',
}

const props = defineProps({
    name: { type: String, required: true },
    size: { type: [Number, String], default: 20 },
})

const d = computed(() => PATHS[props.name] || PATHS.check)
</script>

<template>
    <svg
        :width="size"
        :height="size"
        viewBox="0 0 24 24"
        fill="none"
        :stroke="'currentColor'"
        stroke-width="1.75"
        stroke-linecap="round"
        stroke-linejoin="round"
        aria-hidden="true"
        focusable="false"
    >
        <path :d="d" />
    </svg>
</template>
