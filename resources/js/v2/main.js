/*
 * DevAim Labs site: behaviour. The motion layer lives in motion.js and
 * hooks into [data-reveal], [data-process-line], [data-process-line-fill],
 * [data-process-step] and [data-countup]. The page is complete without it.
 */

import { crossfadeTheme, initMotion, prefersReducedMotion } from './motion.js';

const root = document.documentElement;
const THEME_COLORS = { light: '#FBF7F0', dark: '#15120E' };

/* ------------------------------------------------------------------ */
/* Theme toggle                                                        */
/* ------------------------------------------------------------------ */

function readStoredTheme() {
    try {
        const value = localStorage.getItem('theme');
        return value === 'light' || value === 'dark' ? value : null;
    } catch {
        return null;
    }
}

function applyTheme(theme) {
    root.setAttribute('data-theme', theme);
    document.querySelectorAll('meta[name="theme-color"]').forEach((meta) => {
        meta.setAttribute('content', THEME_COLORS[theme]);
    });
    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.setAttribute('aria-pressed', String(theme === 'dark'));
    });
}

function initTheme() {
    applyTheme(root.getAttribute('data-theme') === 'dark' ? 'dark' : 'light');

    document.querySelectorAll('[data-theme-toggle]').forEach((button) => {
        button.addEventListener('click', () => {
            const next = root.getAttribute('data-theme') === 'dark' ? 'light' : 'dark';
            crossfadeTheme(() => applyTheme(next));
            try {
                localStorage.setItem('theme', next);
            } catch {
                /* storage blocked: the choice lasts for this page view */
            }
        });
    });

    // Back/forward cache: the theme may have been switched on the other
    // language page; restore the stored choice without a cross-fade.
    window.addEventListener('pageshow', (event) => {
        const stored = event.persisted ? readStoredTheme() : null;
        if (stored && stored !== root.getAttribute('data-theme')) applyTheme(stored);
    });

    // Follow the OS setting until the visitor makes an explicit choice.
    const media = window.matchMedia?.('(prefers-color-scheme: dark)');
    media?.addEventListener?.('change', (event) => {
        if (!readStoredTheme()) applyTheme(event.matches ? 'dark' : 'light');
    });
}

/* ------------------------------------------------------------------ */
/* Mobile sheet menu (focus trap, Esc, backdrop)                       */
/* ------------------------------------------------------------------ */

const FOCUSABLE = 'a[href], button:not([disabled]), input:not([disabled]), select, textarea, [tabindex]:not([tabindex="-1"])';

function initMenu() {
    const sheet = document.querySelector('[data-sheet]');
    const opener = document.querySelector('[data-menu-open]');
    if (!sheet || !opener) return;

    let lastFocus = null;
    let closeTimer = 0;
    const panel = sheet.querySelector('.sheet__panel');

    // Exit: play the CSS slide-out, then hide. Re-opening mid-exit
    // cancels it and the panel retargets from where it is.
    function finishClose() {
        clearTimeout(closeTimer);
        panel?.removeEventListener('transitionend', onExitEnd);
        if (!('closing' in sheet.dataset)) return;
        delete sheet.dataset.closing;
        sheet.hidden = true;
    }

    function onExitEnd(event) {
        if (event.target === panel) finishClose();
    }

    const focusables = () => [...sheet.querySelectorAll(FOCUSABLE)].filter((el) => el.offsetParent !== null);

    function onKeydown(event) {
        if (event.key === 'Escape') {
            event.preventDefault();
            close();
            return;
        }
        if (event.key !== 'Tab') return;

        const items = focusables();
        if (!items.length) return;
        const first = items[0];
        const last = items[items.length - 1];

        if (event.shiftKey && document.activeElement === first) {
            event.preventDefault();
            last.focus();
        } else if (!event.shiftKey && document.activeElement === last) {
            event.preventDefault();
            first.focus();
        }
    }

    function open() {
        if ('closing' in sheet.dataset) {
            clearTimeout(closeTimer);
            panel?.removeEventListener('transitionend', onExitEnd);
            delete sheet.dataset.closing;
        }
        lastFocus = document.activeElement;
        sheet.hidden = false;
        opener.setAttribute('aria-expanded', 'true');
        root.classList.add('sheet-open');
        document.addEventListener('keydown', onKeydown);
        (sheet.querySelector('[data-menu-link]') || focusables()[0])?.focus();
    }

    function close({ restoreFocus = true } = {}) {
        if (sheet.hidden || 'closing' in sheet.dataset) return;
        sheet.dataset.closing = '';
        panel?.addEventListener('transitionend', onExitEnd);
        // Fallback when no transition runs (unsupported, reduced motion).
        closeTimer = setTimeout(finishClose, 260);
        opener.setAttribute('aria-expanded', 'false');
        root.classList.remove('sheet-open');
        document.removeEventListener('keydown', onKeydown);
        if (restoreFocus) {
            const target = lastFocus && lastFocus !== document.body && document.contains(lastFocus) ? lastFocus : opener;
            target.focus();
        }
    }

    opener.addEventListener('click', open);
    sheet.querySelectorAll('[data-menu-close]').forEach((el) => el.addEventListener('click', () => close()));
    // Following an in-page link: let the browser move focus/scroll to the target.
    sheet.querySelectorAll('[data-menu-link]').forEach((el) => el.addEventListener('click', () => close({ restoreFocus: false })));

    // Close if the viewport grows past the breakpoint where the full nav shows.
    window.matchMedia('(min-width: 1100px)').addEventListener?.('change', (event) => {
        if (event.matches) close({ restoreFocus: false });
    });

    // Back/forward cache: the language link in the sheet navigates away
    // with the sheet still open. On return, show the page closed and
    // scrollable again, instantly (no exit animation on restore).
    window.addEventListener('pageshow', (event) => {
        if (!event.persisted || sheet.hidden) return;
        clearTimeout(closeTimer);
        panel?.removeEventListener('transitionend', onExitEnd);
        delete sheet.dataset.closing;
        sheet.hidden = true;
        opener.setAttribute('aria-expanded', 'false');
        root.classList.remove('sheet-open');
        document.removeEventListener('keydown', onKeydown);
    });
}

