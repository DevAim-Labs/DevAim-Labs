<template>
    <section id="client-work" class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <p class="section-eyebrow text-center mb-12">Clients I've worked with</p>

            <div class="relative flex items-center gap-4">
                <!-- Prev arrow -->
                <button
                    v-if="showArrows"
                    @click="prev"
                    class="shrink-0 w-8 h-8 flex items-center justify-center rounded border text-lg transition-opacity duration-200"
                    style="border-color:#242424;color:#555555"
                    :style="{ opacity: currentIndex === 0 ? '0.25' : '1', cursor: currentIndex === 0 ? 'default' : 'pointer' }"
                >‹</button>
                <div v-else class="w-8 shrink-0"></div>

                <!-- Track -->
                <div ref="track" class="flex-1 overflow-hidden">
                    <div ref="inner" class="flex">
                        <a
                            v-for="client in clients"
                            :key="client.id"
                            :href="client.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="shrink-0 flex items-center justify-center py-10 px-6 transition-opacity duration-300"
                            :style="{ width: itemWidth, opacity: '0.45' }"
                            @mouseover="$event.currentTarget.style.opacity = '1'; $event.currentTarget.querySelector('img').style.filter = 'none'"
                            @mouseleave="$event.currentTarget.style.opacity = '0.45'; $event.currentTarget.querySelector('img').style.filter = 'brightness(0) invert(1)'"
                        >
                            <img
                                v-if="client.logo"
                                :src="client.logo"
                                :alt="client.name"
                                class="max-h-20 max-w-full object-contain"
                                style="filter: brightness(0) invert(1); transition: filter 0.3s ease;"
                            >
                            <span v-else class="font-semibold text-xl tracking-tight" style="color:#f0f0f0">
                                {{ client.name }}
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Next arrow -->
                <button
                    v-if="showArrows"
                    @click="next"
                    class="shrink-0 w-8 h-8 flex items-center justify-center rounded border text-lg transition-opacity duration-200"
                    style="border-color:#242424;color:#555555"
                    :style="{ opacity: currentIndex >= clients.length - visibleCount ? '0.25' : '1', cursor: currentIndex >= clients.length - visibleCount ? 'default' : 'pointer' }"
                >›</button>
                <div v-else class="w-8 shrink-0"></div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { gsap } from 'gsap'
import lokantaLogo from '../../assets/lokanta.png'
import slowdownLogo from '../../assets/slowdown.png'

const visibleCount = 4

const clients = [
    {
        id: 1,
        name: 'Lokanta Proeflokaal',
        logo: lokantaLogo,
        href: 'https://lokanta-proeflokaal.nl',
    },
    {
        id: 2,
        name: 'Slowdown Store',
        logo: slowdownLogo,
        href: 'https://slowdownstore.com',
    },
]

const track = ref(null)
const inner = ref(null)
const currentIndex = ref(0)

const cols = computed(() => Math.min(clients.length, visibleCount))
const itemWidth = computed(() => `${100 / cols.value}%`)
const showArrows = computed(() => clients.length > visibleCount)

function goTo(index) {
    if (!track.value) return
    const itemW = track.value.offsetWidth / cols.value
    gsap.to(inner.value, {
        x: -index * itemW,
        duration: 0.8,
        ease: 'power2.inOut',
    })
    currentIndex.value = index
}

function prev() {
    if (currentIndex.value > 0) goTo(currentIndex.value - 1)
}

function next() {
    if (currentIndex.value < clients.length - visibleCount) goTo(currentIndex.value + 1)
}
</script>
