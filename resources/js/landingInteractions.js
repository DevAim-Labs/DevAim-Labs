import { gsap } from './animations/gsap-config.js'
import { ScrollTrigger } from 'gsap/ScrollTrigger'

gsap.registerPlugin(ScrollTrigger)

/**
 * Small, framework-free enhancements for the server-rendered "Blueprint
 * Cyan" page partials (resources/views/partials/landing/*.blade.php).
 * Deliberately vanilla JS, not Vue islands — these are simple DOM toggles
 * and a scroll-scrubbed line, not stateful UI that benefits from a
 * component. No-ops safely wherever an element isn't on the page.
 */
export function initLandingInteractions() {
    initNavScrollState()
    initMobileMenu()
    initMarqueePause()
    initWorkflowLine()
}

function initNavScrollState() {
    const nav = document.getElementById('site-nav')
    if (!nav) return

    let ticking = false
    const update = () => {
        ticking = false
        nav.classList.toggle('is-scrolled', window.scrollY > 12)
    }
    update()
    window.addEventListener(
        'scroll',
        () => {
            if (ticking) return
            ticking = true
            requestAnimationFrame(update)
        },
        { passive: true }
    )
}

function initMobileMenu() {
    const toggle = document.getElementById('nav-menu-toggle')
    const menu = document.getElementById('mobile-menu')
    if (!toggle || !menu) return

    const close = () => {
        menu.hidden = true
        toggle.setAttribute('aria-expanded', 'false')
    }
    const open = () => {
        menu.hidden = false
        toggle.setAttribute('aria-expanded', 'true')
    }

    toggle.addEventListener('click', () => {
        if (menu.hidden) open()
        else close()
    })
    menu.querySelectorAll('a').forEach((a) => a.addEventListener('click', close))
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && !menu.hidden) close()
    })
}

function initMarqueePause() {
    const button = document.getElementById('marquee-pause-toggle')
    const track = document.getElementById('clients-marquee-track')
    const container = document.getElementById('clients-marquee')
    if (!button || !track) return

    let paused = false
    const apply = () => {
        track.classList.toggle('paused', paused)
        button.setAttribute('aria-pressed', paused ? 'true' : 'false')
        button.setAttribute('aria-label', paused ? 'Hervat logo-animatie' : 'Pauzeer logo-animatie')
        button.querySelector('[data-icon-pause]').hidden = paused
        button.querySelector('[data-icon-play]').hidden = !paused
    }

    button.addEventListener('click', () => {
        paused = !paused
        apply()
    })

    // WCAG 2.2.2: also pause on hover/focus, independent of the manual toggle.
    container?.addEventListener('mouseenter', () => track.classList.add('paused'))
    container?.addEventListener('mouseleave', () => track.classList.toggle('paused', paused))
    container?.addEventListener('focusin', () => track.classList.add('paused'))
    container?.addEventListener('focusout', () => track.classList.toggle('paused', paused))
}

function initWorkflowLine() {
    const root = document.querySelector('[data-workflow-line-root]')
    const line = document.querySelector('[data-workflow-line]')
    if (!root || !line) return

    const mm = gsap.matchMedia()
    mm.add('(prefers-reduced-motion: no-preference)', () => {
        const tween = gsap.to(line, {
            scaleY: 1,
            ease: 'none',
            scrollTrigger: {
                trigger: root,
                start: 'top 70%',
                end: 'bottom 60%',
                scrub: 0.5,
            },
        })
        return () => tween.kill()
    })
}
