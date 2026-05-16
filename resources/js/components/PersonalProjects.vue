<template>
    <section id="personal-projects">
        <div class="section-card">
        <div class="max-w-6xl mx-auto px-6 py-24">
        <div class="mb-16">
            <p class="section-eyebrow mb-3">Personal projects</p>
            <h2 class="text-4xl section-title">Built for fun</h2>
        </div>

        <div v-if="personal.length" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <article
                v-for="project in personal"
                :key="project.id"
                class="card-glow group relative rounded-xl border border-[var(--color-border)] bg-[var(--color-surface-1)] overflow-hidden hover:border-[var(--color-accent)]/30 transition-all duration-300"
            >
                <div class="aspect-video bg-[var(--color-surface-2)] flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-grid opacity-40"></div>
                    <div class="relative w-14 h-14 rounded-xl border border-[var(--color-border)] flex items-center justify-center font-bold text-lg" style="color: var(--color-accent)">
                        {{ project.initials }}
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-sm" style="color: var(--color-accent)">{{ project.title }}</h3>
                        <span class="text-xs" style="color: var(--color-text-dim)">{{ project.year }}</span>
                    </div>
                    <p class="text-xs leading-relaxed mb-4" style="color: var(--color-text-muted)">{{ project.description }}</p>
                    <div class="flex items-center justify-between">
                        <div class="flex flex-wrap gap-2">
                            <span
                                v-for="tag in project.tags"
                                :key="tag"
                                class="px-2 py-0.5 rounded border border-[var(--color-border)] text-[10px] uppercase tracking-wide"
                                style="color: var(--color-text-dim)"
                            >{{ tag }}</span>
                        </div>
                        <a
                            v-if="project.href"
                            :href="project.href"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="text-xs shrink-0 ml-4 transition-colors duration-200"
                            style="color: var(--color-text-muted)"
                            @mouseover="$event.target.style.color='var(--color-accent)'"
                            @mouseleave="$event.target.style.color='var(--color-text-muted)'"
                        >View project →</a>
                    </div>
                </div>
            </article>
        </div>

        <div v-else class="card-glow rounded-xl border border-dashed border-[var(--color-border)] p-12 text-center">
            <p class="text-sm" style="color: var(--color-text-dim)">Personal projects coming soon.</p>
        </div>
        </div>
        </div>
    </section>
</template>

<script setup>
const personal = [
    // Add personal projects here when ready:
    // {
    //     id: 1,
    //     title: 'Project Name',
    //     initials: 'PN',
    //     year: '2025',
    //     description: 'What it does.',
    //     tags: ['Laravel', 'Vue'],
    //     href: 'https://...',   // optional
    // },
]
</script>
