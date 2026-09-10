<script setup>
import { ref, onMounted, watch } from 'vue'

const props = defineProps({
    showPopup: {
        type: Boolean,
        default: false
    }
})

const emit = defineEmits(['close', 'language-changed'])

const isOpen = ref(false)
const currentLang = ref('nl')
const hasSeenPopup = ref(false)

const languages = [
    { code: 'nl', label: 'Nederlands', flag: '🇳🇱' },
    { code: 'en', label: 'English', flag: '🇬🇧' }
]

function selectLanguage(lang) {
    currentLang.value = lang
    localStorage.setItem('preferred-language', lang)
    localStorage.setItem('language-popup-seen', 'true')
    hasSeenPopup.value = true
    isOpen.value = false
    emit('language-changed', lang)
    emit('close')

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

function closePopup() {
    localStorage.setItem('language-popup-seen', 'true')
    hasSeenPopup.value = true
    isOpen.value = false
    emit('close')
}

onMounted(() => {
    // Check stored preference
    const storedLang = localStorage.getItem('preferred-language')
    const popupSeen = localStorage.getItem('language-popup-seen')

    if (storedLang) {
        currentLang.value = storedLang
    } else {
        // Detect from browser
        const browserLang = navigator.language?.substring(0, 2)
        currentLang.value = browserLang === 'nl' ? 'nl' : 'en'
    }

    hasSeenPopup.value = popupSeen === 'true'

    // Show popup on first visit
    if (!popupSeen && props.showPopup) {
        setTimeout(() => {
            isOpen.value = true
        }, 1500) // Delay for better UX
    }
})

watch(() => props.showPopup, (val) => {
    if (val && !hasSeenPopup.value) {
        isOpen.value = true
    }
})

// Expose for nav toggle
defineExpose({ currentLang, languages, selectLanguage })
</script>

<template>
    <!-- First-visit popup -->
    <Teleport to="body">
        <Transition name="fade">
            <div
                v-if="isOpen"
                class="fixed inset-0 z-[100] flex items-center justify-center p-4"
                @click.self="closePopup"
            >
                <!-- Backdrop -->
                <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="closePopup"></div>

                <!-- Modal -->
                <div
                    class="relative z-10 w-full max-w-sm overflow-hidden rounded-2xl shadow-2xl"
                    style="background: var(--color-surface-1); border: 1px solid var(--color-border-dim);"
                >
                    <!-- Header -->
                    <div class="px-6 pt-6 pb-4 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 mb-4 rounded-full" style="background: var(--color-accent-glow);">
                            <svg class="w-6 h-6" style="color: var(--color-accent);" viewBox="0 -960 960 960" fill="currentColor">
                                <path d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-82q26-36 45-75t31-83H404q12 44 31 83t45 75Zm-104-16q-18-33-31.5-68.5T322-320H204q29 50 72.5 87t99.5 55Zm208 0q56-18 99.5-55t72.5-87H638q-9 38-22.5 73.5T584-178ZM170-400h136q-3-20-4.5-39.5T300-480q0-21 1.5-40.5T306-560H170q-5 20-7.5 39.5T160-480q0 21 2.5 40.5T170-400Zm216 0h188q3-20 4.5-39.5T580-480q0-21-1.5-40.5T574-560H386q-3 20-4.5 39.5T380-480q0 21 1.5 40.5T386-400Zm268 0h136q5-20 7.5-39.5T800-480q0-21-2.5-40.5T790-560H654q3 20 4.5 39.5T660-480q0 21-1.5 40.5T654-400Zm-16-240h118q-29-50-72.5-87T584-782q18 33 31.5 68.5T638-640Zm-234 0h152q-12-44-31-83t-45-75q-26 36-45 75t-31 83Zm-200 0h118q9-38 22.5-73.5T376-782q-56 18-99.5 55T204-640Z"/>
                            </svg>
                        </div>
                        <h2 class="text-lg font-semibold mb-1" style="color: var(--color-text);">
                            Kies je taal / Choose language
                        </h2>
                        <p class="text-sm" style="color: var(--color-text-muted);">
                            Selecteer je voorkeurstaal
                        </p>
                    </div>

                    <!-- Language options -->
                    <div class="px-6 pb-6 space-y-2">
                        <button
                            v-for="lang in languages"
                            :key="lang.code"
                            @click="selectLanguage(lang.code)"
                            class="w-full flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group"
                            :style="{
                                background: currentLang === lang.code ? 'var(--color-accent-glow)' : 'var(--color-surface-2)',
                                border: currentLang === lang.code ? '1px solid var(--color-accent)' : '1px solid var(--color-border-dim)'
                            }"
                        >
                            <span class="text-2xl">{{ lang.flag }}</span>
                            <span
                                class="font-medium text-sm"
                                :style="{ color: currentLang === lang.code ? 'var(--color-accent)' : 'var(--color-text)' }"
                            >
                                {{ lang.label }}
                            </span>
                            <svg
                                v-if="currentLang === lang.code"
                                class="w-5 h-5 ml-auto"
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

                    <!-- Footer -->
                    <div
                        class="px-6 py-4 text-center border-t"
                        style="border-color: var(--color-border-dim); background: var(--color-surface-2);"
                    >
                        <button
                            @click="closePopup"
                            class="text-xs transition-colors duration-200"
                            style="color: var(--color-text-muted);"
                            @mouseover="$event.target.style.color = 'var(--color-text)'"
                            @mouseleave="$event.target.style.color = 'var(--color-text-muted)'"
                        >
                            Later kiezen
                        </button>
                    </div>
                </div>
            </div>
        </Transition>
    </Teleport>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-active > div:last-child,
.fade-leave-active > div:last-child {
    transition: transform 0.3s ease, opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-from > div:last-child,
.fade-leave-to > div:last-child {
    transform: scale(0.95) translateY(10px);
    opacity: 0;
}

@media (prefers-reduced-motion: reduce) {
    .fade-enter-active,
    .fade-leave-active,
    .fade-enter-active > div:last-child,
    .fade-leave-active > div:last-child {
        transition: none;
    }
}
</style>
