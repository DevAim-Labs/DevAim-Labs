import { createApp } from 'vue'
import ContactForm from './components/ContactForm.vue'
import PortfolioGrid from './components/PortfolioGrid.vue'
import { initHeroAnimation, initScrollReveal } from './animations.js'

document.addEventListener('DOMContentLoaded', () => {
    const portfolioEl = document.getElementById('portfolio-mount')
    if (portfolioEl) createApp(PortfolioGrid).mount(portfolioEl)

    const contactEl = document.getElementById('contact-mount')
    if (contactEl) createApp(ContactForm).mount(contactEl)

    initHeroAnimation()
    initScrollReveal()
})
