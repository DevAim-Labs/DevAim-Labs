<template>
    <section id="process" class="process-timeline-section">
        <div class="section-card">
            <div class="max-w-6xl mx-auto px-6 py-16 md:py-24">
                <header class="mb-12 md:mb-16 max-w-2xl">
                    <p class="section-eyebrow mb-3">How we work</p>
                    <h2 class="text-3xl md:text-4xl section-title">Custom software, step by step.</h2>
                    <p class="text-sm md:text-base text-[var(--color-text-muted)] mt-3 leading-relaxed">
                        From first conversation to deployment and beyond.
                    </p>
                </header>

                <!-- Desktop: horizontal timeline -->
                <ol class="hidden md:grid md:grid-cols-5 md:gap-4 relative list-none m-0 p-0">
                    <div
                        class="absolute top-7 left-[10%] right-[10%] h-px -translate-y-1/2 pointer-events-none"
                        style="background: var(--color-border);"
                        aria-hidden="true"
                    ></div>
                    <li
                        v-for="step in steps"
                        :key="step.id"
                        class="relative flex flex-col items-center text-center px-2"
                    >
                        <div
                            class="relative z-10 flex h-14 w-14 shrink-0 items-center justify-center rounded-full border-2 text-sm font-semibold tabular-nums"
                            style="border-color: var(--color-accent); color: var(--color-accent); background: var(--color-section);"
                        >
                            {{ step.number }}
                        </div>
                        <h3 class="mt-5 text-sm font-semibold section-title leading-snug">
                            {{ step.title }}
                        </h3>
                        <p class="mt-2 text-xs leading-relaxed text-[var(--color-text-muted)]">
                            {{ step.body }}
                        </p>
                    </li>
                </ol>

                <!-- Mobile: vertical timeline -->
                <ol class="md:hidden list-none m-0 p-0 space-y-8">
                    <li
                        v-for="(step, i) in steps"
                        :key="'m-' + step.id"
                        class="relative flex gap-5 pl-1"
                    >
                        <div class="flex flex-col items-center shrink-0">
                            <div
                                class="flex h-12 w-12 items-center justify-center rounded-full border-2 text-sm font-semibold tabular-nums"
                                style="border-color: var(--color-accent); color: var(--color-accent); background: var(--color-section);"
                            >
                                {{ step.number }}
                            </div>
                            <div
                                v-if="i < steps.length - 1"
                                class="mt-2 w-px flex-1 min-h-[2rem]"
                                style="background: var(--color-border);"
                                aria-hidden="true"
                            ></div>
                        </div>
                        <div class="pt-1 pb-2">
                            <h3 class="text-base font-semibold section-title leading-snug">
                                {{ step.title }}
                            </h3>
                            <p class="mt-2 text-sm leading-relaxed text-[var(--color-text-muted)]">
                                {{ step.body }}
                            </p>
                        </div>
                    </li>
                </ol>

                <div class="mt-12 md:mt-14 text-center">
                    <a
                        href="#contact"
                        class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                    >
                        Talk about your project →
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const steps = [
    { id: 1, number: 1, title: 'Meeting', body: "We discuss your idea, goals, and constraints. With this we'll be able to check whether custom software is the right fit." },
    { id: 2, number: 2, title: 'Scope & plan', body: 'Clear milestones, timeline, and what the goal looks like before start.' },
    { id: 3, number: 3, title: 'Build', body: 'Iterative development with demos every 2 weeks' },
    { id: 4, number: 4, title: 'Launch', body: 'Deploy, hand over, and document so your team can use it from day one.' },
    { id: 5, number: 5, title: 'Iterate', body: 'Improvements, new features, and support as your product grows.' },
]
</script>
