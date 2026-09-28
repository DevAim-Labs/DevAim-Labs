@php
    $steps = [
        ['title' => 'Kennismaking', 'description' => 'Een vrijblijvend gesprek over uw idee, doelen en planning.'],
        ['title' => 'Scope en planning', 'description' => 'Ik zet dit om in een concreet plan van aanpak met een vaste scope.'],
        ['title' => 'Bouwen', 'description' => "Ik bouw in overzichtelijke fases, met een demo elke twee weken."],
        ['title' => 'Oplevering', 'description' => 'Livegang, overdracht en heldere documentatie.'],
        ['title' => 'Doorontwikkeling', 'description' => 'Flexibele support en ruimte om na livegang door te bouwen.'],
    ];
@endphp
<section id="werkwijze" data-gsap="section-workflow" class="py-24 md:py-32">
    <div class="mx-auto max-w-4xl px-6">
        <div class="max-w-2xl">
            <p class="font-mono text-sm tracking-widest" style="color: var(--color-text-dim)">[ 07 — WERKWIJZE ]</p>
            <h2 class="font-display mt-3 text-3xl font-bold tracking-tight md:text-4xl" style="color: var(--color-text)">
                Hoe verloopt een project van eerste gesprek tot livegang?
            </h2>
        </div>

        <div class="relative mt-16" data-workflow-line-root>
            <div class="absolute left-[15px] top-2 bottom-2 w-px" style="background: var(--color-border)" aria-hidden="true"></div>
            <div class="workflow-line absolute left-[15px] top-2 bottom-2 w-px" style="background: var(--color-accent)" aria-hidden="true" data-workflow-line></div>

            <ol class="space-y-14">
                @foreach ($steps as $i => $step)
                    <li class="relative pl-12">
                        <span class="absolute left-0 top-0 flex h-8 w-8 items-center justify-center font-mono text-sm font-semibold" style="background: var(--color-surface-1); border: 1px solid var(--color-accent); color: var(--color-accent)">
                            {{ sprintf('%02d', $i + 1) }}
                        </span>
                        <h3 class="font-display text-lg font-bold" style="color: var(--color-text)">{{ $step['title'] }}</h3>
                        <p class="mt-1.5 text-sm leading-relaxed" style="color: var(--color-text-muted)">{{ $step['description'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