/* ------------------------------------------------------------------ */
/* Services disclosure menu (desktop nav)                              */
/* ------------------------------------------------------------------ */

/*
 * WAI-ARIA disclosure pattern: a button with aria-expanded that shows a
 * list of links. Enter/Space toggle (native button), ArrowDown opens and
 * moves into the list, arrows/Home/End move between links, Esc closes
 * and returns focus to the button, focus or a click outside closes.
 */
function initNavMenus() {
    document.querySelectorAll('[data-nav-menu]').forEach((menu) => {
        const toggle = menu.querySelector('[data-nav-menu-toggle]');
        const panel = menu.querySelector('[data-nav-menu-panel]');
        if (!toggle || !panel) return;

        const links = () => [...panel.querySelectorAll('a[href]')];
        const isOpen = () => toggle.getAttribute('aria-expanded') === 'true';

        // Exit: a 100ms fade (CSS, [data-closing]), quicker than the 150ms
        // enter, then hidden. Re-opening mid-exit cancels it and the
        // opacity transition retargets from wherever it is.
        let exitTimer = 0;
        function finishExit() {
            clearTimeout(exitTimer);
            if (!('closing' in panel.dataset)) return;
            delete panel.dataset.closing;
            panel.hidden = true;
        }

        function open({ focus = null } = {}) {
            if ('closing' in panel.dataset) {
                clearTimeout(exitTimer);
                delete panel.dataset.closing;
            }
            toggle.setAttribute('aria-expanded', 'true');
            panel.hidden = false;
            const items = links();
            if (focus === 'first') items[0]?.focus();
            if (focus === 'last') items[items.length - 1]?.focus();
        }

        function close({ restoreFocus = false, instant = false } = {}) {
            if (!isOpen()) return;
            toggle.setAttribute('aria-expanded', 'false');
            if (instant || prefersReducedMotion()) {
                panel.hidden = true;
            } else {
                panel.dataset.closing = '';
                exitTimer = setTimeout(finishExit, 110);
            }
            if (restoreFocus) toggle.focus();
        }

        toggle.addEventListener('click', () => (isOpen() ? close() : open()));

        toggle.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowDown') {
                event.preventDefault();
                open({ focus: 'first' });
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                open({ focus: 'last' });
            }
        });

        menu.addEventListener('keydown', (event) => {
            if (event.key === 'Escape' && isOpen()) {
                event.preventDefault();
                close({ restoreFocus: true });
                return;
            }
            const items = links();
            const index = items.indexOf(document.activeElement);
            if (index === -1) return;

            let next = null;
            if (event.key === 'ArrowDown') next = items[(index + 1) % items.length];
            else if (event.key === 'ArrowUp') next = index === 0 ? toggle : items[index - 1];
            else if (event.key === 'Home') next = items[0];
            else if (event.key === 'End') next = items[items.length - 1];
            if (next) {
                event.preventDefault();
                next.focus();
            }
        });

        // Tabbing out of the menu closes it.
        menu.addEventListener('focusout', (event) => {
            if (event.relatedTarget && !menu.contains(event.relatedTarget)) close();
        });

        document.addEventListener('pointerdown', (event) => {
            if (isOpen() && !menu.contains(event.target)) close();
        });

        // In-page anchors (home) do not unload the page: close after a pick.
        panel.addEventListener('click', (event) => {
            if (event.target.closest('a')) close();
        });

        // Back/forward cache: show the page with the menu closed.
        window.addEventListener('pageshow', (event) => {
            if (event.persisted) close({ instant: true });
        });
    });
}

