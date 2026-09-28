<script setup>
// The contact form's card — mounted as a small, focused island into a page
// whose surrounding heading/copy is real server-rendered Blade (see
// resources/views/partials/landing/contact.blade.php). Kept separate from
// that static content so the page's text is crawlable without JS.
import { ref } from 'vue'
import LandingIcon from '../landing/LandingIcon.vue'

const form = ref({ name: '', email: '', message: '', website_url: '' })
const isSubmitting = ref(false)
const isSuccess = ref(false)
const errorMsg = ref('')
const fieldErrors = ref({})

function clearFieldError(field) {
    if (fieldErrors.value[field]) delete fieldErrors.value[field]
}

async function submitForm() {
    if (isSubmitting.value) return

    isSubmitting.value = true
    errorMsg.value = ''
    fieldErrors.value = {}

    try {
        const response = await fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '',
            },
            body: JSON.stringify(form.value),
        })

        if (response.ok) {
            isSuccess.value = true
            form.value = { name: '', email: '', message: '', website_url: '' }
        } else if (response.status === 422) {
            const data = await response.json()
            fieldErrors.value = Object.fromEntries(
                Object.entries(data.errors || {}).map(([key, msgs]) => [key, msgs[0]])
            )
            errorMsg.value = data.message || 'Controleer de gemarkeerde velden.'
        } else {
            const data = await response.json().catch(() => ({}))
            errorMsg.value = data.message || 'Er ging iets mis. Probeer het opnieuw.'
        }
    } catch (e) {
        errorMsg.value = 'Er ging iets mis. Controleer uw internetverbinding en probeer het opnieuw.'
    } finally {
        isSubmitting.value = false
    }
}

function resetForm() {
    isSuccess.value = false
}
</script>

<template>
    <div class="block-border mx-auto max-w-xl p-6 text-left md:p-8">
        <Transition name="fade" mode="out-in">
            <div v-if="isSuccess" key="success" class="py-6 text-center">
                <div
                    class="mx-auto flex h-14 w-14 items-center justify-center"
                    style="background: var(--color-accent); color: var(--color-on-accent)"
                >
                    <LandingIcon name="check" :size="26" />
                </div>
                <p class="mt-4 text-lg font-semibold" style="color: var(--color-text)">Bericht verzonden!</p>
                <p class="mt-1 text-sm" style="color: var(--color-text-muted)">
                    Ik neem binnen 24 uur contact met u op.
                </p>
                <button type="button" class="btn-hover btn-hover-outline mt-6 cursor-pointer" @click="resetForm">
                    <span class="btn-hover__dot" aria-hidden="true"></span>
                    <span class="btn-hover__label">Nog een bericht versturen</span>
                    <span class="btn-hover__reveal" aria-hidden="true">Nog een bericht versturen</span>
                </button>
            </div>

            <form v-else key="form" class="space-y-5" novalidate @submit.prevent="submitForm">
                <!-- Honeypot: hidden from real visitors, off-screen (not display:none, so
                     it still exists for screen-reader-only bot heuristics), never focusable. -->
                <div class="sr-only" aria-hidden="true">
                    <label for="website_url">Laat dit veld leeg</label>
                    <input
                        id="website_url"
                        v-model="form.website_url"
                        type="text"
                        name="website_url"
                        tabindex="-1"
                        autocomplete="off"
                    />
                </div>

                <div>
                    <label for="name" class="mb-1.5 block text-sm font-medium" style="color: var(--color-text)">Naam</label>
                    <input
                        id="name"
                        v-model="form.name"
                        type="text"
                        name="name"
                        required
                        maxlength="100"
                        autocomplete="name"
                        class="field-input"
                        :aria-invalid="fieldErrors.name ? 'true' : 'false'"
                        :aria-describedby="fieldErrors.name ? 'name-error' : undefined"
                        @input="clearFieldError('name')"
                    />
                    <p v-if="fieldErrors.name" id="name-error" class="field-error">{{ fieldErrors.name }}</p>
                </div>

                <div>
                    <label for="email" class="mb-1.5 block text-sm font-medium" style="color: var(--color-text)">E-mailadres</label>
                    <input
                        id="email"
                        v-model="form.email"
                        type="email"
                        name="email"
                        required
                        maxlength="255"
                        autocomplete="email"
                        class="field-input"
                        :aria-invalid="fieldErrors.email ? 'true' : 'false'"
                        :aria-describedby="fieldErrors.email ? 'email-error' : undefined"
                        @input="clearFieldError('email')"
                    />
                    <p v-if="fieldErrors.email" id="email-error" class="field-error">{{ fieldErrors.email }}</p>
                </div>

                <div>
                    <label for="message" class="mb-1.5 block text-sm font-medium" style="color: var(--color-text)">Bericht</label>
                    <textarea
                        id="message"
                        v-model="form.message"
                        name="message"
                        rows="4"
                        required
                        minlength="20"
                        maxlength="2000"
                        placeholder="Vertel iets over uw project, doelen en planning (minimaal 20 tekens)…"
                        class="field-input resize-none"
                        :aria-invalid="fieldErrors.message ? 'true' : 'false'"
                        :aria-describedby="fieldErrors.message ? 'message-error' : undefined"
                        @input="clearFieldError('message')"
                    ></textarea>
                    <p v-if="fieldErrors.message" id="message-error" class="field-error">{{ fieldErrors.message }}</p>
                </div>

                <p v-if="errorMsg && !Object.keys(fieldErrors).length" role="alert" class="field-error">
                    {{ errorMsg }}
                </p>

                <button type="submit" class="btn-hover btn-hover-primary w-full justify-center cursor-pointer" :disabled="isSubmitting">
                    <span class="btn-hover__dot" aria-hidden="true"></span>
                    <span class="btn-hover__label">{{ isSubmitting ? 'Versturen…' : 'Verstuur bericht' }}</span>
                    <span class="btn-hover__reveal" aria-hidden="true">{{ isSubmitting ? 'Versturen…' : 'Verstuur bericht' }}</span>
                </button>

                <p class="text-center text-xs" style="color: var(--color-text-dim)">
                    Uw gegevens zijn veilig. Lees mijn
                    <a href="/privacyverklaring" class="underline cursor-pointer" style="color: var(--color-text-muted)">privacyverklaring</a>.
                </p>
            </form>
        </Transition>
    </div>
</template>

<style scoped>
.field-input {
    width: 100%;
    min-height: 44px;
    padding: 0.625rem 0.875rem;
    background: var(--color-input);
    border: 1px solid var(--color-border-strong);
    border-radius: 0;
    color: var(--color-text);
    font-size: 0.9375rem;
    transition: border-color 0.15s ease;
}
.field-input::placeholder {
    color: var(--color-text-dim);
}
.field-input:focus {
    border-color: var(--color-accent);
}
.field-input[aria-invalid='true'] {
    border-color: #f87171;
}

.field-error {
    margin-top: 0.375rem;
    font-size: 0.8125rem;
    color: #f87171;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s ease;
}
.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

@media (prefers-reduced-motion: reduce) {
    .fade-enter-active,
    .fade-leave-active {
        transition: none;
    }
}
</style>
