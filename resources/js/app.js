import { createApp } from 'vue'
import ContactForm from './components/ContactForm.vue'
import PortfolioGrid from './components/PortfolioGrid.vue'
import NavTransitionCube from './components/NavTransitionCube.vue'
import { initHeroAnimation, initScrollReveal } from './animations.js'

document.addEventListener('DOMContentLoaded', () => {
    const portfolioEl = document.getElementById('portfolio-mount')
    if (portfolioEl) createApp(PortfolioGrid).mount(portfolioEl)

    const contactEl = document.getElementById('contact-mount')
    if (contactEl) createApp(ContactForm).mount(contactEl)

    const navEl = document.getElementById('nav-transition-mount')
    if (navEl) createApp(NavTransitionCube, {
        text:           'DEVAIM',
        primaryColor:   'rgba(8,12,20,0.97)',
        secondaryColor: '#22d3ee',
    }).mount(navEl)

    initHeroAnimation()
    initScrollReveal()
})
