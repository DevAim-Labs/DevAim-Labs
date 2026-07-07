import { createApp } from 'vue'
import NavTransitionCube from './components/NavTransitionCube.vue'
import { initHeroAnimation } from './animations.js'
import { initAnalytics } from './analytics.js'
import { initThemeToggle } from './theme.js'
import { initNavPillScrollSpy, refreshNavPillScrollSpy } from './navPills.js'

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
            document.getElementById(sectionId)?.scrollIntoView({ block: 'start' })
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

document.addEventListener('DOMContentLoaded', async () => {
    initThemeToggle()

    await Promise.all([
        mountSection('services-mount', () => import('./components/ServicesGrid.vue')),
        mountSection('process-mount', () => import('./components/ProcessTimeline.vue')),
    ])

    mountWhenVisible('client-work-mount', () => import('./components/ClientWork.vue'))
    mountWhenVisible('personal-projects-mount', () => import('./components/PersonalProjects.vue'))
    mountWhenVisible('contact-mount', () => import('./components/ContactForm.vue'))

    const navEl = document.getElementById('nav-transition-mount')
    if (navEl) {
        createApp(NavTransitionCube, {
            text:           'DEVAIM',
            primaryColor:   'var(--color-surface)',
            secondaryColor: '#0B8598',
        }).mount(navEl)
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
