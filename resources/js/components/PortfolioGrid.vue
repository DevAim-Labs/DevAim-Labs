<template>
    <section id="portfolio" class="max-w-6xl mx-auto px-6 py-24">

        <!-- Client Work -->
        <div class="mb-16">
            <p class="text-xs uppercase tracking-widest mb-3" style="color:#22d3ee">Client work</p>
            <h2 class="text-4xl font-bold tracking-tight" style="letter-spacing:-0.02em;color:#f0f0f0">Built for clients</h2>
        </div>

        <div class="grid sm:grid-cols-2 gap-6 mb-24">
            <article
                v-for="project in clients"
                :key="project.id"
                class="group relative rounded-xl border border-[var(--color-border)] bg-[var(--color-surface-1)] overflow-hidden hover:border-[var(--color-accent)]/30 transition-all duration-300"
            >
                <div class="aspect-video bg-[var(--color-surface-2)] flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-grid opacity-40"></div>
                    <div class="relative w-14 h-14 rounded-xl border border-[var(--color-border)] flex items-center justify-center font-bold text-lg" style="color:#22d3ee">
                        {{ project.initials }}
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-sm" style="color:#22d3ee">{{ project.title }}</h3>
                        <span class="text-xs" style="color:#555555">{{ project.year }}</span>
                    </div>
                    <p class="text-xs leading-relaxed mb-4" style="color:#888888">{{ project.description }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="tag in project.tags"
                                :key="tag"
                                class="px-2 py-0.5 rounded border border-[var(--color-border)] text-[10px] uppercase tracking-wide"
                                style="color:#555555"
                            >{{ tag }}</span>
                        </div>
                        <a
                            :href="project.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-xs shrink-0 ml-4 transition-colors duration-200"
                            style="color:#888888"
                            @mouseover="$event.target.style.color='#22d3ee'"
                            @mouseleave="$event.target.style.color='#888888'"
                        >Visit site →</a>
                    </div>
                </div>
            </article>
        </div>

        <!-- Personal Projects -->
        <div class="mb-16">
            <p class="text-xs uppercase tracking-widest mb-3" style="color:#22d3ee">Personal projects</p>
            <h2 class="text-4xl font-bold tracking-tight" style="letter-spacing:-0.02em;color:#f0f0f0">Built for fun</h2>
        </div>

        <div v-if="personal.length" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <article
                v-for="project in personal"
                :key="project.id"
                class="group relative rounded-xl border border-[var(--color-border)] bg-[var(--color-surface-1)] overflow-hidden hover:border-[var(--color-accent)]/30 transition-all duration-300"
            >
                <div class="aspect-video bg-[var(--color-surface-2)] flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-grid opacity-40"></div>
                    <div class="relative w-14 h-14 rounded-xl border border-[var(--color-border)] flex items-center justify-center font-bold text-lg" style="color:#22d3ee">
                        {{ project.initials }}
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-sm" style="color:#22d3ee">{{ project.title }}</h3>
                        <span class="text-xs" style="color:#555555">{{ project.year }}</span>
                    </div>
                    <p class="text-xs leading-relaxed mb-4" style="color:#888888">{{ project.description }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="tag in project.tags"
                                :key="tag"
                                class="px-2 py-0.5 rounded border border-[var(--color-border)] text-[10px] uppercase tracking-wide"
                                style="color:#555555"
                            >{{ tag }}</span>
                        </div>
                        <a
                            v-if="project.href"
                            :href="project.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-xs shrink-0 ml-4 transition-colors duration-200"
                            style="color:#888888"
                            @mouseover="$event.target.style.color='#22d3ee'"
                            @mouseleave="$event.target.style.color='#888888'"
                        >View project →</a>
                    </div>
                </div>
            </article>
        </div>

        <div v-else class="rounded-xl border border-dashed border-[var(--color-border)] p-12 text-center">
            <p class="text-sm" style="color:#555555">Personal projects coming soon.</p>
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
