/*
 * Process line: the fill grows with scroll progress through the process
 * section (transform scale only) and each step lights up as the line
 * reaches its number. Loaded lazily from motion.js as a separate chunk.
 */

import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default function initProcessLine(line) {
    const fill = line.querySelector('[data-process-line-fill]');
    const steps = [...document.querySelectorAll('[data-process-step]')];
    if (!fill) return;

    const mm = gsap.matchMedia();

    mm.add(
        {
            motion: '(prefers-reduced-motion: no-preference)',
            wide: '(min-width: 900px)',
        },
        (context) => {
            // Reduced motion: leave the fully drawn line and active steps.
            if (!context.conditions.motion) return undefined;

            const horizontal = context.conditions.wide;
            const axis = horizontal ? 'scaleX' : 'scaleY';
            let thresholds = [];

            // Where each step's number sits along the line, as 0..1 progress.
            const measure = () => {
                const box = line.getBoundingClientRect();
                const start = horizontal ? box.left : box.top;
                const length = (horizontal ? box.width : box.height) || 1;
                thresholds = steps.map((step) => {
                    const num = (step.querySelector('.process__num') ?? step).getBoundingClientRect();
                    const centre = horizontal ? num.left + num.width / 2 : num.top + num.height / 2;
                    return Math.min(1, Math.max(0, (centre - start) / length));
                });
            };

            const paint = (progress) => {
                steps.forEach((step, i) => {
                    const reached = progress > 0.001 && progress >= thresholds[i] - 0.02;
                    step.dataset.stepState = reached ? 'active' : 'pending';
                });
            };

            let tween = null;
            tween = gsap.fromTo(
                fill,
                { [axis]: 0 },
                {
                    [axis]: 1,
                    ease: 'none',
                    // Follow the drawn (scrubbed) line, not the raw scroll.
                    onUpdate() {
                        paint(this.progress());
                    },
                    scrollTrigger: {
                        trigger: line,
                        // Horizontal line is 2px tall: give it ~40% of a screen to draw.
                        start: horizontal ? 'top 85%' : 'top 75%',
                        end: horizontal ? 'top 45%' : 'bottom 55%',
                        scrub: 0.3,
                        invalidateOnRefresh: true,
                        onRefresh: () => {
                            measure();
                            paint(tween ? tween.progress() : 0);
                        },
                    },
                },
            );

            measure();
            paint(tween.progress());

            // Runs when a condition flips (breakpoint, reduced motion) or on revert.
            return () => {
                steps.forEach((step) => step.removeAttribute('data-step-state'));
            };
        },
    );

    // Web fonts can swap in after this chunk runs (fast scroll on a slow
    // connection) and shift the section: re-measure start/end and the
    // step thresholds once they have settled.
    document.fonts?.ready.then(() => ScrollTrigger.refresh());

    return mm;
}
