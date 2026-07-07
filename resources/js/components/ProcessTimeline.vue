<template>
    <section id="process" class="process-timeline-section">
        <div class="section-card">
            <div class="max-w-6xl mx-auto px-6 py-16 md:py-24">
                <header class="mb-12 md:mb-16 max-w-2xl">
                    <p class="section-eyebrow mb-3">Werkwijze</p>
                    <h2 class="text-3xl md:text-4xl section-title">Maatwerksoftware, stap voor stap.</h2>
                    <p class="text-sm md:text-base text-[var(--color-text-muted)] mt-3 leading-relaxed">
                        Van het eerste gesprek tot oplevering en daarna.
                    </p>
                </header>

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
                        href="/contact"
                        class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                        data-track="cta_click"
                        data-track-label="Bespreek je project"
                        data-track-location="process"
                    >
                        Bespreek je project →
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
const steps = [
    { id: 1, number: 1, title: 'Kennismaking', body: 'We bespreken je idee, doelen en randvoorwaarden. Zo checken we of maatwerksoftware de juiste keuze is.' },
    { id: 2, number: 2, title: 'Scope & planning', body: 'Heldere milestones, planning en wat succes betekent — voordat we beginnen met bouwen.' },
    { id: 3, number: 3, title: 'Bouwen', body: 'Iteratief ontwikkelen met demos om de twee weken.' },
    { id: 4, number: 4, title: 'Oplevering', body: 'Deployen, overdragen en documenteren zodat je team het vanaf dag één kan gebruiken.' },
    { id: 5, number: 5, title: 'Doorontwikkeling', body: 'Verbeteringen, nieuwe features en ondersteuning terwijl je product groeit.' },
]
</script>
