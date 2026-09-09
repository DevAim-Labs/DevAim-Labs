<section id="home" class="hero-section">

    <!-- Gradient mesh background -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true">
        <!-- Subtle gradient orbs -->
        <div class="hero-orb absolute" style="left: 15%; top: 20%; opacity: 0.6;" data-parallax-speed="0.3"></div>
        <div class="hero-orb-violet absolute" style="right: 10%; bottom: 30%; opacity: 0.5;" data-parallax-speed="0.5"></div>
    </div>


    <div class="hero-content relative z-10">
        @if(!empty($breadcrumbs) && count($breadcrumbs) > 1)
        <nav aria-label="Breadcrumb" class="mb-6">
            <ol class="flex flex-wrap items-center justify-center gap-x-2 gap-y-1 text-xs">
                @foreach($breadcrumbs as $i => $crumb)
                    @if($i > 0)
                        <li aria-hidden="true" style="color: var(--color-text-dim);">/</li>
                    @endif
                    <li>
                        @if($i === count($breadcrumbs) - 1)
                            <span aria-current="page" style="color: var(--color-text-muted);">{{ $crumb['name'] }}</span>
                        @else
                            <a href="{{ $crumb['path'] }}" class="hover:underline" style="color: var(--color-text-dim);">{{ $crumb['name'] }}</a>
                        @endif
                    </li>
                @endforeach
            </ol>
        </nav>
        @endif

        <!-- Availability Badge -->
        <div data-gsap="hero-badge" class="mb-8" id="hero-availability-mount"></div>

        <!-- Headline -->
        <h1 data-gsap="hero-headline" class="hero-headline mb-6" style="font-family: var(--font-sans);">
            <span style="color: var(--color-text);">Maatwerksoftware.</span><br>
            <span class="text-gradient-premium">Van idee tot productie.</span>
        </h1>

        <!-- Sub-copy -->
        <p data-gsap="hero-sub" class="hero-sub mb-8">
            Direct contact met de developers die bouwen.<br class="hidden sm:inline">
            Geen account managers. Reactie binnen 24 uur.
        </p>

        <!-- CTAs -->
        <div data-gsap="hero-cta" class="hero-cta-group">
            <a href="/contact"
               class="btn-primary magnetic-trigger inline-flex items-center px-8 py-4 rounded-xl font-semibold text-base shadow-lg"
               data-track="cta_click"
               data-track-label="Start een project"
               data-track-location="hero"
               style="box-shadow: 0 8px 32px -8px var(--color-accent-glow);">
                Start een project
                <svg class="ml-2 w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
            <a href="/werkwijze"
               class="btn-outline magnetic-trigger inline-flex items-center px-8 py-4 rounded-xl text-base font-medium"
               data-track="cta_click"
               data-track-label="Bekijk werkwijze"
               data-track-location="hero">
                Bekijk werkwijze
            </a>
        </div>

        <!-- Scroll indicator -->
        <div data-gsap="hero-scroll" class="mt-16 flex flex-col items-center gap-2" style="color: var(--color-text-dim);">
            <span class="text-xs uppercase tracking-wider">Scroll</span>
            <div class="w-5 h-8 rounded-full border border-current flex items-start justify-center p-1">
                <div class="w-1 h-2 rounded-full bg-current animate-bounce"></div>
            </div>
        </div>
    </div>

    <!-- Bottom fade -->
    <div class="hero-fade"></div>
</section>

<script type="module">
import { createApp, h } from 'vue';
import AvailabilityBadge from '@/components/ui/AvailabilityBadge.vue';

const mount = document.getElementById('hero-availability-mount');
if (mount) {
    createApp({
        render: () => h(AvailabilityBadge, {
            text: 'Beschikbaar voor nieuwe projecten'
        })
    }).mount(mount);
}
</script>
