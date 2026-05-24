<section id="about" data-gsap="section-about" class="reveal-hidden">
    <div class="section-card">
    <div class="max-w-6xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="section-eyebrow mb-4">About</p>
            <h2 class="text-3xl md:text-4xl section-title mb-6">
                Fitting software.<br>
            </h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-4">
                We build custom software focusing on your needs. <br> From internal tools and dashboards to public-facing sites and payment flows.
            </p>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-8">
                You work directly with the developer creating your product. Clear communication, aiming to build software that fits how you operate.
            </p>
            <a
                href="#about-us"
                class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-md text-sm font-semibold"
            >
                More about us →
            </a>
        </div>

        <!-- Tech stack pills -->
        <div>
            <p class="flex mb-7 text-xl font-bold justify-center items-center flex-wrap">Our specialization</p>
            <div class="grid grid-cols-3 gap-3">
                @foreach(['Laravel', 'C#', 'React', 'Python', 'Java- & Typescript', 'Inertia', 'REST APIs', 'Stripe & Mollie', 'Tailwind CSS'] as $tech)
                <div class="card-glow flex items-center justify-center px-3 py-2.5 rounded-md border border-[var(--color-border)] text-xs text-[var(--color-text-muted)] hover:border-[var(--color-accent)]/30 hover:text-[var(--color-text)] transition-all duration-200 text-center">
                    {{ $tech }}
                </div>
                @endforeach
            </div>
        </div>
    </div>
    </div>
</section>
