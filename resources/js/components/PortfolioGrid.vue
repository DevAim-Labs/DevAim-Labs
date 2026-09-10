<template>
    <section id="portfolio" class="max-w-6xl mx-auto px-6 py-24">

        <!-- Client Work -->
        <div class="mb-16">
            <p class="section-eyebrow mb-3">Klantwerk</p>
            <h2 class="text-4xl section-title">Gebouwd voor klanten</h2>
        </div>

        <div class="grid sm:grid-cols-2 gap-6 mb-24">
            <article
                v-for="project in clients"
                :key="project.id"
                class="card-glow group relative rounded-xl border overflow-hidden transition-all duration-300"
                style="border-color: var(--color-border); background: var(--color-surface-1);"
            >
                <div class="aspect-video flex items-center justify-center relative overflow-hidden" style="background: var(--color-surface-2);">
                    <div class="relative w-14 h-14 rounded-xl border flex items-center justify-center font-bold text-lg" style="border-color: var(--color-border); color: var(--color-accent);">
                        {{ project.initials }}
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-sm" style="color: var(--color-accent);">{{ project.title }}</h3>
                        <span class="text-xs" style="color: var(--color-text-dim);">{{ project.year }}</span>
                    </div>
                    <p class="text-xs leading-relaxed mb-4" style="color: var(--color-text-muted);">{{ project.description }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="tag in project.tags"
                                :key="tag"
                                class="px-2 py-0.5 rounded border text-[10px] uppercase tracking-wide"
                                style="border-color: var(--color-border); color: var(--color-text-dim);"
                            >{{ tag }}</span>
                        </div>
                        <a
                            :href="project.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="portfolio-link text-xs shrink-0 ml-4 transition-colors duration-200"
                        >Bekijk site →</a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Personal Projects -->
        <div class="mb-16">
            <p class="section-eyebrow mb-3">Eigen projecten</p>
            <h2 class="text-4xl section-title">Gebouwd voor ons</h2>
        </div>

        <div v-if="personal.length" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <article
                v-for="project in personal"
                :key="project.id"
                class="card-glow group relative rounded-xl border overflow-hidden transition-all duration-300"
                style="border-color: var(--color-border); background: var(--color-surface-1);"
            >
                <div class="aspect-video flex items-center justify-center relative overflow-hidden" style="background: var(--color-surface-2);">
                    <div class="relative w-14 h-14 rounded-xl border flex items-center justify-center font-bold text-lg" style="border-color: var(--color-border); color: var(--color-accent);">
                        {{ project.initials }}
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-sm" style="color: var(--color-accent);">{{ project.title }}</h3>
                        <span class="text-xs" style="color: var(--color-text-dim);">{{ project.year }}</span>
                    </div>
                    <p class="text-xs leading-relaxed mb-4" style="color: var(--color-text-muted);">{{ project.description }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="tag in project.tags"
                                :key="tag"
                                class="px-2 py-0.5 rounded border text-[10px] uppercase tracking-wide"
                                style="border-color: var(--color-border); color: var(--color-text-dim);"
                            >{{ tag }}</span>
                        </div>
                        <a
                            v-if="project.href"
                            :href="project.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="portfolio-link text-xs shrink-0 ml-4 transition-colors duration-200"
                        >Bekijk project →</a>
                    </div>
                </div>
            </article>
        </div>

        <div v-else class="card-glow rounded-xl border border-dashed p-12 text-center" style="border-color: var(--color-border);">
            <p class="text-sm" style="color: var(--color-text-muted);">Eigen projecten volgen binnenkort.</p>
        </div>

    </section>
</template>

<script setup>
const clients = [
    {
        id: 1,
        title: 'Lokanta Proeflokaal',
        initials: 'LP',
        year: '2025',
        description: 'Restaurant website for a Tapas Bar, including menu presentation, atmosphere, booking and all the information guests need before they walk in the door.',
        tags: ['Astro'],
        href: 'https://lokanta-proeflokaal.nl',
    },
    {
        id: 2,
        title: 'Slowdown Store',
        initials: 'SS',
        year: '2025',
        description: 'E-commerce store for an independent fashion label',
        tags: ['Astro'],
        href: 'https://slowdownstore.com',
    },
]

const personal = [
    // Add personal projects here when ready
]
</script>

<style scoped>
.portfolio-link {
    color: var(--color-text-muted);
}

.portfolio-link:hover {
    color: var(--color-accent);
}
</style>
