@php
    $stack = ['Laravel', 'Vue.js', 'PHP', 'TypeScript', 'JavaScript', 'Tailwind CSS', 'MySQL', 'Git', 'Figma', 'React'];
@endphp
<section id="techstack" data-gsap="section-techstack" class="py-20 md:py-24">
    <div class="mx-auto max-w-6xl px-6 text-center">
        <p class="font-mono text-sm tracking-widest" style="color: var(--color-text-dim)">[ 04 — TECH STACK ]</p>
        <h2 class="font-display mt-3 text-2xl font-bold tracking-tight md:text-3xl" style="color: var(--color-text)">
            Gebouwd met moderne technologie
        </h2>

        <ul class="mt-10 flex flex-wrap items-center justify-center gap-3">
            @foreach ($stack as $tech)
                <li class="tech-chip px-4 py-2 text-sm font-medium font-mono cursor-default">{{ $tech }}</li>
            @endforeach
        </ul>
    </div>
</section>

<style>
.tech-chip {
    background: var(--color-surface-1);
    border: 1px solid var(--color-border-strong);
    color: var(--color-text-muted);
    transition: border-color 0.15s ease, color 0.15s ease;
}
@media (hover: hover) and (pointer: fine) {
    .tech-chip:hover { border-color: var(--color-accent); color: var(--color-text); }
}
</style>
