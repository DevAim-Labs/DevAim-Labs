@php
    $loopWords = ['maatwerksoftware', 'website', 'adminpaneel', 'KPI-dashboard', 'betaalintegratie'];
@endphp
<section id="top" class="relative overflow-hidden pt-36 pb-24 md:pt-44 md:pb-32">
    <div id="hero-gradient-mount" aria-hidden="true"></div>
    <div class="grid-bg" aria-hidden="true"></div>

    <div class="relative mx-auto max-w-6xl px-6">
        <div class="grid gap-16 lg:grid-cols-2 lg:items-center">
            <div>
                <p class="font-mono text-sm tracking-widest" style="color: var(--color-text-dim)">[ 01 — INTRODUCTIE ]</p>

                <div class="mt-5" id="hero-availability-mount" data-text="Beschikbaar voor nieuwe projecten"></div>

                <h1 class="font-display mt-6 font-bold leading-[1.05] tracking-tight" style="font-size: clamp(2.5rem, 5.5vw + 0.5rem, 4.25rem); color: var(--color-text)">
                    Ik bouw uw
                    <span class="block">
                        <span id="hero-text-loop-mount" data-words='@json($loopWords)' class="capitalize" style="color: var(--color-accent)">{{ $loopWords[0] }}</span>
                    </span>
                </h1>

                <p class="mt-6 max-w-xl text-lg leading-relaxed" style="color: var(--color-text-muted)">
                    DevAim Labs ontwikkelt maatwerksoftware die uw bedrijfsprocessen automatiseert en centraliseert.
                    Of u nu spreadsheets wilt vervangen door een adminpaneel, realtime KPI-dashboards nodig heeft,
                    of koppelingen met bestaande CRM- en boekhoudsystemen zoekt: ik bouw oplossingen die precies
                    bij u passen. U werkt rechtstreeks met mij, de developer die uw project bouwt — vanaf het
                    eerste gesprek tot de livegang dezelfde persoon, zonder accountmanager of wisselende
                    contactpersonen. Ik reageer binnen 24 uur en stel een vaste scope en planning op voordat ik
                    begin, zodat u niet voor verrassingen komt te staan.
                </p>

                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="#contact" class="btn-hover btn-hover-primary cursor-pointer">
                        <span class="btn-hover__dot" aria-hidden="true"></span>
                        <span class="btn-hover__label">Start een project</span>
                        <span class="btn-hover__reveal" aria-hidden="true">
                            Start een project
                            @include('partials.icon', ['name' => 'arrowRight', 'size' => 16])
                        </span>
                    </a>
                    <a href="#werkwijze" class="btn-hover btn-hover-outline cursor-pointer">
                        <span class="btn-hover__dot" aria-hidden="true"></span>
                        <span class="btn-hover__label">Bekijk werkwijze</span>
                        <span class="btn-hover__reveal" aria-hidden="true">Bekijk werkwijze</span>
                    </a>
                </div>

                <ul class="mt-10 flex flex-wrap gap-x-8 gap-y-3">
                    @foreach (['Reactie binnen 24 uur', "Demo's elke 2 weken", '100% code-eigendom voor u'] as $stat)
                        <li class="flex items-center gap-2">
                            @include('partials.icon', ['name' => 'check', 'size' => 16, 'attributes' => 'style="color: var(--color-accent)"'])
                            <span class="text-sm font-medium" style="color: var(--color-text-muted)">{{ $stat }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="relative">
                <div class="code-card mx-auto max-w-md" style="box-shadow: 8px 8px 0 var(--color-border-strong)">
                    <div class="code-card-header">
                        <div class="code-card-dots" aria-hidden="true">
                            <span class="code-card-dot red"></span>
                            <span class="code-card-dot yellow"></span>
                            <span class="code-card-dot green"></span>
                        </div>
                        <span class="code-card-title">deploy.log</span>
                    </div>
                    <div class="p-5 font-mono text-[13px] leading-relaxed" style="color: var(--color-text-muted)">
                        <p><span style="color: var(--color-accent)">$</span> php artisan deploy --project=uw-project</p>
                        <p class="mt-1">✓ scope vastgesteld met u</p>
                        <p>✓ demo #1 opgeleverd</p>
                        <p>✓ demo #2 opgeleverd</p>
                        <p style="color: var(--color-accent-bright)">✓ live in productie</p>
                        <p class="mt-2 opacity-60">// code-eigendom: 100% bij u</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
#hero-gradient-mount {
    position: absolute;
    inset: 0;
}
</style>
