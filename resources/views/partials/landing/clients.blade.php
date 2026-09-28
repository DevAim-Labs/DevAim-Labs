@php
    $clients = [
        ['name' => 'Lokanta Proeflokaal', 'logo' => asset('lokanta.webp'), 'href' => 'https://lokanta-proeflokaal.nl'],
        ['name' => 'Slowdown Store', 'logo' => asset('slowdown.webp'), 'href' => 'https://slowdownstore.com'],
    ];
@endphp
<section id="klanten" data-gsap="section-clients" class="py-20 md:py-24 border-y" style="border-color: var(--color-border-strong)">
    <div class="mx-auto max-w-6xl px-6">
        <div class="flex items-center justify-between gap-4">
            <div>
                <p class="font-mono text-sm tracking-widest" style="color: var(--color-text-dim)">[ 03 — EERDERE KLANTEN ]</p>
                <p class="mt-2 text-sm" style="color: var(--color-text-muted)">Een blik in eerder opgeleverd werk.</p>
            </div>
            <button type="button" id="marquee-pause-toggle" class="inline-flex h-11 w-11 shrink-0 items-center justify-center cursor-pointer" style="border: 1px solid var(--color-border-strong); color: var(--color-text-muted)" aria-pressed="false" aria-label="Pauzeer logo-animatie">
                <span data-icon-pause>@include('partials.icon', ['name' => 'pause', 'size' => 18])</span>
                <span data-icon-play hidden>@include('partials.icon', ['name' => 'play', 'size' => 18])</span>
            </button>
        </div>

        <div class="marquee-container mt-10" id="clients-marquee">
            <div class="marquee-track" id="clients-marquee-track">
                @foreach ($clients as $client)
                    <a href="{{ $client['href'] }}" target="_blank" rel="noopener noreferrer" class="logo-link cursor-pointer" aria-label="{{ $client['name'] }} (opent in nieuw tabblad)">
                        <img src="{{ $client['logo'] }}" alt="{{ $client['name'] }}" class="logo-img" loading="lazy">
                    </a>
                @endforeach
                {{-- Duplicate set so the -50% translate loop is seamless. --}}
                @foreach ($clients as $client)
                    <a href="{{ $client['href'] }}" target="_blank" rel="noopener noreferrer" class="logo-link cursor-pointer" aria-hidden="true" tabindex="-1">
                        <img src="{{ $client['logo'] }}" alt="" class="logo-img" loading="lazy">
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
.marquee-container {
    overflow: hidden;
    mask-image: linear-gradient(90deg, transparent 0%, black 10%, black 90%, transparent 100%);
    -webkit-mask-image: linear-gradient(90deg, transparent 0%, black 10%, black 90%, transparent 100%);
}
.marquee-track {
    display: flex;
    align-items: center;
    width: max-content;
    gap: 6rem;
    animation: marquee-scroll 22s linear infinite;
}
.marquee-track.paused { animation-play-state: paused; }
@keyframes marquee-scroll {
    from { transform: translateX(0); }
    to { transform: translateX(-50%); }
}
.logo-link { display: flex; align-items: center; justify-content: center; flex-shrink: 0; padding: 0.5rem 1rem; }
.logo-img { height: 3rem; width: auto; max-width: 180px; object-fit: contain; opacity: 0.6; transition: opacity 0.3s ease; }
.logo-link:hover .logo-img, .logo-link:focus-visible .logo-img { opacity: 1; }
@media (min-width: 768px) {
    .marquee-track { gap: 8rem; }
    .logo-img { height: 3.5rem; max-width: 200px; }
}
@media (prefers-reduced-motion: reduce) {
    .marquee-track { animation: none; }
}
</style>
