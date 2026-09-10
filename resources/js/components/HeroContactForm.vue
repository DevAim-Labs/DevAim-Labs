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
    title: isEn ? 'Start your project' : 'Start je project',
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
    message: isEn ? 'Tell me about your project' : 'Vertel me over je project',
    messagePlaceholder: isEn ? 'Briefly describe your idea, goals, or questions...' : 'Beschrijf kort je idee, doelen of vragen...',
    submit: isEn ? 'Get in touch' : 'Neem contact op',
    sending: isEn ? 'Sending...' : 'Versturen...',
    success: isEn ? 'Message sent!' : 'Bericht verzonden!',
    successSub: isEn ? "I'll get back to you within 24 hours." : 'Ik neem binnen 24 uur contact op.',
    error: isEn ? 'Something went wrong. Try again.' : 'Er ging iets mis. Probeer opnieuw.',
    orSchedule: isEn ? 'Or schedule a call' : 'Of plan een gesprek',
}))

const maxChars = 250

const form = ref({
    name: '',
    company: '',
    email: '',
    projectType: '',
    message: ''
})

const charCount = computed(() => form.value.message.length)
const charsRemaining = computed(() => maxChars - charCount.value)
const isOverLimit = computed(() => charCount.value > maxChars)

const isSubmitting = ref(false)
const isSuccess = ref(false)
const errorMsg = ref('')

async function submitForm() {
    if (isSubmitting.value || isOverLimit.value) return

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
                message: `Bedrijf: ${form.value.company}\nType project: ${form.value.projectType}\n\n${form.value.message}`
            })
        })

        if (response.ok) {
            isSuccess.value = true
            form.value = { name: '', company: '', email: '', projectType: '', message: '' }
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
</script>

<template>
    <div class="hero-form-card">
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
            <svg class="success-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
            <h3>{{ t.success }}</h3>
            <p>{{ t.successSub }}</p>
        </div>

        <!-- Form -->
        <form v-else class="form-body" @submit.prevent="submitForm">
            <!-- Name -->
            <div class="form-field">
                <label for="hero-name">{{ t.name }} <span class="required">*</span></label>
                <input
                    id="hero-name"
                    v-model="form.name"
                    type="text"
                    :placeholder="t.namePlaceholder"
                    required
                >
            </div>

            <!-- Company -->
            <div class="form-field">
                <label for="hero-company">{{ t.company }} <span class="required">*</span></label>
                <input
                    id="hero-company"
                    v-model="form.company"
                    type="text"
                    :placeholder="t.companyPlaceholder"
                    required
                >
            </div>

            <!-- Email -->
            <div class="form-field">
                <label for="hero-email">{{ t.email }} <span class="required">*</span></label>
                <input
                    id="hero-email"
                    v-model="form.email"
                    type="email"
                    :placeholder="t.emailPlaceholder"
                    required
                >
            </div>

            <!-- Project Type -->
            <div class="form-field">
                <label for="hero-project-type">{{ t.projectType }} <span class="required">*</span></label>
                <select id="hero-project-type" v-model="form.projectType" required>
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

            <!-- Message textarea -->
            <div class="form-field">
                <label for="hero-message">{{ t.message }}</label>
                <div class="textarea-wrapper">
                    <textarea
                        id="hero-message"
                        v-model="form.message"
                        :placeholder="t.messagePlaceholder"
                        rows="3"
                        :class="{ 'is-over-limit': isOverLimit }"
                    ></textarea>
                    <div class="char-counter" :class="{ 'is-warning': charsRemaining <= 30, 'is-over': isOverLimit }">
                        {{ charCount }}/{{ maxChars }}
                    </div>
                </div>
            </div>

            <!-- Error -->
            <p v-if="errorMsg" class="form-error">{{ errorMsg }}</p>

            <!-- Submit -->
            <button type="submit" class="form-submit" :disabled="isSubmitting || isOverLimit">
                {{ isSubmitting ? t.sending : t.submit }}
                <svg v-if="!isSubmitting" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </button>

            <!-- Cal.com link -->
            <a href="https://cal.com/devaim/kennismaking" target="_blank" rel="noopener noreferrer" class="form-schedule">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ t.orSchedule }}
            </a>
        </form>
    </div>
</template>

<style scoped>
.hero-form-card {
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-dim);
    border-radius: 12px;
    overflow: hidden;
}

