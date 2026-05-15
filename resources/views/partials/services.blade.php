<section id="services" data-gsap="section-services" class="reveal-hidden">
    <div class="max-w-6xl mx-auto px-6 py-24">
        <div class="mb-16">
            <p class="section-eyebrow mb-3">What I build</p>
            <h2 class="text-4xl section-title">Services</h2>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($services as $service)
            <div class="card-glow group relative p-6 rounded-xl border border-[--color-border] bg-[--color-surface-1] hover:border-[--color-accent]/30 hover:bg-[--color-surface-2] transition-all duration-300">
                <div class="mb-4 text-[--color-accent] text-2xl leading-none select-none">{{ $service['icon'] }}</div>
                <h3 class="font-semibold text-[--color-text] mb-2 text-sm">{{ $service['title'] }}</h3>
                <p class="text-sm text-[--color-text-muted] leading-relaxed">{{ $service['description'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
