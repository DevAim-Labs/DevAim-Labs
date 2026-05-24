import { createApp } from 'vue'
import NavTransitionCube from './components/NavTransitionCube.vue'
import { initHeroAnimation } from './animations.js'
import { initAnalytics } from './analytics.js'

function mountWhenVisible(id, loader) {
    const el = document.getElementById(id)
    if (!el) return

    const mount = async () => {
        const { default: Component } = await loader()
        createApp(Component).mount(el)
    }

    if (!('IntersectionObserver' in window)) {
        mount()
        return
    }

    const observer = new IntersectionObserver((entries) => {
        if (!entries.some((e) => e.isIntersecting)) return
        observer.disconnect()
        mount()
    }, { rootMargin: '240px' })

    observer.observe(el)
}

document.addEventListener('DOMContentLoaded', () => {
    mountWhenVisible('services-mount', () => import('./components/ServicesGrid.vue'))
    mountWhenVisible('process-mount', () => import('./components/ProcessTimeline.vue'))
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

    const navPills = document.querySelectorAll('.nav-pill[data-section]')
    if (navPills.length) {
        const sectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    navPills.forEach(pill =>
                        pill.classList.toggle('active', pill.dataset.section === entry.target.id)
                    )
                }
            })
        }, { rootMargin: '-20% 0px -60% 0px' })

        ;['home', 'about', 'services', 'process', 'client-work', 'personal-projects', 'faq', 'contact'].forEach(id => {
            const el = document.getElementById(id)
            if (el) sectionObserver.observe(el)
        })
    }
})