/* Header */
.form-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1.25rem;
    background: var(--color-surface-2);
    border-bottom: 1px solid var(--color-border-dim);
}

.header-dots {
    display: flex;
    gap: 6px;
}

.header-dots span {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: var(--color-border);
}

.header-dots span:nth-child(1) { background: #EF4444; }
.header-dots span:nth-child(2) { background: #F59E0B; }
.header-dots span:nth-child(3) { background: #22C55E; }

.header-title {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--color-text-muted);
}

/* Body */
.form-body {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1.125rem;
}

/* Fields */
.form-field {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    text-align: left;
}

.form-field label {
    font-size: 0.8125rem;
    font-weight: 500;
    color: var(--color-text-muted);
}

.form-field .required {
    color: var(--color-accent);
}

.form-field input,
.form-field select {
    width: 100%;
    padding: 0.75rem 1rem;
    background: var(--color-surface);
    border: 1px solid var(--color-border-dim);
    border-radius: 6px;
    color: var(--color-text);
    font-size: 0.9375rem;
    transition: border-color 0.2s ease;
}

.form-field input::placeholder {
    color: var(--color-text-dim);
}

.form-field input:hover,
.form-field select:hover {
    border-color: var(--color-border);
}

.form-field input:focus,
.form-field select:focus {
    outline: none;
    border-color: var(--color-accent);
}

.form-field select {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2371717A' stroke-width='2'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1rem;
    padding-right: 2.5rem;
}

/* Textarea */
.textarea-wrapper {
    position: relative;
}

.form-field textarea {
    width: 100%;
    padding: 0.75rem 1rem;
    padding-bottom: 1.75rem;
    background: var(--color-surface);
    border: 1px solid var(--color-border-dim);
    border-radius: 6px;
    color: var(--color-text);
    font-size: 0.9375rem;
    font-family: inherit;
    resize: vertical;
    min-height: 80px;
    transition: border-color 0.2s ease;
}

.form-field textarea::placeholder {
    color: var(--color-text-dim);
}

.form-field textarea:hover {
    border-color: var(--color-border);
}

.form-field textarea:focus {
    outline: none;
    border-color: var(--color-accent);
}

.form-field textarea.is-over-limit {
    border-color: #EF4444;
}

.form-field textarea.is-over-limit:focus {
    border-color: #EF4444;
}

/* Character counter */
.char-counter {
    position: absolute;
    bottom: 0.5rem;
    right: 0.75rem;
    font-size: 0.6875rem;
    font-family: var(--font-mono, monospace);
    color: var(--color-text-dim);
    pointer-events: none;
    transition: color 0.2s ease;
}

.char-counter.is-warning {
    color: var(--color-warm);
}

.char-counter.is-over {
    color: #EF4444;
    font-weight: 600;
}

/* Error */
.form-error {
    font-size: 0.8125rem;
    color: #EF4444;
    margin: 0;
}

/* Submit */
.form-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    width: 100%;
    padding: 0.875rem 1.5rem;
    background: var(--color-accent);
    color: var(--color-on-accent);
    border: none;
    border-radius: 8px;
    font-size: 0.9375rem;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s ease, transform 0.15s ease;
}

.form-submit:hover:not(:disabled) {
    background: var(--color-accent-dim);
    transform: translateY(-1px);
}

.form-submit:active:not(:disabled) {
    transform: translateY(0);
}

.form-submit:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Schedule link */
.form-schedule {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem;
    background: var(--color-surface);
    border: 1px solid var(--color-border-dim);
    border-radius: 6px;
    font-size: 0.8125rem;
    font-weight: 500;
    color: var(--color-text-muted);
    text-decoration: none;
    transition: border-color 0.2s ease, color 0.2s ease;
}

.form-schedule:hover {
    border-color: var(--color-border);
    color: var(--color-text);
}

.form-schedule svg {
    color: var(--color-violet);
}

/* Success state */
.form-success {
    align-items: center;
    justify-content: center;
    text-align: center;
    min-height: 280px;
}

.success-icon {
    width: 48px;
    height: 48px;
    color: #22C55E;
    margin-bottom: 1rem;
}

.form-success h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--color-text);
    margin: 0 0 0.25rem;
}

.form-success p {
    font-size: 0.875rem;
    color: var(--color-text-muted);
    margin: 0;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    .form-submit:hover {
        transform: none;
    }
}
</style>
