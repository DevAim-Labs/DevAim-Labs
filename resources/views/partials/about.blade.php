<section id="about" data-gsap="section-about" class="reveal-hidden">
    <div class="section-card">
    <div class="max-w-6xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="section-eyebrow mb-4">Over ons</p>
            <h2 class="text-3xl md:text-4xl section-title mb-6">
                Korte lijnen, van gesprek tot livegang.
            </h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-4">
                Wij zijn het team dat jouw adminpaneel, dashboard of integratie bouwt, zonder accountmanager en zonder wisselende contactpersonen ertussen. Wat je met ons bespreekt, is ook precies wat er gebouwd wordt.
            </p>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-8">
                Dat betekent kortere lijnen, sneller schakelen als iets verandert, en een vaste scope en planning voordat we beginnen. Geen verrassingen halverwege.
            </p>
            <a
                href="/contact"
                class="btn-primary hidden md:inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                data-track="cta_click"
                data-track-label="Praat met ons"
                data-track-location="about"
            >
                Praat met ons →
            </a>
        </div>

        <div>
            <p class="text-sm font-semibold mb-4" style="color: var(--color-text-muted);">Werkt met</p>
            <div class="flex flex-wrap gap-2">
                @foreach(['Laravel', 'C#', 'React', 'Python', 'Java', 'TypeScript', 'Inertia', 'REST API\'s', 'Stripe', 'Mollie', 'Tailwind CSS'] as $tech)
                <span class="px-3 py-1.5 rounded-full border text-xs" style="border-color: var(--color-border); color: var(--color-text-dim);">
                    {{ $tech }}
                </span>
                @endforeach
            </div>
        </div>

        <div class="inline-flex md:hidden justify-center">
            <a
                href="/contact"
                class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
                data-track="cta_click"
                data-track-label="Praat met ons"
                data-track-location="about"
            >
                Praat met ons →
            </a>
        </div>


    </div>
    </div>
</section>
