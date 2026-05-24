<template>
    <section id="client-work">
        <div class="section-card">
        <div class="max-w-6xl mx-auto px-6 py-20">
            <p class="section-eyebrow text-center mb-3">Eerdere klanten</p>

            <div class="relative flex items-center gap-4">
                <button
                    v-if="showArrows"
                    @click="prev"
                    class="shrink-0 w-8 h-8 flex items-center justify-center rounded border text-lg transition-opacity duration-200"
                    style="border-color: var(--color-border); color: var(--color-text-dim)"
                    :style="{ opacity: currentIndex === 0 ? '0.25' : '1', cursor: currentIndex === 0 ? 'default' : 'pointer' }"
                >‹</button>
                <div v-else class="w-8 shrink-0"></div>

                <div ref="track" class="flex-1 overflow-hidden">
                    <div
                        ref="inner"
                        class="flex transition-transform duration-500 ease-in-out"
                        :style="{ transform: `translateX(-${currentIndex * slidePercent}%)` }"
                    >
                        <a
                            v-for="client in clients"
                            :key="client.id"
                            :href="client.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="shrink-0 flex items-center justify-center py-10 px-6 transition-opacity duration-300"
                            :style="{ width: itemWidth, opacity: '0.45' }"
                            @mouseover="$event.currentTarget.style.opacity = '1'; $event.currentTarget.querySelector('img') && ($event.currentTarget.querySelector('img').style.filter = 'none')"
                            @mouseleave="$event.currentTarget.style.opacity = '0.45'; $event.currentTarget.querySelector('img') && ($event.currentTarget.querySelector('img').style.filter = '')"
                        >
                            <img
                                v-if="client.logo"
                                :src="client.logo"
                                :alt="client.name"
                                :width="client.logoWidth"
                                :height="client.logoHeight"
                                loading="lazy"
                                decoding="async"
                                class="client-logo-img max-h-20 max-w-full object-contain"
                            >
                            <span v-else class="font-semibold text-xl tracking-tight" style="color: var(--color-text)">
                                {{ client.name }}
                            </span>
                        </a>
                    </div>
                </div>

                <button
                    v-if="showArrows"
                    @click="next"
                    class="shrink-0 w-8 h-8 flex items-center justify-center rounded border text-lg transition-opacity duration-200"
                    style="border-color: var(--color-border); color: var(--color-text-dim)"
                    :style="{ opacity: currentIndex >= clients.length - visibleCount ? '0.25' : '1', cursor: currentIndex >= clients.length - visibleCount ? 'default' : 'pointer' }"
                >›</button>
                <div v-else class="w-8 shrink-0"></div>
            </div>
        </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import lokantaLogo from '../../assets/lokanta.webp'
import slowdownLogo from '../../assets/slowdown.webp'

const visibleCount = 4

const clients = [
    {
        id: 1,
        name: 'Lokanta Proeflokaal',
        logo: lokantaLogo,
        logoWidth: 200,
        logoHeight: 71,
        href: 'https://lokanta-proeflokaal.nl',
    },
    {
        id: 2,
        name: 'Slowdown Store',
        logo: slowdownLogo,
        logoWidth: 125,
        logoHeight: 65,
        href: 'https://slowdownstore.com',
    },
]

const currentIndex = ref(0)

const cols = computed(() => Math.min(clients.length, visibleCount))
const itemWidth = computed(() => `${100 / cols.value}%`)
const slidePercent = computed(() => 100 / cols.value)
const showArrows = computed(() => clients.length > visibleCount)

function prev() {
    if (currentIndex.value > 0) currentIndex.value -= 1
}

function next() {
    if (currentIndex.value < clients.length - visibleCount) currentIndex.value += 1
}
</script>
