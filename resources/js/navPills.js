// Only show indicator on these separate pages (not homepage sections)
const SEPARATE_PAGES = {
    '/contact': 'contact',
    '/en/contact': 'contact',
}

let indicatorEl = null
let currentSection = null
let isInitialLoad = true

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

export function initNavPillScrollSpy() {
    // Detect active section from current URL path (only for separate pages)
    const section = detectSectionFromPath()

    // Small delay to ensure nav is rendered properly
    requestAnimationFrame(() => {
        updateNavPillActive(section)
    })

    // Update indicator position on resize
    window.addEventListener('resize', () => {
        requestAnimationFrame(moveIndicator)
    }, { passive: true })
}

export function refreshNavPillScrollSpy() {
    const section = detectSectionFromPath()
    updateNavPillActive(section)
}
