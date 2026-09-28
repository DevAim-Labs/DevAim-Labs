// In-page sections tracked while scrolling the homepage
const NAV_SECTION_IDS = ['services', 'process', 'pricing', 'faq']

// Only show indicator on these separate pages (not homepage sections)
const SEPARATE_PAGES = {
    '/contact': 'contact',
    '/en/contact': 'contact',
}

let indicatorEl = null
let currentSection = null
let isInitialLoad = true
let scrollTicking = false

export function updateNavPillActive(sectionId) {
    const pills = document.querySelectorAll('.nav-pill[data-section]')
    if (!pills.length) return

    currentSection = sectionId

    pills.forEach((pill) => {
        pill.classList.toggle('active', pill.dataset.section === currentSection)
    })

    moveIndicator()
}

function moveIndicator() {
    indicatorEl ??= document.querySelector('[data-nav-pill-indicator]')
    if (!indicatorEl) return

    const activePill = currentSection
        ? document.querySelector(`.nav-pill[data-section="${currentSection}"]`)
        : null

    if (!activePill) {
        indicatorEl.style.opacity = '0'
        return
    }

    const track = indicatorEl.parentElement
    if (!track) return

    const trackRect = track.getBoundingClientRect()
    const pillRect = activePill.getBoundingClientRect()

    // On initial load with a separate page, add a nice entrance animation
    if (isInitialLoad && currentSection) {
        isInitialLoad = false
        // Start from slightly scaled down and transparent
        indicatorEl.style.transition = 'none'
        indicatorEl.style.opacity = '0'
        indicatorEl.style.transform = `translate(${pillRect.left - trackRect.left}px, ${pillRect.top - trackRect.top}px) scale(0.9)`
        indicatorEl.style.width = `${pillRect.width}px`
        indicatorEl.style.height = `${pillRect.height}px`

        // Force reflow then animate in
        indicatorEl.offsetHeight
        indicatorEl.style.transition = ''
        requestAnimationFrame(() => {
            indicatorEl.style.opacity = '1'
            indicatorEl.style.transform = `translate(${pillRect.left - trackRect.left}px, ${pillRect.top - trackRect.top}px) scale(1)`
        })
        return
    }

    isInitialLoad = false
    indicatorEl.style.opacity = '1'
    indicatorEl.style.width = `${pillRect.width}px`
    indicatorEl.style.height = `${pillRect.height}px`
    indicatorEl.style.transform = `translate(${pillRect.left - trackRect.left}px, ${pillRect.top - trackRect.top}px)`
}

function detectSectionFromPath() {
    const path = window.location.pathname
    // Only return a section if we're on an actual separate page
    return SEPARATE_PAGES[path] || null
}

function detectActiveScrollSection() {
    let bestId = null
    let bestScore = -Infinity
    const line = window.innerHeight * 0.32

    for (const id of NAV_SECTION_IDS) {
        const el = document.getElementById(id)
        if (!el) continue

        const rect = el.getBoundingClientRect()
        if (rect.bottom < 0 || rect.top > window.innerHeight) continue

        const visible = Math.min(rect.bottom, window.innerHeight) - Math.max(rect.top, 0)
        const score = visible - Math.abs(rect.top - line) * 0.5

        if (score > bestScore) {
            bestScore = score
            bestId = id
        }
    }

    return bestId
}

function evaluateScrollSection() {
    const id = detectActiveScrollSection()

    if (id !== currentSection) {
        updateNavPillActive(id)
    } else if (id) {
        moveIndicator()
    }
}

function onScrollOrResize() {
    if (scrollTicking) return
    scrollTicking = true
    requestAnimationFrame(() => {
        scrollTicking = false
        evaluateScrollSection()
    })
}

export function initNavPillScrollSpy() {
    // Separate pages (e.g. /contact) have no in-page sections to spy on;
    // just highlight the matching pill statically from the URL.
    const pathSection = detectSectionFromPath()
    if (pathSection) {
        requestAnimationFrame(() => {
            updateNavPillActive(pathSection)
        })
        window.addEventListener('resize', () => {
            requestAnimationFrame(moveIndicator)
        }, { passive: true })
        return
    }

    // Homepage: track which in-page section is active while scrolling.
    window.addEventListener('scroll', onScrollOrResize, { passive: true })
    window.addEventListener('resize', onScrollOrResize, { passive: true })
    requestAnimationFrame(evaluateScrollSection)
}

export function refreshNavPillScrollSpy() {
    const pathSection = detectSectionFromPath()
    if (pathSection) {
        updateNavPillActive(pathSection)
        return
    }
    requestAnimationFrame(evaluateScrollSection)
}
