import { createApp } from 'vue'
import ContactForm from './components/ContactForm.vue'
import ClientWork from './components/ClientWork.vue'
import PersonalProjects from './components/PersonalProjects.vue'
import NavTransitionCube from './components/NavTransitionCube.vue'
import ServicesGrid from './components/ServicesGrid.vue'
import ProcessTimeline from './components/ProcessTimeline.vue'
import { initHeroAnimation, initScrollReveal } from './animations.js'

document.addEventListener('DOMContentLoaded', () => {
    const servicesEl = document.getElementById('services-mount')
    if (servicesEl) createApp(ServicesGrid).mount(servicesEl)

    const processEl = document.getElementById('process-mount')
    if (processEl) createApp(ProcessTimeline).mount(processEl)

    const clientWorkEl = document.getElementById('client-work-mount')
    if (clientWorkEl) createApp(ClientWork).mount(clientWorkEl)

    const personalEl = document.getElementById('personal-projects-mount')
    if (personalEl) createApp(PersonalProjects).mount(personalEl)

    const contactEl = document.getElementById('contact-mount')
    if (contactEl) createApp(ContactForm).mount(contactEl)

    const navEl = document.getElementById('nav-transition-mount')
    if (navEl) createApp(NavTransitionCube, {
        text:           'DEVAIM',
        primaryColor:   'var(--color-surface)',
        secondaryColor: '#0B8598',
    }).mount(navEl)

    initHeroAnimation()
    initScrollReveal()

    // Pill nav — highlight active section on scroll
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

        ;['services', 'process', 'client-work', 'faq', 'contact'].forEach(id => {
            const el = document.getElementById(id)
            if (el) sectionObserver.observe(el)
        })
    }
})
