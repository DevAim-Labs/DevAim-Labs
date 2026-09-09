<template>
    <section class="reveal-hidden py-16 overflow-hidden">
        <div class="max-w-6xl mx-auto px-6">
            <p v-if="title" class="section-eyebrow mb-8 text-center">{{ title }}</p>

            <Carousel
                :items-to-show="visibleItems"
                :wrap-around="true"
                :autoplay="3000"
                :pause-autoplay-on-hover="true"
                :transition="500"
                class="logo-carousel"
            >
                <Slide v-for="(logo, index) in logos" :key="index">
                    <div class="logo-slide">
                        <img
                            :src="logo.src"
                            :alt="logo.alt"
                            class="h-10 md:h-14 w-auto max-w-[120px] object-contain opacity-50 hover:opacity-100 transition-opacity duration-300"
                            :style="{ filter: grayscale ? 'grayscale(1)' : 'none' }"
                        />
                    </div>
                </Slide>
            </Carousel>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { Carousel, Slide } from 'vue3-carousel'
import 'vue3-carousel/dist/carousel.css'

// Import existing assets
import lokantaLogo from '../../assets/lokanta.webp'
import slowdownLogo from '../../assets/slowdown.webp'

const props = defineProps({
    title: {
        type: String,
        default: 'Onze klanten'
    },
    grayscale: {
        type: Boolean,
        default: true
    }
})

// Default logos using existing assets
const logos = [
    { src: lokantaLogo, alt: 'Lokanta' },
    { src: slowdownLogo, alt: 'Slowdown' },
    { src: lokantaLogo, alt: 'Lokanta' },
    { src: slowdownLogo, alt: 'Slowdown' },
    { src: lokantaLogo, alt: 'Lokanta' },
    { src: slowdownLogo, alt: 'Slowdown' },
]

// Responsive items count
const visibleItems = ref(5)

function updateVisibleItems() {
    if (window.innerWidth < 640) {
        visibleItems.value = 2
    } else if (window.innerWidth < 1024) {
        visibleItems.value = 3
    } else {
        visibleItems.value = 5
    }
}

onMounted(() => {
    updateVisibleItems()
    window.addEventListener('resize', updateVisibleItems)
})

onUnmounted(() => {
    window.removeEventListener('resize', updateVisibleItems)
})
</script>

<style scoped>
.logo-carousel {
    --vc-pgn-width: 0;
    --vc-pgn-height: 0;
    --vc-nav-width: 0;
}

.logo-carousel :deep(.carousel__viewport) {
    overflow: visible;
}

.logo-slide {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 1.5rem;
}
</style>
