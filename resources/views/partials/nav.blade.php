<header id="site-nav" class="fixed top-0 inset-x-0 z-50 transition-all duration-300" style="--scrolled-bg: rgba(20,20,20,0.9);">
    <nav class="max-w-6xl mx-auto px-6 h-16 flex items-center justify-between">
        <a href="/" class="font-bold tracking-tight text-lg" style="color: #f0f0f0;">
            DevAim<span style="color: #0B8598;">.</span>
        </a>

        <ul class="hidden md:flex items-center gap-8 text-sm" style="color: #888888;">
            <li><a href="#services" class="transition-colors duration-200 hover:text-white" style="color: inherit;">Services</a></li>
            <li><a href="#client-work" class="transition-colors duration-200 hover:text-white" style="color: inherit;">Work</a></li>
            <li><a href="#personal-projects" class="transition-colors duration-200 hover:text-white" style="color: inherit;">Projects</a></li>
            <li><a href="#contact" class="transition-colors duration-200 hover:text-white" style="color: inherit;">Contact</a></li>
        </ul>

        <a href="#contact" class="hidden md:inline-flex items-center gap-2 px-4 py-2 rounded-md border text-sm transition-all duration-200" style="border-color: #0d3a44; color: #0B8598;">
            Let's talk
        </a>

        <!-- Mobile menu button -->
        <button id="mobile-menu-btn" class="md:hidden transition-colors" style="color: #888888;" aria-label="Toggle menu">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
    </nav>

    <!-- Mobile menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t backdrop-blur-md" style="border-color: #082830; background: rgba(20,20,20,0.95);">
        <div class="max-w-6xl mx-auto px-6 py-4 flex flex-col gap-4 text-sm" style="color: #888888;">
            <a href="#services" class="transition-colors hover:text-white">Services</a>
            <a href="#client-work" class="transition-colors hover:text-white">Work</a>
            <a href="#personal-projects" class="transition-colors hover:text-white">Projects</a>
            <a href="#contact" class="transition-colors hover:text-white">Contact</a>
        </div>
    </div>
</header>

<div id="nav-sentinel" class="absolute top-0 h-px w-full pointer-events-none"></div>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
