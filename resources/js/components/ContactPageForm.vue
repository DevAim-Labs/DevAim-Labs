<script setup>
import { ref, computed } from 'vue'

const props = defineProps({
    locale: {
        type: String,
        default: 'nl'
    }
})

const locale = props.locale || window.__LOCALE__ || 'nl'
const isEn = locale === 'en'

const t = computed(() => ({
    title: isEn ? 'Send me a message' : 'Stuur mij een bericht',
    name: isEn ? 'Name' : 'Naam',
    namePlaceholder: 'John Doe',
    company: isEn ? 'Company' : 'Bedrijf',
    companyPlaceholder: isEn ? 'Your company' : 'Je bedrijf',
    email: isEn ? 'Email' : 'E-mail',
    emailPlaceholder: 'john@example.com',
    projectType: isEn ? 'Type of project' : 'Type project',
    projectTypes: isEn ? [
        { value: '', label: 'Select...' },
        { value: 'website', label: 'Website / Web app' },
        { value: 'dashboard', label: 'Dashboard / Admin panel' },
        { value: 'integration', label: 'API / Integration' },
        { value: 'mvp', label: 'MVP / Prototype' },
        { value: 'other', label: 'Something else' },
    ] : [
        { value: '', label: 'Selecteer...' },
        { value: 'website', label: 'Website / Web app' },
        { value: 'dashboard', label: 'Dashboard / Adminpaneel' },
        { value: 'integration', label: 'API / Integratie' },
        { value: 'mvp', label: 'MVP / Prototype' },
        { value: 'other', label: 'Iets anders' },
    ],
    message: isEn ? 'Tell me more about your project (optional)' : 'Vertel me meer over je project (optioneel)',
    messagePlaceholder: isEn ? 'Describe your project, goals, timeline...' : 'Beschrijf je project, doelen, planning...',
    submit: isEn ? 'Send message' : 'Verstuur bericht',
    sending: isEn ? 'Sending...' : 'Versturen...',
    success: isEn ? 'Message sent successfully!' : 'Bericht succesvol verzonden!',
    successSub: isEn ? "I'll get back to you within 24 hours." : 'Ik neem binnen 24 uur contact met je op.',
    error: isEn ? 'Something went wrong. Please try again.' : 'Er ging iets mis. Probeer het opnieuw.',
    privacy: isEn ? 'Your data is safe. Read my' : 'Je gegevens zijn veilig. Lees mijn',
    privacyLink: isEn ? 'privacy policy' : 'privacyverklaring',
}))

const form = ref({
    name: '',
    company: '',
    email: '',
    projectType: '',
    message: ''
})

const isSubmitting = ref(false)
const isSuccess = ref(false)
const errorMsg = ref('')

async function submitForm() {
    if (isSubmitting.value) return

    isSubmitting.value = true
    errorMsg.value = ''

    try {
        const response = await fetch('/contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                name: form.value.name,
                email: form.value.email,
                message: `Bedrijf: ${form.value.company}\nType project: ${form.value.projectType}\n\n${form.value.message || '(Geen extra details)'}`
            })
        })

        if (response.ok) {
            isSuccess.value = true
            form.value = { name: '', company: '', email: '', projectType: '', message: '' }

            // Track conversion
            if (typeof gtag !== 'undefined') {
                gtag('event', 'generate_lead', {
                    event_category: 'Contact',
                    event_label: 'Contact Page Form'
                })
            }
        } else {
            const data = await response.json()
            errorMsg.value = data.message || t.value.error
        }
    } catch (e) {
        errorMsg.value = t.value.error
    } finally {
        isSubmitting.value = false
    }
}

function resetForm() {
    isSuccess.value = false
    form.value = { name: '', company: '', email: '', projectType: '', message: '' }
}
</script>

<template>
    <div class="contact-form-card">
        <!-- Card Header -->
        <div class="form-header">
            <div class="header-dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <span class="header-title">{{ t.title }}</span>
        </div>

        <!-- Success State -->
        <div v-if="isSuccess" class="form-body form-success">
            <svg class="success-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <h3>{{ t.success }}</h3>
            <p>{{ t.successSub }}</p>
            <button @click="resetForm" class="reset-btn">
                {{ isEn ? 'Send another message' : 'Nog een bericht sturen' }}
            </button>
        </div>

        <!-- Form -->
        <form v-else class="form-body" @submit.prevent="submitForm">
            <!-- Name -->
            <div class="form-field">
                <label>{{ t.name }} <span class="required">*</span></label>
                <input
                    v-model="form.name"
                    type="text"
                    :placeholder="t.namePlaceholder"
                    required
                >
            </div>

            <!-- Company -->
            <div class="form-field">
                <label>{{ t.company }} <span class="required">*</span></label>
                <input
                    v-model="form.company"
                    type="text"
                    :placeholder="t.companyPlaceholder"
                    required
                >
            </div>

            <!-- Email -->
            <div class="form-field">
                <label>{{ t.email }} <span class="required">*</span></label>
                <input
                    v-model="form.email"
                    type="email"
                    :placeholder="t.emailPlaceholder"
                    required
                >
            </div>

            <!-- Project Type -->
            <div class="form-field">
                <label>{{ t.projectType }} <span class="required">*</span></label>
                <select v-model="form.projectType" required>
                    <option
                        v-for="opt in t.projectTypes"
                        :key="opt.value"
                        :value="opt.value"
                        :disabled="opt.value === ''"
                    >
                        {{ opt.label }}
                    </option>
                </select>
            </div>

            <!-- Message -->
            <div class="form-field">
                <label>{{ t.message }}</label>
                <textarea
                    v-model="form.message"
                    :placeholder="t.messagePlaceholder"
                    rows="5"
                ></textarea>
            </div>

            <!-- Error -->
            <p v-if="errorMsg" class="form-error">{{ errorMsg }}</p>

            <!-- Submit -->
            <button type="submit" class="form-submit" :disabled="isSubmitting">
                {{ isSubmitting ? t.sending : t.submit }}
                <svg v-if="!isSubmitting" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>

            <!-- Privacy note -->
            <p class="privacy-note">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                {{ t.privacy }}
                <a href="/privacyverklaring">{{ t.privacyLink }}</a>.
            </p>
        </form>
    </div>
