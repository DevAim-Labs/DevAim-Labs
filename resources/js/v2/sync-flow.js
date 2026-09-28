/*
 * API-integrations data flow (service page). Markup:
 * resources/views/v2/sections/service/flow.blade.php
 *
 * The dots on the wires are pure CSS (transform keyframes, v2.css). This
 * file re-plays the example sync log and owns the pause/play button
 * (same pattern as the logo marquee). There is no timer: a new log row
 * appears each time the outgoing dot finishes a cycle (animationiteration),
 * so the log stays in step with the diagram and costs nothing while the
 * animation is paused. The animation is paused (data-paused) when the
 * visitor pauses it or the panel is off-screen; browsers already stop it
 * in hidden tabs. Under reduced motion the CSS hides the dots and toggle
 * and all rows stay visible.
 */

const REDUCE = '(prefers-reduced-motion: reduce)';
const START_ROWS = 2; // rows shown when the log (re)starts
const HOLD_STEPS = 2; // cycles the full log stays before it replays

function setup(panel) {
    const rows = [...panel.querySelectorAll('[data-flow-row]')];
    const toggle = panel.querySelector('[data-flow-toggle]');
    // The last dot to arrive: its cycle end is the "row written" moment.
    const clock = panel.querySelector('.flow-wire--out .flow-dot');
    const reduce = window.matchMedia(REDUCE);

    let shown = reduce.matches ? rows.length : START_ROWS;
    let hold = 0;
    let paused = false;
    let onScreen = false;

    const render = () => {
        rows.forEach((row, i) => {
            if (i < shown) row.removeAttribute('data-state');
            else row.dataset.state = 'pending';
        });
    };

    const step = () => {
        if (shown < rows.length) {
            shown += 1;
        } else if (hold < HOLD_STEPS) {
            hold += 1;
            return;
        } else {
            hold = 0;
            shown = START_ROWS;
        }
        render();
    };

    const running = () => !paused && onScreen && !reduce.matches;
    const sync = () => panel.toggleAttribute('data-paused', !running());

    panel.addEventListener('animationiteration', (event) => {
        if (event.target === clock && running()) step();
    });

    toggle?.addEventListener('click', () => {
        paused = toggle.getAttribute('aria-pressed') !== 'true';
        toggle.setAttribute('aria-pressed', String(paused));
        toggle.setAttribute('aria-label', paused ? toggle.dataset.labelPlay : toggle.dataset.labelPause);
        sync();
    });

    new IntersectionObserver(([entry]) => {
        onScreen = entry.isIntersecting;
        sync();
    }).observe(panel);

    // Reduced motion switched on mid-visit: show the full log and stop;
    // switched off: start the replay from a short log again.
    reduce.addEventListener?.('change', () => {
        shown = reduce.matches ? rows.length : START_ROWS;
        hold = 0;
        render();
        sync();
    });

    render();
    sync();
}

export default function initSyncFlows() {
    if (!('IntersectionObserver' in window)) return;
    document.querySelectorAll('[data-flow]').forEach(setup);
}