/* ------------------------------------------------------------------ */
/* Forms: JSON POST to /contact with inline errors                     */
/* ------------------------------------------------------------------ */

function csrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') ?? '';
}

/*
 * Message for a failed, non-validation response. Laravel's own 419 (CSRF
 * token expired), 429 (throttle) and 500 bodies are English, and a proxy
 * may answer with HTML, so the text always comes from the page itself.
 */
function failureMessage(form, status) {
    if (status === 419) return form.dataset.msgExpired;
    if (status === 429) return form.dataset.msgThrottled;
    return form.dataset.msgGeneric;
}

function setButtonState(button, state) {
    if (!button) return;
    button.dataset.state = state;
    button.disabled = state === 'loading';
    button.setAttribute('aria-busy', String(state === 'loading'));
    const idle = button.querySelector('[data-label-idle]');
    const loading = button.querySelector('[data-label-loading]');
    if (idle && loading) {
        idle.hidden = state === 'loading';
        loading.hidden = state !== 'loading';
    }
}

function clearErrors(form) {
    form.querySelectorAll('[data-error-for]').forEach((el) => {
        el.textContent = '';
        el.hidden = true;
    });
    form.querySelectorAll('[aria-invalid]').forEach((el) => el.removeAttribute('aria-invalid'));
}

function showStatus(form, kind, message, { focus = false } = {}) {
    const status = form.querySelector('[data-form-status]');
    if (!status) return;
    status.dataset.kind = kind;
    status.textContent = message;
    status.hidden = false;
    if (focus) status.focus();
}

function showFieldErrors(form, errors) {
    let firstField = null;

    // Walk the error slots in DOM order so focus lands on the first
    // invalid field on screen, whatever order the server listed them in.
    form.querySelectorAll('[data-error-for]').forEach((slot) => {
        const name = slot.dataset.errorFor;
        const messages = errors[name];
        const field = form.elements.namedItem(name);
        if (!messages || !field) return;
        slot.textContent = Array.isArray(messages) ? messages[0] : String(messages);
        slot.hidden = false;
        field.setAttribute('aria-invalid', 'true');
        firstField ??= field;
    });

    return firstField;
}

function initForms() {
    document.querySelectorAll('form[data-v2-form]').forEach((form) => {
        const button = form.querySelector('[data-submit]');

        // Clear a field's error as soon as the visitor edits it.
        form.addEventListener('input', (event) => {
            const name = event.target?.name;
            if (!name) return;
            const slot = form.querySelector(`[data-error-for="${CSS.escape(name)}"]`);
            if (slot && !slot.hidden) {
                slot.hidden = true;
                slot.textContent = '';
                event.target.removeAttribute('aria-invalid');
            }
        });

        form.addEventListener('submit', async (event) => {
            event.preventDefault();
            if (button?.dataset.state === 'loading') return;

            clearErrors(form);
            form.querySelector('[data-form-status]')?.setAttribute('hidden', '');

            // The server adds a missing https:// to scan_url.
            const payload = Object.fromEntries(new FormData(form).entries());

            setButtonState(button, 'loading');

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        Accept: 'application/json',
                        'X-CSRF-TOKEN': csrfToken(),
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    credentials: 'same-origin',
                    body: JSON.stringify(payload),
                });

                const data = await response.json().catch(() => ({}));

                if (response.ok) {
                    setButtonState(button, 'success');
                    form.reset();
                    showStatus(form, 'success', form.dataset.msgSuccess, { focus: true });
                    form.dispatchEvent(new CustomEvent('v2:form-success', { bubbles: true }));
                    setTimeout(() => setButtonState(button, 'idle'), 400);
                    return;
                }

                setButtonState(button, 'idle');

                if (response.status === 422 && data.errors) {
                    const firstField = showFieldErrors(form, data.errors);
                    showStatus(form, 'error', form.dataset.msgError);
                    (firstField ?? form.querySelector('[data-form-status]'))?.focus();
                    return;
                }

                showStatus(form, 'error', failureMessage(form, response.status), { focus: true });
            } catch {
                setButtonState(button, 'idle');
                showStatus(form, 'error', form.dataset.msgGeneric, { focus: true });
            }
        });
    });

    // Pricing CTAs preselect the project type in the contact form.
    document.querySelectorAll('[data-preselect]').forEach((link) => {
        link.addEventListener('click', () => {
            const select = document.querySelector('#contact-form-project_type');
            const value = link.getAttribute('data-preselect');
            if (select && [...select.options].some((o) => o.value === value)) select.value = value;
        });
    });
}

