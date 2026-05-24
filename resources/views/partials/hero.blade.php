<section id="home" class="hero-section relative min-h-screen flex items-center pt-16 overflow-hidden">

    <!-- Blurred hero background image (WebP + responsive sizes) -->
    <div class="absolute inset-0 pointer-events-none" style="z-index:0;">
        <picture>
            <source type="image/webp"
                    srcset="/heroimage-768.webp 768w, /heroimage-1280.webp 1280w, /heroimage.webp 1920w"
                    sizes="100vw">
            <img src="/heroimage.jpg"
                 alt=""
                 role="presentation"
                 class="hero-bg-img absolute inset-0 w-full h-full object-cover"
                 width="1920"
                 height="1080"
                 fetchpriority="high"
                 decoding="async"
                 style="filter: blur(5px); transform: scale(1.05);">
        </picture>
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

    <div class="hero-content relative">
        <!-- Eyebrow -->
        <div data-gsap="hero-eyebrow" class="hero-eyebrow reveal-hidden inline-flex items-center gap-2 sm:gap-3 uppercase mb-6 sm:mb-8" style="color: var(--color-accent);">
            <span class="w-4 h-px shrink-0" style="background: var(--color-accent);"></span>
            <span>Custom software ontwikkeling</span>
        </div>

        <!-- Headline -->
        <h1 data-gsap="hero-headline" class="hero-headline font-bold mb-5 sm:mb-6" style="color: var(--color-text);">
            Maatwerksoftware<br>
            <span class="text-gradient-accent">gebouwd voor jou.</span>
        </h1>

        <!-- Sub-copy -->
        <p data-gsap="hero-sub" class="hero-sub reveal-hidden mb-8 sm:mb-10" style="color: var(--color-text-muted);">
            Adminpanelen, KPI-dashboards, landingspagina's, Stripe- en Mollie-integraties en API-koppelingen — afgestemd op jouw proces.
        </p>

        <!-- CTAs -->
        <div data-gsap="hero-cta" class="hero-cta reveal-hidden flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 sm:gap-4">
            <a href="/contact" class="btn-primary px-6 py-3 rounded-md font-semibold text-sm" data-track="cta_click" data-track-label="Start een project" data-track-location="hero">
                Start een project
            </a>
            <a href="/diensten" class="btn-outline px-6 py-3 rounded-md text-sm font-medium" data-track="cta_click" data-track-label="Bekijk diensten" data-track-location="hero">
                Bekijk diensten →
            </a>
        </div>
    </div>

    <!-- Bottom fade -->
    <div class="hero-fade absolute bottom-0 inset-x-0 h-32 pointer-events-none"></div>
</section>
