<section data-gsap="section-about" class="reveal-hidden">
    <div class="section-card">
    <div class="max-w-6xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="section-eyebrow mb-4">About</p>
            <h2 class="text-3xl md:text-4xl section-title mb-6">
                One developer.<br>Clear Aim.
            </h2>
            <p class="text-[var(--color-text-muted)] leading-relaxed mb-4">
                Hi, I'm Aymane. As a full-stack developer I guide projects through the entire lifecycle from concept to deployment.
            </p>
            <p class="text-[var(--color-text-muted)] leading-relaxed">
            You collaborate directly with the person creating the product, eliminating miscommunications. I focus on building software that functions beautifully and feels intuitive.
            Every project is built with care.
            </p>
        </div>

        <!-- Tech stack pills -->
        <div class="grid grid-cols-3 gap-3">
            @foreach(['PHP', 'C#', 'React', 'Python', 'Java- & Typescript', 'Inertia', 'REST APIs', 'Stripe', 'Tailwind CSS'] as $tech)
            <div class="card-glow flex items-center justify-center px-3 py-2.5 rounded-md border border-[var(--color-border)] text-xs text-[var(--color-text-muted)] hover:border-[var(--color-accent)]/30 hover:text-[var(--color-text)] transition-all duration-200 text-center">
                {{ $tech }}
            </div>
            @endforeach
        </div>
    </div>
    </div>
</section>
