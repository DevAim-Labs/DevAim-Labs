<section class="hero-section relative min-h-screen flex items-center pt-16 overflow-hidden">

    <!-- Blurred hero background image -->
    <div class="absolute inset-0 pointer-events-none" style="z-index:0;">
        <img src="{{ Vite::asset('resources/assets/heroimage.jpg') }}"
             alt=""
             class="absolute inset-0 w-full h-full object-cover"
             style="filter: blur(5px); transform: scale(1.05); opacity: 0.18;">
    </div>

    <!-- Pulsing orb (right side, behind shapes) -->
    <div class="hero-orb absolute pointer-events-none" style="right: -60px; top: 50%; transform: translateY(-50%);"></div>

    <!-- Floating 3D cubes — desktop only -->
    <div class="absolute inset-0 pointer-events-none hidden md:block" aria-hidden="true">

        <!-- Large cyan cube, top right -->
        <div style="position:absolute; right:7%; top:10%; animation:shape-float-a 7s ease-in-out infinite;">
            <div class="hero-cube" style="width:155px; height:155px; --cube-half:77.5px; animation:cube-rotate-a 20s linear infinite;">
                <div class="face face-front"></div>
                <div class="face face-back"></div>
                <div class="face face-right"></div>
                <div class="face face-left"></div>
                <div class="face face-top"></div>
                <div class="face face-bottom"></div>
            </div>
        </div>

        <!-- Medium violet cube, mid right -->
        <div style="position:absolute; right:26%; top:54%; animation:shape-float-b 9s ease-in-out infinite 1.5s;">
            <div class="hero-cube violet" style="width:105px; height:105px; --cube-half:52.5px; animation:cube-rotate-b 25s linear infinite 2s;">
                <div class="face face-front"></div>
                <div class="face face-back"></div>
                <div class="face face-right"></div>
                <div class="face face-left"></div>
                <div class="face face-top"></div>
                <div class="face face-bottom"></div>
            </div>
        </div>

        <!-- Small cyan cube, bottom right, partially clipped -->
        <div style="position:absolute; right:2%; bottom:14%; opacity:0.6; animation:shape-float-c 6s ease-in-out infinite 0.8s;">
            <div class="hero-cube" style="width:72px; height:72px; --cube-half:36px; animation:cube-rotate-a 15s linear infinite 3s;">
                <div class="face face-front"></div>
                <div class="face face-back"></div>
                <div class="face face-right"></div>
                <div class="face face-left"></div>
                <div class="face face-top"></div>
                <div class="face face-bottom"></div>
            </div>
        </div>

    </div>

    <div class="relative max-w-6xl mx-auto px-6 py-24">
        <!-- Eyebrow -->
        <div data-gsap="hero-eyebrow" class="reveal-hidden inline-flex items-center gap-3 text-xs uppercase tracking-widest mb-8" style="color: var(--color-accent);">
            <span class="w-4 h-px" style="background: var(--color-accent);"></span>
            Full-stack developer
        </div>

        <!-- Headline -->
        <h1 data-gsap="hero-headline" class="reveal-hidden text-5xl md:text-7xl font-bold leading-[1.05] mb-6 max-w-4xl" style="letter-spacing: -0.03em; color: var(--color-text);">
            Building software<br>
            <span class="text-gradient-accent">that moves fast.</span>
        </h1>

        <!-- Sub-copy -->
        <p data-gsap="hero-sub" class="reveal-hidden text-lg max-w-xl mb-10 leading-relaxed" style="color: var(--color-text-muted);">
            Custom web applications built around your goals. Development with aim, not just output.
        </p>

        <!-- CTAs -->
        <div data-gsap="hero-cta" class="reveal-hidden flex flex-wrap items-center gap-4">
            <a href="#contact" class="px-6 py-3 rounded-md font-semibold text-sm transition-colors duration-200" style="background: var(--color-accent); color: var(--color-surface);">
                Start a project
            </a>
            <a href="#client-work" class="px-6 py-3 rounded-md border text-sm transition-all duration-200" style="border-color: var(--color-border); color: var(--color-text-muted);">
                See my work →
            </a>
        </div>
    </div>

    <!-- Bottom fade -->
    <div class="hero-fade absolute bottom-0 inset-x-0 h-32 pointer-events-none"></div>
</section>
