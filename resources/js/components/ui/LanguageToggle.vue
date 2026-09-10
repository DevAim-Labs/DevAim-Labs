<script setup>
import { ref, onMounted } from 'vue'

const currentLang = ref('nl')
const isOpen = ref(false)
const rootEl = ref(null)

const languages = [
    { code: 'nl', label: 'NL', fullLabel: 'Nederlands' },
    { code: 'en', label: 'EN', fullLabel: 'English' }
]

function selectLanguage(lang) {
    currentLang.value = lang
    localStorage.setItem('preferred-language', lang)
    localStorage.setItem('language-popup-seen', 'true')
    isOpen.value = false

    // Map Dutch slugs to English and vice versa
    const slugMap = {
        'nl-to-en': {
            '/': '/en',
            '/over-ons': '/en/about',
            '/diensten': '/en/services',
            '/werkwijze': '/en/process',
            '/klantwerk': '/en/work',
            '/projecten': '/en/projects',
            '/veelgestelde-vragen': '/en/faq',
            '/contact': '/en/contact',
        },
        'en-to-nl': {
            '/en': '/',
            '/en/about': '/over-ons',
            '/en/services': '/diensten',
            '/en/process': '/werkwijze',
            '/en/work': '/klantwerk',
            '/en/projects': '/projecten',
            '/en/faq': '/veelgestelde-vragen',
            '/en/contact': '/contact',
        }
    }

    const currentPath = window.location.pathname
    const isCurrentlyEnglish = currentPath.startsWith('/en')

    if (lang === 'en' && !isCurrentlyEnglish) {
        const newPath = slugMap['nl-to-en'][currentPath] || '/en'
        window.location.href = newPath
    } else if (lang === 'nl' && isCurrentlyEnglish) {
        const newPath = slugMap['en-to-nl'][currentPath] || '/'
        window.location.href = newPath
    }
}

function toggleDropdown() {
    isOpen.value = !isOpen.value
}

function closeDropdown() {
    isOpen.value = false
}

onMounted(() => {
    const storedLang = localStorage.getItem('preferred-language')
    if (storedLang) {
        currentLang.value = storedLang
    } else {
        // Detect from URL or browser
        if (window.location.pathname.startsWith('/en')) {
            currentLang.value = 'en'
        }
    }

    // Close on outside click — scoped to this instance's own root element,
    // since the toggle is mounted twice on the page (desktop + mobile) and
    // a global `.lang-toggle` query would always match the first one.
    document.addEventListener('click', (e) => {
        if (rootEl.value && !rootEl.value.contains(e.target)) {
            isOpen.value = false
        }
    })
})

const currentLanguage = () => languages.find(l => l.code === currentLang.value)
</script>

<template>
    <div class="lang-toggle relative" ref="rootEl">
        <!-- Toggle button -->
        <button
            @click="toggleDropdown"
            class="flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg text-xs font-medium transition-all duration-200"
            style="background: var(--color-surface-2); border: 1px solid var(--color-border-dim); color: var(--color-text-muted);"
            :style="isOpen ? 'border-color: var(--color-accent); color: var(--color-text);' : ''"
            aria-label="Taal wisselen"
            aria-haspopup="listbox"
            :aria-expanded="isOpen"
        >
            <span>{{ currentLanguage()?.label }}</span>
            <svg
                class="w-3 h-3 transition-transform duration-200"
                :class="{ 'rotate-180': isOpen }"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
            >
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <!-- Dropdown -->
        <Transition name="dropdown">
            <div
                v-if="isOpen"
                class="absolute top-full right-0 mt-2 py-1 rounded-lg shadow-xl z-50 min-w-[140px]"
                style="background: var(--color-surface-1); border: 1px solid var(--color-border-dim);"
            >
                <button
                    v-for="lang in languages"
                    :key="lang.code"
                    @click="selectLanguage(lang.code)"
                    class="w-full flex items-center gap-3 px-3 py-2 text-left text-sm transition-colors duration-150"
                    style="color: var(--color-text); background: transparent;"
                    @mouseover="$event.target.style.background = 'var(--color-surface-2)'"
                    @mouseleave="$event.target.style.background = 'transparent'"
                >
                    <span class="font-medium">{{ lang.fullLabel }}</span>
                    <svg
                        v-if="currentLang === lang.code"
                        class="w-4 h-4 ml-auto"
                        style="color: var(--color-accent);"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
        </Transition>
    </div>
</template>

<style scoped>
.dropdown-enter-active,
.dropdown-leave-active {
    transition: opacity 0.15s ease, transform 0.15s ease;
}

.dropdown-enter-from,
.dropdown-leave-to {
    opacity: 0;
    transform: translateY(-4px) scale(0.95);
}

@media (prefers-reduced-motion: reduce) {
    .dropdown-enter-active,
    .dropdown-leave-active {
        transition: none;
    }
}
</style>
