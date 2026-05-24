<template>
    <section id="contact" class="max-w-6xl mx-auto px-6 py-24">
        <div class="mb-16">
            <p class="section-eyebrow mb-3">Contact</p>
            <h2 class="text-4xl section-title">Laten we iets bouwen.</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-start">
            <div>
                <div v-if="success" class="rounded-xl border border-[var(--color-accent)]/30 p-6" style="background: rgba(11,133,152,0.08);">
                    <p class="font-semibold text-[var(--color-text)] mb-1">Bericht ontvangen.</p>
                    <p class="text-sm text-[var(--color-text-muted)]">Ik neem binnen 24 uur contact met je op.</p>
                </div>

                <form v-else @submit.prevent="submit" class="space-y-5" novalidate>
                    <div>
                        <label for="name" class="block text-sm text-[var(--color-text-muted)] mb-1.5">Naam</label>
                        <input
                            id="name"
                            v-model="form.name"
                            @change="form.validate('name')"
                            type="text"
                            placeholder="Naam"
                            autocomplete="name"
                            class="w-full px-4 py-2.5 rounded-md bg-[var(--color-input)] text-[var(--color-text)] text-sm placeholder-[var(--color-text-dim)] outline-none border transition-colors duration-200"
                            :class="form.invalid('name') ? 'border-red-500/60 focus:border-red-500' : 'border-[var(--color-border)] focus:border-[var(--color-accent)]/60'"
                        />
                        <p v-if="form.invalid('name')" class="mt-1.5 text-xs text-red-400">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm text-[var(--color-text-muted)] mb-1.5">E-mail</label>
                        <input
                            id="email"
                            v-model="form.email"
                            @change="form.validate('email')"
                            type="email"
                            placeholder="john@company.com"
                            autocomplete="email"
                            class="w-full px-4 py-2.5 rounded-md bg-[var(--color-input)] text-[var(--color-text)] text-sm placeholder-[var(--color-text-dim)] outline-none border transition-colors duration-200"
                            :class="form.invalid('email') ? 'border-red-500/60 focus:border-red-500' : 'border-[var(--color-border)] focus:border-[var(--color-accent)]/60'"
                        />
                        <p v-if="form.invalid('email')" class="mt-1.5 text-xs text-red-400">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label for="message" class="block text-sm text-[var(--color-text-muted)] mb-1.5">Bericht</label>
                        <textarea
                            id="message"
                            v-model="form.message"
                            @change="form.validate('message')"
                            rows="5"
                            placeholder="Vertel kort over je project..."
                            class="w-full px-4 py-2.5 rounded-md bg-[var(--color-input)] text-[var(--color-text)] text-sm placeholder-[var(--color-text-dim)] outline-none border transition-colors duration-200 resize-none"
                            :class="form.invalid('message') ? 'border-red-500/60 focus:border-red-500' : 'border-[var(--color-border)] focus:border-[var(--color-accent)]/60'"
                        ></textarea>
                        <p v-if="form.invalid('message')" class="mt-1.5 text-xs text-red-400">{{ form.errors.message }}</p>
                    </div>

                    <div v-if="serverError" class="text-sm text-red-400">{{ serverError }}</div>

                    <button
                        type="submit"
                        :disabled="form.processing"
                        class="btn-primary w-full py-3 rounded-md font-semibold text-sm disabled:opacity-50 disabled:cursor-not-allowed"
                        data-track="cta_click"
                        data-track-label="Verstuur bericht"
                        data-track-location="contact_form"
                    >
                        {{ form.processing ? 'Versturen…' : 'Verstuur bericht' }}
                    </button>
                </form>
            </div>

            <div class="space-y-5">
                <div class="card-glow rounded-xl border border-[var(--color-border)] bg-[var(--color-input)] p-6">
                    <h3 class="font-semibold text-[var(--color-text)] mb-2 text-sm">Plan een gesprek</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed mb-5">Liever even bellen? Boek direct een (video)gesprek.</p>
                    <a
                        href="https://www.cal.eu/devaim/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-outline-accent inline-flex items-center gap-2 px-4 py-2.5 rounded-md text-sm font-medium"
                        data-track="cta_click"
                        data-track-label="Boek een gesprek"
                        data-track-location="contact_cal"
                    >
                        Boek een gesprek →
                    </a>
                </div>

                <div class="rounded-xl border border-[var(--color-border)] bg-[var(--color-input)] p-6">
                    <h3 class="font-semibold text-[var(--color-text)] mb-2 text-sm">Reactietijd</h3>
                    <p class="text-sm text-[var(--color-text-muted)]">Meestal binnen 24 uur op werkdagen.</p>
                </div>

                <div class="rounded-xl border border-[var(--color-border)] bg-[var(--color-input)] p-6">
                    <h3 class="font-semibold text-[var(--color-text)] mb-2 text-sm">Beschikbaarheid</h3>
                    <p class="text-sm text-[var(--color-text-muted)]">Momenteel open voor nieuwe projecten.</p>
                    <span class="inline-flex items-center gap-1.5 mt-3 text-xs text-[var(--color-accent)]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-accent)] animate-pulse"></span>
                        Beschikbaar
                    </span>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from 'laravel-precognition-vue'
import { trackFormSubmit } from '../analytics.js'

const success = ref(false)
const serverError = ref('')

const form = useForm('post', '/contact', {
    name: '',
    email: '',
    message: '',
})

function submit() {
    serverError.value = ''
    form.submit({
        onSuccess: () => {
            success.value = true
            trackFormSubmit('contact')
        },
        onError: (errors) => {
            if (!Object.keys(errors).length) {
                serverError.value = 'Er ging iets mis. Probeer het opnieuw.'
            }
        },
    })
}
</script>
