<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue'

const props = defineProps({
    /** Gap between items in pixels */
    gap: {
        type: Number,
        default: 24
    },
    /** Duration of one complete loop in seconds */
    duration: {
        type: Number,
        default: 25
    },
    /** Duration when hovering (slower = more readable) */
    durationOnHover: {
        type: Number,
        default: 75
    },
    /** Reverse direction */
    reverse: {
        type: Boolean,
        default: false
    },
    /** Direction: 'horizontal' or 'vertical' */
    direction: {
        type: String,
        default: 'horizontal',
        validator: (v) => ['horizontal', 'vertical'].includes(v)
    },
    /** Pause on hover */
    pauseOnHover: {
        type: Boolean,
        default: false
    }
})

const containerRef = ref(null)
const trackRef = ref(null)
const isHovering = ref(false)

const animationDuration = computed(() =>
    isHovering.value && !props.pauseOnHover ? props.durationOnHover : props.duration
)

const animationPlayState = computed(() =>
    isHovering.value && props.pauseOnHover ? 'paused' : 'running'
)

const animationDirection = computed(() =>
    props.reverse ? 'reverse' : 'normal'
)

const isVertical = computed(() => props.direction === 'vertical')

function handleMouseEnter() {
    isHovering.value = true
}

function handleMouseLeave() {
    isHovering.value = false
}
</script>

<template>
    <div
        ref="containerRef"
        class="infinite-slider"
        :class="[
            isVertical ? 'infinite-slider--vertical' : 'infinite-slider--horizontal',
            { 'infinite-slider--hovering': isHovering }
        ]"
        @mouseenter="handleMouseEnter"
        @mouseleave="handleMouseLeave"
    >
        <div
            ref="trackRef"
            class="infinite-slider__track"
            :style="{
                gap: `${gap}px`,
                animationDuration: `${animationDuration}s`,
                animationPlayState: animationPlayState,
                animationDirection: animationDirection
            }"
        >
            <!-- Original items -->
            <div class="infinite-slider__content">
                <slot></slot>
            </div>
            <!-- Duplicated items for seamless loop -->
            <div class="infinite-slider__content" aria-hidden="true">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<style scoped>
.infinite-slider {
    overflow: hidden;
    position: relative;
}

/* Horizontal variant */
.infinite-slider--horizontal {
    mask-image: linear-gradient(90deg, transparent, black 10%, black 90%, transparent);
    -webkit-mask-image: linear-gradient(90deg, transparent, black 10%, black 90%, transparent);
}

.infinite-slider--horizontal .infinite-slider__track {
    display: flex;
    width: max-content;
    animation: infinite-scroll-x 25s linear infinite;
}

.infinite-slider--horizontal .infinite-slider__content {
    display: flex;
    gap: inherit;
    flex-shrink: 0;
}

/* Vertical variant */
.infinite-slider--vertical {
    mask-image: linear-gradient(180deg, transparent, black 10%, black 90%, transparent);
    -webkit-mask-image: linear-gradient(180deg, transparent, black 10%, black 90%, transparent);
}

.infinite-slider--vertical .infinite-slider__track {
    display: flex;
    flex-direction: column;
    animation: infinite-scroll-y 25s linear infinite;
}

.infinite-slider--vertical .infinite-slider__content {
    display: flex;
    flex-direction: column;
    gap: inherit;
    flex-shrink: 0;
}

/* Animations */
@keyframes infinite-scroll-x {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-50%);
    }
}

@keyframes infinite-scroll-y {
    from {
        transform: translateY(0);
    }
    to {
        transform: translateY(-50%);
    }
}

/* Smooth transitions for speed changes */
.infinite-slider__track {
    transition: animation-duration 0.3s ease;
}

/* Pause on hover indicator */
.infinite-slider--hovering .infinite-slider__track {
    transition: animation-duration 0.5s ease-out;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .infinite-slider__track {
        animation: none !important;
    }
}
</style>
