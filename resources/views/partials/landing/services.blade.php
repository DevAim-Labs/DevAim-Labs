@php
    $services = [
        ['title' => "Websites & portfolio's", 'description' => 'Snelle, SEO-vriendelijke websites die converteren.', 'href' => '/diensten/websites'],
        ['title' => 'Adminpanelen', 'description' => 'Vervang spreadsheets door echte tooling met rollen en rechten.', 'href' => '/diensten/adminpanelen'],
        ['title' => 'KPI-dashboards', 'description' => 'Realtime inzicht in uw bedrijfsdata met live cijfers en alerts.', 'href' => '/diensten/dashboards'],
        ['title' => 'Betaalintegraties', 'description' => 'Stripe en Mollie voor checkout, abonnementen en facturatie.', 'href' => '/diensten/betalingen'],
        ['title' => 'API-koppelingen', 'description' => "REST API's, webhooks en synchronisaties tussen uw systemen.", 'href' => '/diensten/api-integraties'],
    ];
@endphp
<section id="diensten" data-gsap="section-services" class="py-24 md:py-32">
    <div class="mx-auto max-w-6xl px-6">
        <div class="max-w-2xl">
            <p class="font-mono text-sm tracking-widest" style="color: var(--color-text-dim)">[ 05 — DIENSTEN ]</p>
            <h2 class="font-display mt-3 text-3xl font-bold tracking-tight md:text-4xl" style="color: var(--color-text)">
                Welke software bouw ik voor u?
            </h2>
            <p class="mt-4 text-base leading-relaxed" style="color: var(--color-text-muted)">
                Van een eerste website tot complexe koppelingen tussen uw systemen — ik lever maatwerk, geen sjabloon.
            </p>
        </div>

        <div class="mt-12 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($services as $i => $service)
                <a href="{{ $service['href'] }}" class="service-card block-border group relative flex flex-col p-6 cursor-pointer">
                    <span class="font-mono text-xs" style="color: var(--color-text-dim)">{{ sprintf('%02d', $i + 1) }}</span>
                    <h3 class="font-display mt-2 text-lg font-bold" style="color: var(--color-text)">{{ $service['title'] }}</h3>
                    <p class="mt-2 flex-1 text-sm leading-relaxed" style="color: var(--color-text-muted)">{{ $service['description'] }}</p>
                    <span class="mt-5 inline-flex items-center gap-1.5 text-sm font-medium" style="color: var(--color-accent)">
                        Meer over deze dienst
                        @include('partials.icon', ['name' => 'arrowUpRight', 'size' => 16])
                    </span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<style>
.service-card {
    transition: border-color 0.15s ease, transform 0.15s ease, box-shadow 0.15s ease;
}
@media (hover: hover) and (pointer: fine) {
    .service-card:hover,
    .service-card:focus-visible {
        border-color: var(--color-accent);
        transform: translate(-2px, -2px);
        box-shadow: 4px 4px 0 var(--color-accent);
    }
}
</style>
