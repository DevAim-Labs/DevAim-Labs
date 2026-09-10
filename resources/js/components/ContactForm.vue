<template>
    <section id="contact" data-gsap="section-contact" class="reveal-hidden">
        <div class="section-card">
            <div class="max-w-6xl mx-auto px-6 py-24">
                <header class="mb-16 text-center max-w-2xl mx-auto">
                    <p class="section-eyebrow mb-3">Contact</p>
                    <h2 class="section-title mb-4">{{ isEn ? "Let's build something." : 'Laten we iets bouwen.' }}</h2>
                    <p class="text-sm md:text-base" style="color: var(--color-text-muted);">
                        {{ isEn ? "Tell us about your project and we'll get back to you within 24 hours." : 'Vertel ons over je project en we nemen binnen 24 uur contact op.' }}
                    </p>
                </header>

                <div class="grid md:grid-cols-5 gap-8 lg:gap-12 items-start">
                    <!-- Form (3 columns) -->
                    <div class="md:col-span-3">
                        <div
                            class="glass-card p-6 md:p-8"
                            :class="{ 'gradient-mesh-subtle': !success }"
                        >
                            <!-- Success state -->
                            <div v-if="success" class="text-center py-8">
                                <div class="w-16 h-16 mx-auto mb-6 rounded-full flex items-center justify-center" style="background: var(--color-accent-glow);">
                                    <svg class="w-8 h-8" style="color: var(--color-accent);" viewBox="0 -960 960 960" fill="currentColor">
                                        <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/>
                                    </svg>
                                </div>
                                <h3 class="font-bold text-xl mb-2" style="color: var(--color-text);">{{ t.successTitle }}</h3>
                                <p class="text-sm" style="color: var(--color-text-muted);">{{ t.successDesc }}</p>
                            </div>

                            <!-- Form -->
                            <form v-else @submit.prevent="submit" class="space-y-6" novalidate>
                                <!-- Name field with floating label -->
                                <div class="input-float-group">
                                    <input
                                        id="name"
                                        v-model="form.name"
                                        @change="form.validate('name')"
                                        type="text"
                                        placeholder=" "
                                        autocomplete="name"
                                        class="input-float"
                                        :class="form.invalid('name') ? 'border-red-500/60 focus:border-red-500 focus:ring-red-500/20' : ''"
                                    />
                                    <label for="name" class="input-float-label">{{ t.name }}</label>
                                    <p v-if="form.invalid('name')" class="mt-1.5 text-xs text-red-400">{{ form.errors.name }}</p>
                                </div>

                                <!-- Email field with floating label -->
                                <div class="input-float-group">
                                    <input
                                        id="email"
                                        v-model="form.email"
                                        @change="form.validate('email')"
                                        type="email"
                                        placeholder=" "
                                        autocomplete="email"
                                        class="input-float"
                                        :class="form.invalid('email') ? 'border-red-500/60 focus:border-red-500 focus:ring-red-500/20' : ''"
                                    />
                                    <label for="email" class="input-float-label">{{ t.email }}</label>
                                    <p v-if="form.invalid('email')" class="mt-1.5 text-xs text-red-400">{{ form.errors.email }}</p>
                                </div>

                                <!-- Message field -->
                                <div class="input-float-group">
                                    <textarea
                                        id="message"
                                        v-model="form.message"
                                        @change="form.validate('message')"
                                        rows="5"
                                        placeholder=" "
                                        class="input-float resize-none"
                                        style="padding-top: 1.5rem;"
                                        :class="form.invalid('message') ? 'border-red-500/60 focus:border-red-500 focus:ring-red-500/20' : ''"
                                    ></textarea>
                                    <label for="message" class="input-float-label" style="top: 1rem; transform: none;">{{ t.message }}</label>
                                    <p v-if="form.invalid('message')" class="mt-1.5 text-xs text-red-400">{{ form.errors.message }}</p>
                                </div>

                                <div v-if="serverError" class="text-sm text-red-400 p-3 rounded-lg" style="background: rgba(239, 68, 68, 0.1);">
                                    {{ serverError }}
                                </div>

                                <button
                                    type="submit"
                                    :disabled="form.processing"
                                    class="btn-primary w-full py-4 rounded-xl font-semibold text-base disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                                    style="box-shadow: 0 8px 24px -8px var(--color-accent-glow);"
                                    data-track="cta_click"
                                    :data-track-label="t.submit"
                                    data-track-location="contact_form"
                                >
                                    <span v-if="form.processing">
                                        <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                    </span>
                                    {{ form.processing ? t.sending : t.submit }}
                                    <svg v-if="!form.processing" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Info cards (2 columns) -->
                    <div class="md:col-span-2 space-y-4">
                        <!-- Schedule call card -->
                        <div class="glass-card p-6 card-lift">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0" style="background: var(--color-violet-glow);">
                                    <svg class="w-5 h-5" style="color: var(--color-violet);" viewBox="0 -960 960 960" fill="currentColor">
                                        <path d="M200-80q-33 0-56.5-23.5T120-160v-560q0-33 23.5-56.5T200-800h40v-80h80v80h320v-80h80v80h40q33 0 56.5 23.5T840-720v560q0 33-23.5 56.5T760-80H200Zm0-80h560v-400H200v400Zm0-480h560v-80H200v80Zm0 0v-80 80Zm280 240q-17 0-28.5-11.5T440-440q0-17 11.5-28.5T480-480q17 0 28.5 11.5T520-440q0 17-11.5 28.5T480-320Zm-160 0q-17 0-28.5-11.5T280-440q0-17 11.5-28.5T320-480q17 0 28.5 11.5T360-440q0 17-11.5 28.5T320-320Zm320 0q-17 0-28.5-11.5T600-440q0-17 11.5-28.5T640-480q17 0 28.5 11.5T680-440q0 17-11.5 28.5T640-320ZM480-160q-17 0-28.5-11.5T440-200q0-17 11.5-28.5T480-240q17 0 28.5 11.5T520-200q0 17-11.5 28.5T480-160Zm-160 0q-17 0-28.5-11.5T280-200q0-17 11.5-28.5T320-240q17 0 28.5 11.5T360-200q0 17-11.5 28.5T320-160Zm320 0q-17 0-28.5-11.5T600-200q0-17 11.5-28.5T640-240q17 0 28.5 11.5T680-200q0 17-11.5 28.5T640-160Z"/>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-sm mb-1" style="color: var(--color-text);">{{ t.scheduleTitle }}</h3>
                                    <p class="text-sm leading-relaxed mb-4" style="color: var(--color-text-muted);">{{ t.scheduleDesc }}</p>
                                    <a
                                        href="https://www.cal.eu/devaim/"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="btn-outline-accent inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-medium"
                                        data-track="cta_click"
                                        :data-track-label="t.scheduleBtn"
                                        data-track-location="contact_cal"
                                    >
                                        {{ t.scheduleBtn }}
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- Response time card -->
                        <div class="glass-card p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0" style="background: var(--color-accent-glow);">
                                    <svg class="w-5 h-5" style="color: var(--color-accent);" viewBox="0 -960 960 960" fill="currentColor">
                                        <path d="m612-292 56-56-148-148v-184h-80v216l172 172ZM480-80q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-400Zm0 320q133 0 226.5-93.5T800-480q0-133-93.5-226.5T480-800q-133 0-226.5 93.5T160-480q0 133 93.5 226.5T480-160Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm mb-1" style="color: var(--color-text);">{{ t.responseTitle }}</h3>
                                    <p class="text-sm" style="color: var(--color-text-muted);">{{ t.responseDesc }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Availability card -->
                        <div class="glass-card p-6">
                            <div class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0" style="background: rgba(34, 197, 94, 0.15);">
                                    <svg class="w-5 h-5" style="color: #22C55E;" viewBox="0 -960 960 960" fill="currentColor">
                                        <path d="m424-296 282-282-56-56-226 226-114-114-56 56 170 170Zm56 216q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-sm mb-1" style="color: var(--color-text);">{{ t.availabilityTitle }}</h3>
                                    <p class="text-sm mb-2" style="color: var(--color-text-muted);">{{ t.availabilityDesc }}</p>
                                    <span class="pulse-available text-sm font-medium" style="color: #22C55E; padding-left: 1.25rem;">
                                        {{ t.availableBadge }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, computed } from 'vue'
import { useForm } from 'laravel-precognition-vue'
import { trackFormSubmit } from '../analytics.js'

const locale = window.__LOCALE__ || 'nl'
const isEn = locale === 'en'

const t = computed(() => isEn ? {
    name: 'Name',
    email: 'Email address',
    message: 'Message',
    submit: 'Send message',
    sending: 'Sending...',
    successTitle: 'Message received!',
    successDesc: "We'll get back to you within 24 hours.",
    error: 'Something went wrong. Please try again.',
    scheduleTitle: 'Schedule a call',
    scheduleDesc: 'Prefer to talk? Book a (video) call directly.',
    scheduleBtn: 'Book a call',
    responseTitle: 'Fast response time',
    responseDesc: 'Usually within 24 hours on business days.',
    availabilityTitle: 'Availability',
    availabilityDesc: 'Open for new projects.',
    availableBadge: 'Available'
} : {
    name: 'Naam',
    email: 'E-mailadres',
    message: 'Bericht',
    submit: 'Verstuur bericht',
    sending: 'Versturen...',
    successTitle: 'Bericht ontvangen!',
    successDesc: 'We nemen binnen 24 uur contact met je op.',
    error: 'Er ging iets mis. Probeer het opnieuw.',
    scheduleTitle: 'Plan een gesprek',
    scheduleDesc: 'Liever even bellen? Boek direct een (video)gesprek.',
    scheduleBtn: 'Boek een gesprek',
    responseTitle: 'Snelle reactietijd',
    responseDesc: 'Meestal binnen 24 uur op werkdagen.',
    availabilityTitle: 'Beschikbaarheid',
    availabilityDesc: 'Open voor nieuwe projecten.',
    availableBadge: 'Beschikbaar'
})

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
                serverError.value = t.value.error
            }
        },
    })
}
</script>

<style scoped>
.input-float:focus ~ .input-float-label,
.input-float:not(:placeholder-shown) ~ .input-float-label {
    top: 0.5rem;
    transform: translateY(0);
    font-size: 0.7rem;
    color: var(--color-accent);
}

textarea.input-float:focus ~ .input-float-label,
textarea.input-float:not(:placeholder-shown) ~ .input-float-label {
    top: 0.375rem;
}
</style>
