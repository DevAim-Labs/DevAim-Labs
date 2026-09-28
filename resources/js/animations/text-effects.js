import { gsap, ScrollTrigger, EASE, DURATION, prefersReducedMotion } from './gsap-config'

// Characters used for scramble effect
const SCRAMBLE_CHARS = '!<>-_\\/[]{}—=+*^?#________'

/**
 * Text scramble/decode effect
 * Reveals text character by character with random character cycling
 */
export function textScramble(element, options = {}) {
    if (prefersReducedMotion()) {
        element.style.opacity = '1'
        return
    }

    const {
        duration = 1.5,
        stagger = 0.02,
        scrambleSpeed = 30,
        revealDelay = 0,
    } = options

    const text = element.textContent
    const chars = text.split('')
    element.textContent = ''
    element.style.opacity = '1'

    // Create spans for each character
    const spans = chars.map(char => {
        const span = document.createElement('span')
        span.textContent = char === ' ' ? '\u00A0' : char
        span.dataset.final = char
        span.style.opacity = '0'
        element.appendChild(span)
        return span
    })

    // Animate each character
    spans.forEach((span, i) => {
        const delay = revealDelay + (i * stagger)
        const finalChar = span.dataset.final

        if (finalChar === ' ') {
            gsap.to(span, { opacity: 1, duration: 0.1, delay })
            return
        }

        let frame = 0
        const totalFrames = Math.floor(duration * scrambleSpeed)

        const scrambleInterval = setInterval(() => {
            if (frame >= totalFrames) {
                clearInterval(scrambleInterval)
                span.textContent = finalChar
                return
            }

            const progress = frame / totalFrames
            if (progress > 0.7 + (Math.random() * 0.3)) {
                clearInterval(scrambleInterval)
                span.textContent = finalChar
                return
            }

            span.textContent = SCRAMBLE_CHARS[Math.floor(Math.random() * SCRAMBLE_CHARS.length)]
            frame++
        }, 1000 / scrambleSpeed)

        gsap.to(span, {
            opacity: 1,
            duration: 0.1,
            delay,
        })
    })
}

/**
 * Split text into words/characters for animation
 */
export function splitText(element, type = 'words') {
    const text = element.textContent.trim()
    element.textContent = ''
    element.style.opacity = '1'

    if (type === 'chars') {
        return text.split('').map(char => {
            const span = document.createElement('span')
            span.className = 'inline-block'
            span.textContent = char === ' ' ? '\u00A0' : char
            element.appendChild(span)
            return span
        })
    }

    // Words
    return text.split(' ').map((word, i, arr) => {
        const wrapper = document.createElement('span')
        wrapper.className = 'inline-block overflow-hidden'

        const inner = document.createElement('span')
        inner.className = 'inline-block'
        inner.textContent = word

        wrapper.appendChild(inner)
        element.appendChild(wrapper)

        if (i < arr.length - 1) {
            element.appendChild(document.createTextNode(' '))
        }

        return inner
    })
}

/**
 * Word-by-word reveal animation
 */
export function wordReveal(element, options = {}) {
    if (prefersReducedMotion()) {
        element.style.opacity = '1'
        return
    }

    const {
        duration = DURATION.normal,
        stagger = 0.08,
        y = 40,
        trigger = null,
    } = options

    const words = splitText(element, 'words')

    const animationConfig = {
        y: 0,
        opacity: 1,
        duration,
        stagger,
        ease: EASE.smooth,
    }

    if (trigger) {
        animationConfig.scrollTrigger = {
            trigger: trigger || element,
            start: 'top 80%',
        }
    }

    gsap.set(words, { y, opacity: 0 })
    return gsap.to(words, animationConfig)
}

/**
 * Character reveal animation
 */
export function charReveal(element, options = {}) {
    if (prefersReducedMotion()) {
        element.style.opacity = '1'
        return
    }

    const {
        duration = DURATION.fast,
        stagger = 0.02,
        y = 20,
        trigger = null,
    } = options

    const chars = splitText(element, 'chars')

    const animationConfig = {
        y: 0,
        opacity: 1,
        duration,
        stagger,
        ease: EASE.bounce,
    }

    if (trigger) {
        animationConfig.scrollTrigger = {
            trigger: trigger || element,
            start: 'top 80%',
        }
    }

    gsap.set(chars, { y, opacity: 0 })
    return gsap.to(chars, animationConfig)
}

/**
 * Typewriter effect
 */
export function typewriter(element, options = {}) {
    if (prefersReducedMotion()) {
        element.style.opacity = '1'
        return
    }

    const {
        speed = 50,
        delay = 0,
        cursor = true,
    } = options

    const text = element.textContent
    element.textContent = ''
    element.style.opacity = '1'

    if (cursor) {
        const cursorSpan = document.createElement('span')
        cursorSpan.className = 'typewriter-cursor'
        cursorSpan.textContent = '|'
        cursorSpan.style.animation = 'blink 1s step-end infinite'
        element.appendChild(cursorSpan)
    }

    let i = 0
    const cursorEl = element.querySelector('.typewriter-cursor')

    setTimeout(() => {
        const interval = setInterval(() => {
            if (i < text.length) {
                const char = document.createTextNode(text[i])
                if (cursorEl) {
                    element.insertBefore(char, cursorEl)
                } else {
                    element.appendChild(char)
                }
                i++
            } else {
                clearInterval(interval)
            }
        }, speed)
    }, delay)
}