/* ------------------------------------------------------------------ */
/* Sticky mobile CTA                                                   */
/* ------------------------------------------------------------------ */

function initMobileCta() {
    const bar = document.querySelector('[data-mobile-cta]');
    const hero = document.querySelector('[data-hero]');
    const endZones = [document.querySelector('[data-contact]'), document.querySelector('[data-footer]')].filter(Boolean);
    if (!bar || !hero || !('IntersectionObserver' in window)) return;

    bar.hidden = false;
    let heroVisible = true;
    const visibleEnd = new Set();

    const update = () => {
        const show = !heroVisible && visibleEnd.size === 0;
        bar.dataset.visible = String(show);
        // Keep hidden links out of the tab order and the accessibility tree.
        bar.inert = !show;
    };

    new IntersectionObserver(([entry]) => {
        heroVisible = entry.isIntersecting;
        update();
    }).observe(hero);

    const endObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) visibleEnd.add(entry.target);
            else visibleEnd.delete(entry.target);
        });
        update();
    });
    endZones.forEach((zone) => endObserver.observe(zone));

    update();
}

/* ------------------------------------------------------------------ */
/* Logo loop pause/play (WCAG 2.2.2: moving content can be paused)     */
/* ------------------------------------------------------------------ */

function initMarquee() {
    document.querySelectorAll('[data-marquee-toggle]').forEach((button) => {
        const marquee = button.parentElement.querySelector('[data-marquee]');
        if (!marquee) return;

        button.addEventListener('click', () => {
            const paused = button.getAttribute('aria-pressed') !== 'true';
            button.setAttribute('aria-pressed', String(paused));
            button.setAttribute('aria-label', paused ? button.dataset.labelPlay : button.dataset.labelPause);
            marquee.toggleAttribute('data-paused', paused);
        });
    });
}

/* ------------------------------------------------------------------ */
/* Service pages: live demo facade, API data flow (own chunks)         */
/* ------------------------------------------------------------------ */

function initServicePage() {
    if (document.querySelector('[data-demo]')) {
        import('./demo-embed.js').then((m) => m.default()).catch(() => {
            /* chunk failed: the screenshot and "open in new tab" still work */
        });
    }
    if (document.querySelector('[data-flow]')) {
        import('./sync-flow.js').then((m) => m.default()).catch(() => {
            /* chunk failed: the static diagram and full log stay */
        });
    }
}

/* ------------------------------------------------------------------ */
/* Client cases: max 3 rows, the rest behind "show all"                */
/* ------------------------------------------------------------------ */

function initCaseLists() {
    document.querySelectorAll('[data-case-list]').forEach((list) => {
        const more = list.querySelector('[data-case-more]');
        const button = list.querySelector('[data-case-toggle]');
        if (!more || !button) return;

        const label = button.querySelector('[data-case-toggle-label]');
        const set = (expanded) => {
            more.hidden = !expanded;
            button.setAttribute('aria-expanded', String(expanded));
            label.textContent = expanded ? button.dataset.labelLess : button.dataset.labelMore;
        };

        // Rendered open so every row works without JS; collapse it here.
        set(false);
        button.hidden = false;

        button.addEventListener('click', () => {
            const expand = button.getAttribute('aria-expanded') !== 'true';
            set(expand);
            // Move focus to the first new row so keyboard users land on it.
            if (expand) more.querySelector('summary')?.focus();
        });
    });
}

/* ------------------------------------------------------------------ */

function init() {
    initTheme();
    initMenu();
    initNavMenus();
    initForms();
    initMobileCta();
    initMarquee();
    initCaseLists();
    initServicePage();
    initMotion();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', init);
} else {
    init();
}
