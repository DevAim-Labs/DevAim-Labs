<section id="about" data-gsap="section-about" class="reveal-hidden">
    <div class="section-card">
    <div class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="section-eyebrow mb-4">Over ons</p>
            <h2 class="text-3xl md:text-4xl section-title mb-6">
                Software die past.<br>
            </h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-4">
                Wij bouwen maatwerksoftware voor bedrijven met duidelijke doelen. <br> Van interne tools en KPI-dashboards tot landingspagina's en betaalstromen.
            </p>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-8">
                Je werkt direct met de developer die jouw product bouwt. Heldere communicatie, met software die aansluit op hoe jij werkt.
            </p>
            <a
                href="/contact"
                class="btn-primary hidden md:inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                data-track="cta_click"
                data-track-label="Meer informatie"
                data-track-location="about"
            >
                Meer informatie →
            </a>
        </div>

        <div>
            <p class="flex mb-7 text-xl font-bold justify-center items-center flex-wrap">Onze specialisaties</p>
            <div class="grid grid-cols-3 gap-3">
                @foreach(['Laravel', 'C#', 'React', 'Python', 'Java & TypeScript', 'Inertia', 'REST API\'s', 'Stripe & Mollie', 'Tailwind CSS'] as $tech)
                <div class="card-glow flex items-center justify-center px-3 py-2.5 rounded-md border border-[var(--color-border)] text-xs text-[var(--color-text-muted)] hover:border-[var(--color-accent)]/30 hover:text-[var(--color-text)] transition-all duration-200 text-center">
                    {{ $tech }}
                </div>
                @endforeach
            </div>
        </div>

        <div class="inline-flex md:hidden justify-center">
            <a
                href="/contact"
                class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                data-track="cta_click"
                data-track-label="Meer informatie"
                data-track-location="about"
            >
                Meer informatie →
            </a>
        </div>


    </div>
    </div>
</section>
