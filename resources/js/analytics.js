/**
 * Section URLs + GA4 (gtag) dataLayer events for the marketing one-pager.
 */

import { isNavTransitionBusy, playNavTransition } from './navTransition.js'
import { updateNavPillActive } from './navPills.js'

let sectionsById = new Map()
let sectionsByPath = new Map()
let lastTrackedId = null
let scrollObserver = null

const URL_SYNC_SOURCES = new Set(['nav_click', 'direct_url', 'popstate'])

function pushDataLayer(payload) {
    window.dataLayer = window.dataLayer || []
    window.dataLayer.push(payload)

    if (typeof window.gtag !== 'function' || !payload.event) return

    const { event, ...params } = payload
    window.gtag('event', event, params)
}

function gtagPageView(section) {
    if (typeof window.gtag !== 'function') return

    const measurementId = window.__GA_MEASUREMENT_ID__
    if (!measurementId) return

    window.gtag('config', measurementId, {
        page_path: section.path,
        page_title: section.title,
        page_location: window.location.origin + section.path,
    })
}

export function trackSectionView(section, source = 'scroll') {
    if (!section) return

    // URL bij menu-klik altijd syncen (ook als scroll al dezelfde sectie "zag")
    if (URL_SYNC_SOURCES.has(source) && section.path && window.location.pathname !== section.path) {
        window.history.replaceState({ sectionId: section.id }, '', section.path)
    }

    if (lastTrackedId === section.id) {
        return
    }

    lastTrackedId = section.id

    pushDataLayer({
        event: 'virtual_page_view',
        page_path: section.path,
        page_title: section.title,
        page_section: section.id,
        page_keywords: section.keywords,
        engagement_source: source,
    })

    gtagPageView(section)

    if (section.title && URL_SYNC_SOURCES.has(source)) {
        document.title = section.title
    }
}

export function trackCtaClick({ label, location, url, type = 'cta_click' }) {
    pushDataLayer({
        event: type,
        click_text: label,
        click_location: location,
        link_url: url || undefined,
    })
}

export function trackFormSubmit(formName) {
    pushDataLayer({
        event: 'form_submit',
        form_name: formName,
    })
}

function scrollToSection(sectionId, behavior = 'smooth') {
    const el = document.getElementById(sectionId)
        ?? document.querySelector(`[data-section-id="${sectionId}"]`)

    if (el) {
        el.scrollIntoView({ behavior, block: 'start' })
    }
}

function sectionFromPath(pathname) {
    return sectionsByPath.get(pathname) || sectionsByPath.get('/')
}

function finishSectionNav(section, link) {
    lastTrackedId = null
    trackSectionView(section, 'nav_click')
    updateNavPillActive(section.id)

    if (link.dataset.trackLabel || link.dataset.trackLocation) {
        trackCtaClick({
            label: link.dataset.trackLabel || link.textContent?.trim() || '',
            location: link.dataset.trackLocation || section.id,
            url: section.path,
        })
    }

    document.getElementById('mobile-menu')?.classList.add('hidden')
}

function handleInPageNavClick(event) {
    const link = event.target.closest('a[href]')
    if (!link || isNavTransitionBusy()) return

    const href = link.getAttribute('href')
    if (!href) return

    let section = null
    let target = null

    if (href.startsWith('#')) {
        if (href === '#') return
        target = document.querySelector(href)
        if (!target?.id) return
        section = sectionsById.get(target.id)
    } else if (href.startsWith('/') && !href.startsWith('//')) {
        const url = new URL(href, window.location.origin)
        if (url.origin !== window.location.origin) return
        section = sectionsByPath.get(url.pathname)
        if (!section) return
        target = document.getElementById(section.id)
            ?? document.querySelector(`[data-section-id="${section.id}"]`)
    }

    if (!section || !target) return

    event.preventDefault()

    const runAfterNav = () => finishSectionNav(section, link)

    if (section.id === 'home' && window.location.pathname === '/') {
        scrollToSection('home', 'smooth')
        runAfterNav()
        return
    }

    playNavTransition(target, runAfterNav)
}

function initScrollTracking() {
    const sectionIds = [...sectionsById.keys()]

    scrollObserver = new IntersectionObserver(
        (entries) => {
            const visible = entries
                .filter((e) => e.isIntersecting)
                .sort((a, b) => b.intersectionRatio - a.intersectionRatio)

            if (!visible.length) return

            const id = visible[0].target.id
            const section = sectionsById.get(id)
            if (section) {
                trackSectionView(section, 'scroll')
            }
        },
        { rootMargin: '-25% 0px -55% 0px', threshold: [0.15, 0.35, 0.55] }
    )

    sectionIds.forEach((id) => {
        const el = document.getElementById(id)
        if (el) scrollObserver.observe(el)
    })
}

function initGlobalClickTracking() {
    document.addEventListener('click', (event) => {
        const tracked = event.target.closest('[data-track]')
        if (!tracked || tracked.classList.contains('nav-pill')) return

        trackCtaClick({
            label: tracked.dataset.trackLabel || tracked.textContent?.trim() || '',
            location: tracked.dataset.trackLocation || 'unknown',
            url: tracked.getAttribute('href') || undefined,
            type: tracked.dataset.track || 'cta_click',
        })
    })
}

export function initAnalytics(sections, initialSectionId = null) {
    sectionsById = new Map(sections.map((s) => [s.id, s]))
    sectionsByPath = new Map(sections.map((s) => [s.path, s]))

    document.addEventListener('click', handleInPageNavClick)
    initGlobalClickTracking()
    initScrollTracking()

    const homeSection = sectionsById.get('home')

    if (initialSectionId) {
        const startSection = sectionsById.get(initialSectionId) || homeSection
        requestAnimationFrame(() => {
            scrollToSection(initialSectionId, 'auto')
            trackSectionView(startSection, 'direct_url')
            updateNavPillActive(initialSectionId)
        })
    } else {
        if ('scrollRestoration' in history) {
            history.scrollRestoration = 'manual'
        }
        window.scrollTo(0, 0)

        lastTrackedId = null
        trackSectionView(homeSection, 'page_load')
    }

    window.addEventListener('popstate', () => {
        const section = sectionFromPath(window.location.pathname)
        if (section) {
            scrollToSection(section.id, 'auto')
            lastTrackedId = null
            trackSectionView(section, 'popstate')
            updateNavPillActive(section.id)
        }
    })
}

export function destroyAnalytics() {
    scrollObserver?.disconnect()
    scrollObserver = null
    lastTrackedId = null
}
