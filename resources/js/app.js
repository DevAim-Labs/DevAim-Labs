import { createApp, h } from 'vue'
import NavTransitionCube from './components/NavTransitionCube.vue'
import CustomCursor from './components/ui/CustomCursor.vue'
import ScrollProgress from './components/ui/ScrollProgress.vue'
import LanguageSwitcher from './components/ui/LanguageSwitcher.vue'
import LanguageToggle from './components/ui/LanguageToggle.vue'
import AvailabilityBadge from './components/ui/AvailabilityBadge.vue'
import TextLoop from './components/ui/TextLoop.vue'
import HeroContactForm from './components/HeroContactForm.vue'
import ContactPageForm from './components/ContactPageForm.vue'
import { initHeroAnimation } from './animations.js'
import { initAnalytics } from './analytics.js'
// Theme toggle disabled - dark mode only for now
// import { initThemeToggle } from './theme.js'
import { initNavPillScrollSpy, refreshNavPillScrollSpy } from './navPills.js'
import { initSmoothScroll, scrollTo } from './smoothScroll.js'

function isNearViewport(el) {
    const rect = el.getBoundingClientRect()
    return rect.top < window.innerHeight + 320 && rect.bottom > -320
}

async function mountSection(id, loader) {
    const el = document.getElementById(id)
    if (!el) return

    const { default: Component } = await loader()
    createApp(Component).mount(el)

    refreshNavPillScrollSpy()

    const sectionId = el.dataset.sectionId
    if (sectionId && window.__INITIAL_SECTION__ === sectionId) {
        requestAnimationFrame(() => {
            const target = document.getElementById(sectionId)
            if (target) {
                scrollTo(target, { offset: -80, immediate: true })
            }
        })
    }
}

function mountWhenVisible(id, loader) {
    const el = document.getElementById(id)
    if (!el) return

    const mount = () => mountSection(id, loader)

    if (!('IntersectionObserver' in window) || isNearViewport(el)) {
        mount()
        return
    }

    const observer = new IntersectionObserver((entries) => {
        if (!entries.some((e) => e.isIntersecting)) return
        observer.disconnect()
        mount()
    }, { rootMargin: '320px' })

    observer.observe(el)

    setTimeout(() => {
        if (!el.childElementCount) mount()
    }, 2500)
}

/**
 * Setup smooth scroll for anchor links using Lenis.
 */
function setupAnchorScrolling() {
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', (e) => {
            const href = anchor.getAttribute('href')
            if (!href || href === '#') return

            const target = document.querySelector(href)
            if (target) {
                e.preventDefault()
                scrollTo(target, { offset: -80 })
            }
        })
    })
}

document.addEventListener('DOMContentLoaded', async () => {
    // Initialize Lenis smooth scroll FIRST (before any scrolling operations)
    initSmoothScroll()

    // Setup smooth anchor scrolling
    setupAnchorScrolling()

    // initThemeToggle() // Disabled - dark mode only for now

    await Promise.all([
        mountSection('logo-slider-mount', () => import('./components/LogoSlider.vue')),
        mountSection('services-mount', () => import('./components/ServicesGrid.vue')),
        mountSection('process-mount', () => import('./components/ProcessTimeline.vue')),
        mountSection('pricing-mount', () => import('./components/PricingSection.vue')),
        mountSection('techstack-mount', () => import('./components/TechStack.vue')),
    ])

    mountWhenVisible('client-work-mount', () => import('./components/ClientWork.vue'))
    mountWhenVisible('personal-projects-mount', () => import('./components/PersonalProjects.vue'))
    mountWhenVisible('contact-mount', () => import('./components/ContactForm.vue'))

    // Mount NavTransitionCube
    const navEl = document.getElementById('nav-transition-mount')
    if (navEl) {
        createApp(NavTransitionCube, {
            text:           'DEVAIM',
            primaryColor:   'var(--color-surface)',
            secondaryColor: '#0B8598',
        }).mount(navEl)
    }

    // Mount CustomCursor (desktop only, auto-hides on touch)
    const cursorMount = document.createElement('div')
    cursorMount.id = 'custom-cursor-mount'
    document.body.appendChild(cursorMount)
    createApp(CustomCursor).mount(cursorMount)

    // Mount ScrollProgress bar
    const progressMount = document.createElement('div')
    progressMount.id = 'scroll-progress-mount'
    document.body.appendChild(progressMount)
    createApp(ScrollProgress).mount(progressMount)

    // Mount Language Switcher popup (shows on first visit)
    // Disabled for now — re-enable by uncommenting this block.
    // const langSwitcherMount = document.createElement('div')
    // langSwitcherMount.id = 'language-switcher-mount'
    // document.body.appendChild(langSwitcherMount)
    // createApp({
    //     render: () => h(LanguageSwitcher, { showPopup: true })
    // }).mount(langSwitcherMount)

    // Mount Language Toggle in nav (desktop and mobile)
    const langToggleMount = document.getElementById('lang-toggle-mount')
    if (langToggleMount) {
        createApp(LanguageToggle).mount(langToggleMount)
    }

    const langToggleMountMobile = document.getElementById('lang-toggle-mount-mobile')
    if (langToggleMountMobile) {
        createApp(LanguageToggle).mount(langToggleMountMobile)
    }

    // Mount Hero components
    const heroAvailabilityMount = document.getElementById('hero-availability-mount')
    if (heroAvailabilityMount) {
        createApp({
            render: () => h(AvailabilityBadge, {
                text: heroAvailabilityMount.dataset.text || 'Beschikbaar voor nieuwe projecten'
            })
        }).mount(heroAvailabilityMount)
    }

    const heroTextLoopMount = document.getElementById('hero-text-loop-mount')
    if (heroTextLoopMount) {
        const words = JSON.parse(heroTextLoopMount.dataset.words || '[]')
        createApp({
            render: () => h(TextLoop, {
                words: words,
                interval: 3000,
                gradient: true
            })
        }).mount(heroTextLoopMount)
    }

    const heroContactFormMount = document.getElementById('hero-contact-form-mount')
    if (heroContactFormMount) {
        createApp({
            render: () => h(HeroContactForm, {
                locale: heroContactFormMount.dataset.locale || 'nl'
            })
        }).mount(heroContactFormMount)
    }

    // Mount Contact Page Form (for dedicated /contact page)
    const contactPageFormMount = document.getElementById('contact-page-form-mount')
    if (contactPageFormMount) {
        createApp({
            render: () => h(ContactPageForm, {
                locale: contactPageFormMount.dataset.locale || 'nl'
            })
        }).mount(contactPageFormMount)
    }

    initHeroAnimation()

    import('./scrollReveal.js').then(({ initScrollReveal }) => {
        const run = () => initScrollReveal()
        if ('requestIdleCallback' in window) {
            requestIdleCallback(run, { timeout: 2000 })
        } else {
            setTimeout(run, 300)
        }
    })

    const sections = window.__ANALYTICS_SECTIONS__ || []
    if (sections.length) {
        initAnalytics(sections, window.__INITIAL_SECTION__ || null)
    }

    initNavPillScrollSpy()
})
