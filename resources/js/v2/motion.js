/*
 * DevAim Labs /v2: motion layer.
 *
 * Calm by default: one fade + 12px rise per element, once. The page is
 * complete without this file; every hidden start state is added here,
 * right before observing, and only when motion is allowed.
 *
 * - Hero entrance: pure CSS (v2.css), so it runs off the main thread and
 *   never depends on this bundle loading.
 * - Scroll reveals, KPI count-up, sheet/theme helpers: here, no library.
 * - Process line scrub: GSAP + ScrollTrigger, loaded lazily as its own
 *   chunk only when the process section gets close and motion is allowed.
 */

const REDUCE = '(prefers-reduced-motion: reduce)';
const REVEAL_MS = 350;
const STAGGER_MS = 70;

export const prefersReducedMotion = () => window.matchMedia?.(REDUCE).matches ?? false;

/* ------------------------------------------------------------------ */
/* Scroll reveals                                                      */
/* ------------------------------------------------------------------ */

function initReveals() {
    if (prefersReducedMotion() || !('IntersectionObserver' in window)) return;

    // The hero has its own CSS entrance.
    const candidates = [...document.querySelectorAll('[data-reveal]')].filter((el) => !el.closest('[data-hero]'));

    // Read first, then write: only hide what is still below the fold.
    // Anything on screen (or above it, after a restored scroll) stays shown.
    const fold = window.innerHeight;
    const pending = candidates.filter((el) => el.getBoundingClientRect().top >= fold);
    if (!pending.length) return;

    const finish = (el) => {
        el.removeAttribute('data-reveal-state');
        el.style.removeProperty('--reveal-delay');
    };

    const observer = new IntersectionObserver(
        (entries) => {
            const entering = entries
                .filter((entry) => entry.isIntersecting)
                .map((entry) => entry.target)
                .sort((a, b) => (a.compareDocumentPosition(b) & Node.DOCUMENT_POSITION_FOLLOWING ? -1 : 1));

            entering.forEach((el, index) => {
                observer.unobserve(el);
                const delay = Math.min(index, 5) * STAGGER_MS;
                el.style.setProperty('--reveal-delay', `${delay}ms`);
                el.dataset.revealState = 'in';

                // Hand the element back to its own transitions once done.
                let timer = 0;
                const done = (event) => {
                    if (event && (event.target !== el || event.propertyName !== 'opacity')) return;
                    clearTimeout(timer);
                    el.removeEventListener('transitionend', done);
                    finish(el);
                };
                el.addEventListener('transitionend', done);
                timer = setTimeout(done, REVEAL_MS + delay + 150);
            });
        },
        { rootMargin: '0px 0px -8% 0px' },
    );

    pending.forEach((el) => {
        el.dataset.revealState = 'pending';
        observer.observe(el);
    });

    // Switching to reduced motion mid-visit: show everything, stop observing.
    window.matchMedia(REDUCE).addEventListener?.('change', (event) => {
        if (!event.matches) return;
        observer.disconnect();
        pending.forEach(finish);
    });
}

/* ------------------------------------------------------------------ */
/* KPI count-up (tabular digits, same digit count: no layout jitter)   */
/* ------------------------------------------------------------------ */

function initCountUp() {
    if (prefersReducedMotion() || !('IntersectionObserver' in window)) return;

    document.querySelectorAll('[data-countup]').forEach((el) => {
        const node = [...el.childNodes].find((n) => n.nodeType === Node.TEXT_NODE && /\d/.test(n.textContent));
        if (!node) return;

        const original = node.textContent;
        const target = parseInt(original.replace(/\D/g, ''), 10);
        const digits = String(target).length;
        // Start from the smallest number with the same digit count (148 -> 100).
        const from = digits > 1 ? 10 ** (digits - 1) : 0;
        if (!Number.isFinite(target) || target <= from) return;

        // Only count if the visitor has not seen the final value yet.
        const onScreen = el.getBoundingClientRect().top < window.innerHeight;
        const heroCardStillHidden = performance.now() < 500;
        if (onScreen && !heroCardStillHidden) return;

        const render = (value) => {
            node.textContent = original.replace(/\d[\d.,]*/, String(value));
        };
        render(from);

        const observer = new IntersectionObserver(
            ([entry]) => {
                if (!entry.isIntersecting) return;
                observer.disconnect();
                // Let the hero tech card land first (CSS: ~300ms delay).
                const wait = Math.max(0, 450 - performance.now());
                setTimeout(() => {
                    const duration = 800;
                    const start = performance.now();
                    const tick = (now) => {
                        const t = Math.min(1, (now - start) / duration);
                        const eased = 1 - (1 - t) ** 3; // ease-out cubic
                        render(Math.round(from + (target - from) * eased));
                        if (t < 1) requestAnimationFrame(tick);
                        else node.textContent = original;
                    };
                    requestAnimationFrame(tick);
                }, wait);
            },
            { threshold: 0.5 },
        );
        observer.observe(el);
    });
}

/* ------------------------------------------------------------------ */
/* Process line: lazy GSAP chunk                                       */
/* ------------------------------------------------------------------ */

function initProcessLine() {
    const line = document.querySelector('[data-process-line]');
    if (!line || !('IntersectionObserver' in window)) return;

    // GSAP is only fetched when the section is within ~1.5 screens.
    // gsap.matchMedia() in that chunk handles reduced motion itself.
    const observer = new IntersectionObserver(
        ([entry]) => {
            if (!entry.isIntersecting) return;
            observer.disconnect();
            import('./process-line.js').then((m) => m.default(line)).catch(() => {
                /* chunk failed: the line simply stays fully drawn */
            });
        },
        { rootMargin: '150% 0px 150% 0px' },
    );
    observer.observe(line);
}

/* ------------------------------------------------------------------ */
/* Theme cross-fade                                                    */
/* ------------------------------------------------------------------ */

let fadeTimer = 0;

/** Run `apply` (which flips data-theme) with a ~250ms colour cross-fade. */
export function crossfadeTheme(apply) {
    if (document.startViewTransition) {
        document.startViewTransition(apply);
        return;
    }
    // Fallback: briefly allow colour transitions everywhere.
    const root = document.documentElement;
    root.classList.add('theme-fading');
    apply();
    clearTimeout(fadeTimer);
    fadeTimer = setTimeout(() => root.classList.remove('theme-fading'), 300);
}

/* ------------------------------------------------------------------ */

export function initMotion() {
    // iOS Safari only applies :active (button press scale) when a touch
    // listener exists; an empty passive one costs nothing.
    document.addEventListener('touchstart', () => {}, { passive: true });
    initReveals();
    initCountUp();
    initProcessLine();
}
