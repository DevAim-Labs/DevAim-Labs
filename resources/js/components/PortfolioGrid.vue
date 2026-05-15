<template>
    <section id="portfolio" class="max-w-6xl mx-auto px-6 py-24">
        <div class="mb-16">
            <p class="text-xs text-[--color-accent] uppercase tracking-widest mb-3">Selected work</p>
            <h2 class="text-4xl font-bold tracking-tight text-[--color-text]" style="letter-spacing: -0.02em;">Portfolio</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <article
                v-for="project in projects"
                :key="project.id"
                class="group relative rounded-xl border border-[--color-border] bg-[--color-surface-1] overflow-hidden hover:border-[--color-accent]/30 transition-all duration-300"
            >
                <!-- Thumbnail placeholder -->
                <div class="aspect-video bg-[--color-surface-2] flex items-center justify-center relative overflow-hidden">
                    <div class="absolute inset-0 bg-grid opacity-40"></div>
                    <div class="relative w-14 h-14 rounded-xl border border-[--color-border] flex items-center justify-center text-[--color-accent] font-bold text-lg">
                        {{ project.initials }}
                    </div>
                </div>

                <div class="p-5">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="font-semibold text-[--color-text] text-sm">{{ project.title }}</h3>
                        <span class="text-xs text-[--color-text-dim]">{{ project.year }}</span>
                    </div>
                    <p class="text-xs text-[--color-text-muted] leading-relaxed mb-4">{{ project.description }}</p>
                    <div class="flex flex-wrap gap-2">
                        <span
                            v-for="tag in project.tags"
                            :key="tag"
                            class="px-2 py-0.5 rounded border border-[--color-border] text-[10px] text-[--color-text-dim] uppercase tracking-wide"
                        >{{ tag }}</span>
                    </div>
                </div>
            </article>
        </div>

        <p class="text-center text-sm text-[--color-text-dim] mt-12">More projects coming soon.</p>
    </section>
</template>

<script setup>
const projects = [
    {
        id: 1,
        title: 'Project Alpha',
        initials: 'PA',
        year: '2025',
        description: 'A full-stack web application with authentication, dashboard, and payment integration.',
        tags: ['Laravel', 'Vue', 'Stripe'],
    },
    {
        id: 2,
        title: 'Project Beta',
        initials: 'PB',
        year: '2025',
        description: 'AI-powered internal tool with custom LLM integration and automated workflows.',
        tags: ['Laravel', 'OpenAI', 'Inertia'],
    },
    {
        id: 3,
        title: 'Project Gamma',
        initials: 'PG',
        year: '2025',
        description: 'Marketing site and custom CMS with SEO optimization and content management.',
        tags: ['Laravel', 'Tailwind', 'Alpine'],
    },
]
</script>
