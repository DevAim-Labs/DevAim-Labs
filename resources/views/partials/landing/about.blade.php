@php
    $usps = [
        'Direct contact met de developer, geen accountmanager',
        "Demo's elke 2 weken, zodat u altijd weet waar het project staat",
        'U bezit de volledige code — geen vendor lock-in',
    ];
@endphp
<section id="over-mij" data-gsap="section-about" class="py-24 md:py-32">
    <div class="mx-auto max-w-6xl px-6">
        <div class="grid gap-12 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.2fr)] lg:items-start">
            <div class="block-border mx-auto flex w-full max-w-sm flex-col gap-6 p-8 lg:mx-0">
                <img src="{{ asset('DevAim_IMG.png') }}" alt="" width="40" height="40" aria-hidden="true" loading="lazy">
                <p class="font-display text-6xl font-bold leading-none" style="color: var(--color-accent)">100%</p>
                <p class="text-sm leading-relaxed" style="color: var(--color-text-muted)">
                    van de code en documentatie is en blijft van u — geen vendor lock-in, ook niet na afronding.
                </p>
                <div class="border-t pt-6" style="border-color: var(--color-border)">
                    <p class="font-display text-4xl font-bold leading-none" style="color: var(--color-text)">&lt;24u</p>
                    <p class="mt-2 text-sm leading-relaxed" style="color: var(--color-text-muted)">gemiddelde reactietijd op uw bericht</p>
                </div>
            </div>

            <div>
                <p class="font-mono text-sm tracking-widest" style="color: var(--color-text-dim)">[ 02 — OVER MIJ ]</p>
                <h2 class="font-display mt-3 text-3xl font-bold tracking-tight md:text-4xl" style="color: var(--color-text)">
                    Hoe werkt samenwerken met DevAim Labs?
                </h2>
                <p class="mt-5 text-base leading-relaxed" style="color: var(--color-text-muted)">
                    Bij DevAim Labs werkt u vanaf dag één rechtstreeks met mij, de developer die uw project bouwt.
                    Geen accountmanager die als tussenpersoon fungeert, geen wisselende contactpersonen tijdens het
                    traject. Wat u met mij bespreekt, is precies wat er gebouwd wordt.
                </p>
                <p class="mt-4 text-base leading-relaxed" style="color: var(--color-text-muted)">
                    Ik streef naar een reactietijd van maximaal 24 uur op alle communicatie. Voordat een project
                    start, stel ik een scope en planning op, inclusief mijlpalen, zodat u vooraf weet waar u aan
                    toe bent en er onderweg geen verrassingen zijn.
                </p>

                <ul class="mt-8 space-y-3">
                    @foreach ($usps as $usp)
                        <li class="flex items-start gap-3">
                            <span class="mt-1 flex h-5 w-5 shrink-0 items-center justify-center" style="background: var(--color-accent); color: var(--color-on-accent)">
                                @include('partials.icon', ['name' => 'check', 'size' => 13])
                            </span>
                            <span class="text-sm leading-relaxed" style="color: var(--color-text)">{{ $usp }}</span>
                        </li>
                    @endforeach
                </ul>

                <a href="#contact" class="btn-hover btn-hover-primary mt-8 cursor-pointer">
                    <span class="btn-hover__dot" aria-hidden="true"></span>
                    <span class="btn-hover__label">Praat met mij</span>
                    <span class="btn-hover__reveal" aria-hidden="true">
                        Praat met mij
                        @include('partials.icon', ['name' => 'arrowRight', 'size' => 16])
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>
