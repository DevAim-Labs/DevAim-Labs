<section data-gsap="section-about" class="reveal-hidden border-t border-[--color-border-dim]">
    <div class="max-w-6xl mx-auto px-6 py-24 grid md:grid-cols-2 gap-12 items-center">
        <div>
            <p class="text-xs text-[--color-accent] uppercase tracking-widest mb-4">About</p>
            <h2 class="text-3xl md:text-4xl font-bold tracking-tight text-[--color-text] mb-6" style="letter-spacing: -0.02em;">
                One developer.<br>Full ownership.
            </h2>
            <p class="text-[--color-text-muted] leading-relaxed mb-4">
                I'm Aymane — a full-stack developer who takes projects from idea to deployment. No handoffs, no translation loss. You work directly with the person writing the code.
            </p>
            <p class="text-[--color-text-muted] leading-relaxed">
                Every project is built with care — not just to work, but to feel right. I take on a small number of clients at a time so each one gets the attention it deserves.
            </p>
        </div>

        <!-- Tech stack pills -->
        <div class="grid grid-cols-3 gap-3">
            @foreach(['Laravel', 'Vue 3', 'Tailwind', 'Inertia', 'PostgreSQL', 'Redis', 'REST APIs', 'Stripe', 'Docker'] as $tech)
            <div class="flex items-center justify-center px-3 py-2.5 rounded-md border border-[--color-border] text-xs text-[--color-text-muted] hover:border-[--color-accent]/30 hover:text-[--color-text] transition-all duration-200 text-center">
                {{ $tech }}
            </div>
            @endforeach
        </div>
    </div>
</section>
