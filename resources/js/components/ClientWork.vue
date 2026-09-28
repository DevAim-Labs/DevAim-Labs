<template>
    <section id="client-work">
        <div class="section-card">
            <div class="max-w-6xl mx-auto px-6 py-16 md:py-20 overflow-hidden">
                <p class="section-eyebrow text-center mb-3">{{ t.eyebrow }}</p>
                <p class="text-center text-sm mb-12" style="color: var(--color-text-muted);">
                    {{ t.subtitle }}
                </p>

                <!-- Horizontal Loop Carousel -->
                <div class="marquee-container" @mouseenter="isPaused = true" @mouseleave="isPaused = false">
                    <div class="marquee-track" :class="{ 'paused': isPaused }">
                        <!-- First set -->
                        <a
                            v-for="client in clients"
                            :key="'a-' + client.id"
                            :href="client.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="logo-link"
                        >
                            <img
                                :src="client.logo"
                                :alt="client.name"
                                class="logo-img"
                                loading="lazy"
                            />
                        </a>
                        <!-- Duplicate set for seamless loop -->
                        <a
                            v-for="client in clients"
                            :key="'b-' + client.id"
                            :href="client.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="logo-link"
                        >
                            <img
                                :src="client.logo"
                                :alt="client.name"
                                class="logo-img"
                                loading="lazy"
                            />
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import lokantaLogo from '../../assets/lokanta.webp'
import slowdownLogo from '../../assets/slowdown.webp'

const locale = window.__LOCALE__ || 'nl'
const isEn = locale === 'en'

const t = computed(() => isEn ? {
    eyebrow: 'Trusted by',
    subtitle: 'A look at past projects.'
} : {
    eyebrow: 'Vertrouwd door',
    subtitle: 'Een blik in voorgaande projecten.'
})

const isPaused = ref(false)

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
</script>

<style scoped>
.marquee-container {
    overflow: hidden;
    /* Fade edges */
    mask-image: linear-gradient(
        90deg,
        transparent 0%,
        black 10%,
        black 90%,
        transparent 100%
    );
    -webkit-mask-image: linear-gradient(
        90deg,
        transparent 0%,
        black 10%,
        black 90%,
        transparent 100%
    );
}

.marquee-track {
    display: flex;
    align-items: center;
    width: max-content;
    gap: 6rem;
    animation: scroll 20s linear infinite;
}

.marquee-track.paused {
    animation-play-state: paused;
}

@keyframes scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.logo-link {
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    padding: 0.5rem 1rem;
}

.logo-img {
    height: 3rem;
    width: auto;
    max-width: 180px;
    object-fit: contain;
    opacity: 0.5;
    transition: opacity 0.3s ease, transform 0.3s ease;
    background: transparent;
}

.logo-link:hover .logo-img {
    opacity: 1;
    transform: scale(1.05);
}

/* Light mode - invert logos for visibility */
:global(html[data-theme="light"]) .logo-img {
    filter: brightness(0.3);
    opacity: 0.6;
}

:global(html[data-theme="light"]) .logo-link:hover .logo-img {
    filter: brightness(0);
    opacity: 1;
}

@media (min-width: 768px) {
    .marquee-track {
        gap: 8rem;
    }

    .logo-img {
        height: 3.5rem;
        max-width: 200px;
    }
}

@media (min-width: 1024px) {
    .marquee-track {
        gap: 10rem;
    }

    .logo-img {
        height: 4rem;
        max-width: 220px;
    }
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .marquee-track {
        animation: none;
    }
}
</style>
