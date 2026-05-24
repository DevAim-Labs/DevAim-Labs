const NAV_SECTION_IDS = ['services', 'process', 'client-work', 'contact', 'faq']

let activeSectionId = null
let indicatorEl = null
let scrollTicking = false

export function updateNavPillActive(sectionId) {
    const pills = document.querySelectorAll('.nav-pill[data-section]')
    if (!pills.length) return

    const isNavSection = sectionId && NAV_SECTION_IDS.includes(sectionId)
    activeSectionId = isNavSection ? sectionId : null

    pills.forEach((pill) => {
        pill.classList.toggle('active', pill.dataset.section === activeSectionId)
    })

    moveIndicator()
}

function moveIndicator() {
    indicatorEl ??= document.querySelector('[data-nav-pill-indicator]')
    if (!indicatorEl) return

    const activePill = activeSectionId
        ? document.querySelector(`.nav-pill[data-section="${activeSectionId}"]`)
        : null

    if (!activePill) {
        indicatorEl.style.opacity = '0'
        return
    }

    const track = indicatorEl.parentElement
    if (!track) return

    const trackRect = track.getBoundingClientRect()
    const pillRect = activePill.getBoundingClientRect()

    indicatorEl.style.opacity = '1'
    indicatorEl.style.width = `${pillRect.width}px`
    indicatorEl.style.height = `${pillRect.height}px`
    indicatorEl.style.transform = `translate(${pillRect.left - trackRect.left}px, ${pillRect.top - trackRect.top}px)`
}

function detectActiveNavSection() {
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

function evaluateNavSection() {
    const id = detectActiveNavSection()

    if (id && id !== activeSectionId) {
        updateNavPillActive(id)
    } else if (!id && activeSectionId) {
        updateNavPillActive(null)
    } else if (id) {
        moveIndicator()
    }
}

function onScrollOrResize() {
    if (scrollTicking) return
    scrollTicking = true
    requestAnimationFrame(() => {
        scrollTicking = false
        evaluateNavSection()
    })
}

export function initNavPillScrollSpy() {
    window.addEventListener('scroll', onScrollOrResize, { passive: true })
    window.addEventListener('resize', onScrollOrResize, { passive: true })
    requestAnimationFrame(evaluateNavSection)
}

export function refreshNavPillScrollSpy() {
    requestAnimationFrame(evaluateNavSection)
}