</template>

<style scoped>
/* ═══════════════════════════════════════════════════════════════════════════
   CONTACT FORM — Spacious, breathing, confident
   ═══════════════════════════════════════════════════════════════════════════ */

.contact-form-card {
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    border-radius: 16px;
    overflow: hidden;
}

/* Header */
.form-header {
    display: flex;
    align-items: center;
    gap: 0.875rem;
    padding: 1.125rem 2rem;
    background: var(--color-surface-2);
    border-bottom: 1px solid var(--color-border-dim);
}

.header-dots {
    display: flex;
    gap: 7px;
}

.header-dots span {
    width: 11px;
    height: 11px;
    border-radius: 50%;
}

.header-dots span:nth-child(1) { background: #EF4444; }
.header-dots span:nth-child(2) { background: #F59E0B; }
.header-dots span:nth-child(3) { background: #22C55E; }

.header-title {
    font-size: 0.8125rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: var(--color-text-muted);
}

/* Body — MORE SPACE */
.form-body {
    padding: 2.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Fields — Stacked single column for scannability */
.form-field {
    display: flex;
    flex-direction: column;
    gap: 0.625rem;
}

.form-field label {
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--color-text-muted);
}

.form-field .required {
    color: var(--color-accent);
}

.form-field input,
.form-field select,
.form-field textarea {
    width: 100%;
    padding: 1rem 1.25rem;
    background: var(--color-surface);
    border: 1px solid var(--color-border-dim);
    border-radius: 8px;
    color: var(--color-text);
    font-size: 1rem;
    font-family: inherit;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
}

.form-field input::placeholder,
.form-field textarea::placeholder {
    color: var(--color-text-dim);
}

.form-field input:hover,
.form-field select:hover,
.form-field textarea:hover {
    border-color: var(--color-border);
}

.form-field input:focus,
.form-field select:focus,
.form-field textarea:focus {
    outline: none;
    border-color: var(--color-accent);
    box-shadow: 0 0 0 3px var(--color-accent-glow);
}

.form-field select {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2371717A' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1.125rem;
    padding-right: 3rem;
}

.form-field textarea {
    resize: vertical;
    min-height: 140px;
    line-height: 1.6;
}

/* Error */
.form-error {
    font-size: 0.875rem;
    color: #EF4444;
    padding: 1rem 1.25rem;
    background: rgba(239, 68, 68, 0.08);
    border: 1px solid rgba(239, 68, 68, 0.2);
    border-radius: 8px;
    margin: 0;
}

/* Submit — Prominent */
.form-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.625rem;
    width: 100%;
    padding: 1.125rem 2rem;
    margin-top: 0.5rem;
    background: var(--color-accent);
    color: var(--color-on-accent);
    border: none;
    border-radius: 10px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.15s ease, box-shadow 0.2s ease;
}

.form-submit:hover:not(:disabled) {
    background: var(--color-accent-dim);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px -8px rgba(23, 199, 188, 0.4);
}

.form-submit:active:not(:disabled) {
    transform: translateY(0);
}

.form-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Privacy Note */
.privacy-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    font-size: 0.8125rem;
    color: var(--color-text-dim);
    margin: 0;
    padding-top: 0.5rem;
}

.privacy-note svg {
    flex-shrink: 0;
}

.privacy-note a {
    color: var(--color-accent);
    text-decoration: underline;
    text-underline-offset: 2px;
}

.privacy-note a:hover {
    color: var(--color-accent-bright);
}

/* Success State */
.form-success {
    align-items: center;
    justify-content: center;
    text-align: center;
    min-height: 450px;
    padding: 3rem 2.5rem;
}

.success-icon {
    width: 72px;
    height: 72px;
    color: #22C55E;
    margin-bottom: 1.75rem;
}

.form-success h3 {
    font-size: 1.625rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 0.625rem;
}

.form-success p {
    font-size: 1.0625rem;
    color: var(--color-text-muted);
    margin: 0 0 2.5rem;
}

.reset-btn {
    padding: 0.875rem 1.75rem;
    background: var(--color-surface-2);
    border: 1px solid var(--color-border-dim);
    border-radius: 8px;
    color: var(--color-text-muted);
    font-size: 0.9375rem;
    font-weight: 500;
    cursor: pointer;
    transition: border-color 0.2s ease, color 0.2s ease;
}

.reset-btn:hover {
    border-color: var(--color-accent);
    color: var(--color-accent);
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .form-submit:hover {
        transform: none;
        box-shadow: none;
    }
}
</style>
