import { gsap } from 'gsap'

let overlay = null
let cube = null
let label = null
let busy = false
let initialized = false

function getElements() {
    const mount = document.getElementById('nav-transition-mount')
    if (!mount) return null
    return {
        overlay: mount.querySelector('[data-nav-overlay]'),
        cube: mount.querySelector('[data-nav-cube]'),
        label: mount.querySelector('[data-nav-label]'),
    }
}

function initCube() {
    const els = getElements()
    if (!els?.cube || !els?.label || initialized) return

    overlay = els.overlay
    cube = els.cube
    label = els.label

    const size = Math.min(window.innerWidth, window.innerHeight) * 0.38
    const half = size / 2
    cube.style.width = `${size}px`
    cube.style.height = `${size}px`

    const transforms = [
        `translateZ(${half}px)`,
        `rotateY(180deg) translateZ(${half}px)`,
        `rotateY(90deg) translateZ(${half}px)`,
        `rotateY(-90deg) translateZ(${half}px)`,
        `rotateX(90deg) translateZ(${half}px)`,
        `rotateX(-90deg) translateZ(${half}px)`,
    ]
    cube.querySelectorAll('[data-nav-face]').forEach((face, i) => {
        face.style.transform = transforms[i]
    })

    gsap.set(cube, { scale: 0, rotateX: 50, rotateY: 45, rotateZ: 15 })
    gsap.set(label, { opacity: 0, scale: 0.75 })

    initialized = true
}

/**
 * Speel de kubus-overgang af, scroll halverwege naar het doel.
 * @param {HTMLElement} target
 * @param {() => void} [onComplete]
 */
export function playNavTransition(target, onComplete) {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        target?.scrollIntoView({ block: 'start' })
        onComplete?.()
        return
    }

    initCube()

    if (!cube || !overlay || !label || !target || busy) {
        target?.scrollIntoView({ block: 'start' })
        onComplete?.()
        return
    }

    busy = true

    const size = parseFloat(cube.style.width) || 200
    const coverScale = (Math.hypot(window.innerWidth, window.innerHeight) / size) * 1.15

    gsap.timeline({
        onComplete: () => {
            busy = false
            onComplete?.()
        },
    })
        .set(overlay, { visibility: 'visible' })
        .to(cube, {
            scale: coverScale,
            rotateX: 0,
            rotateY: 0,
            rotateZ: 0,
            duration: 0.5,
            ease: 'power3.in',
        })
        .to(label, { opacity: 1, scale: 1, duration: 0.22, ease: 'power2.out' }, '-=0.1')
        .add(() => {
            const html = document.documentElement
            html.style.scrollBehavior = 'auto'
            target.scrollIntoView({ block: 'start' })
            requestAnimationFrame(() => {
                html.style.scrollBehavior = ''
            })
        })
        .to({}, { duration: 0.06 })
        .to(label, { opacity: 0, scale: 0.85, duration: 0.15, ease: 'power2.in' })
        .to(cube, {
            scale: 0,
            rotateX: -55,
            rotateY: 55,
            rotateZ: -20,
            duration: 0.52,
            ease: 'power3.out',
        })
        .set(overlay, { visibility: 'hidden' })
        .set(cube, { rotateX: 50, rotateY: 45, rotateZ: 15 })
        .set(label, { opacity: 0, scale: 0.75 })
}

export function isNavTransitionBusy() {
    return busy
}
