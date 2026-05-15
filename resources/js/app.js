import { createApp } from 'vue'
import ContactForm from './components/ContactForm.vue'
import ClientWork from './components/ClientWork.vue'
import PersonalProjects from './components/PersonalProjects.vue'
import NavTransitionCube from './components/NavTransitionCube.vue'
import { initHeroAnimation, initScrollReveal } from './animations.js'

document.addEventListener('DOMContentLoaded', () => {
    const clientWorkEl = document.getElementById('client-work-mount')
    if (clientWorkEl) createApp(ClientWork).mount(clientWorkEl)

    const personalEl = document.getElementById('personal-projects-mount')
    if (personalEl) createApp(PersonalProjects).mount(personalEl)

    const contactEl = document.getElementById('contact-mount')
    if (contactEl) createApp(ContactForm).mount(contactEl)

    const navEl = document.getElementById('nav-transition-mount')
    if (navEl) createApp(NavTransitionCube, {
        text:           'DEVAIM',
        primaryColor:   'rgba(8,12,20,0.97)',
        secondaryColor: '#0B8598',
    }).mount(navEl)

    initHeroAnimation()
    initScrollReveal()
})
