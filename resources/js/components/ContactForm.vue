<template>
    <section id="contact" class="max-w-6xl mx-auto px-6 py-24">
        <div class="mb-16">
            <p class="section-eyebrow mb-3">Get in touch</p>
            <h2 class="text-4xl section-title">Let's build something.</h2>
        </div>

        <div class="grid md:grid-cols-2 gap-12 items-start">
            <!-- Form column -->
            <div>
                <!-- Success state -->
                <div v-if="success" class="rounded-xl border border-[var(--color-accent)]/30 p-6" style="background: rgba(11,133,152,0.08);">
                    <p class="font-semibold text-[var(--color-text)] mb-1">Message received.</p>
                    <p class="text-sm text-[var(--color-text-muted)]">I'll get back to you within 24 hours.</p>
                </div>

                <form v-else @submit.prevent="submit" class="space-y-5" novalidate>
                    <div>
                        <label for="name" class="block text-sm text-[var(--color-text-muted)] mb-1.5">Name</label>
                        <input
                            id="name"
                            v-model="form.name"
                            @change="form.validate('name')"
                            type="text"
                            placeholder="Your name"
                            autocomplete="name"
                            class="w-full px-4 py-2.5 rounded-md bg-[var(--color-input)] text-[var(--color-text)] text-sm placeholder-[var(--color-text-dim)] outline-none border transition-colors duration-200"
                            :class="form.invalid('name') ? 'border-red-500/60 focus:border-red-500' : 'border-[var(--color-border)] focus:border-[var(--color-accent)]/60'"
                        />
                        <p v-if="form.invalid('name')" class="mt-1.5 text-xs text-red-400">{{ form.errors.name }}</p>
                    </div>

                    <div>
                        <label for="email" class="block text-sm text-[var(--color-text-muted)] mb-1.5">Email</label>
                        <input
                            id="email"
                            v-model="form.email"
                            @change="form.validate('email')"
                            type="email"
                            placeholder="you@company.com"
                            autocomplete="email"
                            class="w-full px-4 py-2.5 rounded-md bg-[var(--color-input)] text-[var(--color-text)] text-sm placeholder-[var(--color-text-dim)] outline-none border transition-colors duration-200"
                            :class="form.invalid('email') ? 'border-red-500/60 focus:border-red-500' : 'border-[var(--color-border)] focus:border-[var(--color-accent)]/60'"
                        />
                        <p v-if="form.invalid('email')" class="mt-1.5 text-xs text-red-400">{{ form.errors.email }}</p>
                    </div>

                    <div>
                        <label for="message" class="block text-sm text-[var(--color-text-muted)] mb-1.5">Message</label>
                        <textarea
                            id="message"
                            v-model="form.message"
                            @change="form.validate('message')"
                            rows="5"
                            placeholder="Tell me about your project..."
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
                    >
                        {{ form.processing ? 'Sending…' : 'Send message' }}
                    </button>
                </form>
            </div>

            <!-- Booking column -->
            <div class="space-y-5">


                <div class="card-glow rounded-xl border border-[var(--color-border)] bg-[var(--color-input)] p-6">
                    <h3 class="font-semibold text-[var(--color-text)] mb-2 text-sm">Schedule a call</h3>
                    <p class="text-sm text-[var(--color-text-muted)] leading-relaxed mb-5">Prefer to talk? Book a video call directly with us.</p>
                    <a
                        href="https://www.cal.eu/devaim/"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="btn-outline-accent inline-flex items-center gap-2 px-4 py-2.5 rounded-md text-sm font-medium"
                    >
                        Book a call →
                    </a>
                </div>


                <!--
                <div class="card-glow rounded-xl border border-[var(--color-border)] bg-[var(--color-input)] p-6">
                    <h3 class="font-semibold text-[var(--color-text)] mb-2 text-sm">Get in touch:</h3>
                    <div class="font-light text-m">
                        <p>E-mail: devaimlabs@gmail.com</p>
                        <p>Phone: +31 6385230999</p>
                    </div>
                </div>
                -->

                <div class="rounded-xl border border-[var(--color-border)] bg-[var(--color-input)] p-6">
                    <h3 class="font-semibold text-[var(--color-text)] mb-2 text-sm">Response time</h3>
                    <p class="text-sm text-[var(--color-text-muted)]">Typically within 24 hours on business days.</p>
                </div>

                <div class="rounded-xl border border-[var(--color-border)] bg-[var(--color-input)] p-6">
                    <h3 class="font-semibold text-[var(--color-text)] mb-2 text-sm">Availability</h3>
                    <p class="text-sm text-[var(--color-text-muted)]">Currently open for new projects.</p>
                    <span class="inline-flex items-center gap-1.5 mt-3 text-xs text-[var(--color-accent)]">
                        <span class="w-1.5 h-1.5 rounded-full bg-[var(--color-accent)] animate-pulse"></span>
                        Available
                    </span>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from 'laravel-precognition-vue'

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
        },
        onError: (errors) => {
            if (!Object.keys(errors).length) {
                serverError.value = 'Something went wrong. Please try again.'
            }
        },
    })
}
</script>
