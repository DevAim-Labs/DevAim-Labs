@php
    $plans = [
        [
            'name' => 'Vaste prijs',
            'blurb' => 'Voor een helder afgebakend project. Eén prijs, geen verrassingen.',
            'features' => ['Vooraf vastgestelde scope', 'Duidelijke planning', 'Eén vaste einddatum'],
            'cta' => 'Vraag een offerte aan',
            'highlight' => false,
        ],
        [
            'name' => 'Per fase / uurtarief',
            'blurb' => 'Voor projecten die nog vorm krijgen of blijven groeien. Flexibel meebewegen.',
            'features' => ['Werken in overzichtelijke fases', 'Wekelijkse update', 'Bijsturen waar nodig'],
            'cta' => 'Plan een gesprek',
            'highlight' => true,
        ],
        [
            'name' => 'Onderhoud & support',
            'blurb' => 'Doorlopend, maandelijks opzegbaar — voor na livegang.',
            'features' => ['Bugfixes & beveiligingsupdates', 'Kleine aanpassingen', 'Voorrang bij support', 'Optioneel hosting-beheer'],
            'cta' => 'Meer informatie',
            'highlight' => false,
        ],
    ];
@endphp
<section id="prijzen" data-gsap="section-pricing" class="py-24 md:py-32" style="background: var(--color-surface-1)">
    <div class="mx-auto max-w-6xl px-6">
        <div class="max-w-2xl">
            <p class="font-mono text-sm tracking-widest" style="color: var(--color-text-dim)">[ 06 — PRIJZEN ]</p>
            <h2 class="font-display mt-3 text-3xl font-bold tracking-tight md:text-4xl" style="color: var(--color-text)">
                Wat kost maatwerksoftware?
            </h2>
        </div>

        <div class="mt-12 grid gap-6 lg:grid-cols-3">
            @foreach ($plans as $plan)
                <article class="pricing-card relative flex flex-col p-8 {{ $plan['highlight'] ? 'block-border--accent' : 'block-border' }}">
                    @if ($plan['highlight'])
                        <span class="absolute -top-3 left-8 px-3 py-1 text-xs font-semibold font-mono" style="background: var(--color-accent); color: var(--color-on-accent)">Meest gekozen</span>
                    @endif

                    <h3 class="font-display text-lg font-bold" style="color: var(--color-text)">{{ $plan['name'] }}</h3>
                    <p class="mt-2 text-sm leading-relaxed" style="color: var(--color-text-muted)">{{ $plan['blurb'] }}</p>
                    <p class="mt-6 font-mono text-2xl font-bold" style="color: var(--color-text)">Op aanvraag</p>

                    <ul class="mt-6 flex-1 space-y-2.5">
                        @foreach ($plan['features'] as $feature)
                            <li class="flex items-start gap-2.5 text-sm" style="color: var(--color-text-muted)">
                                @include('partials.icon', ['name' => 'check', 'size' => 16, 'attributes' => 'style="color: var(--color-accent); margin-top: 2px; flex-shrink: 0"'])
                                {{ $feature }}
                            </li>
                        @endforeach
                    </ul>

                    <a href="#contact" class="btn-hover mt-8 justify-center cursor-pointer {{ $plan['highlight'] ? 'btn-hover-primary' : 'btn-hover-outline' }}">
                        <span class="btn-hover__dot" aria-hidden="true"></span>
                        <span class="btn-hover__label">{{ $plan['cta'] }}</span>
                        <span class="btn-hover__reveal" aria-hidden="true">{{ $plan['cta'] }}</span>
                    </a>
                </article>
            @endforeach
        </div>

        <p class="mt-8 text-center text-sm" style="color: var(--color-text-dim)">
            Alle bedragen op aanvraag — in een gratis, vrijblijvend kennismakingsgesprek bekijk ik samen met u wat bij uw project past.
        </p>
    </div>
</section>
