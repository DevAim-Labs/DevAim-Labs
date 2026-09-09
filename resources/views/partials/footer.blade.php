<footer class="mt-8 relative overflow-hidden" style="background: var(--color-surface);">
    <!-- Gradient top border -->
    <div class="absolute top-0 left-0 right-0 h-px" style="background: linear-gradient(90deg, transparent 10%, var(--color-accent), var(--color-violet), transparent 90%);"></div>

    <div class="max-w-6xl mx-auto px-6 py-16 md:py-20">
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
            <!-- Brand column -->
            <div class="sm:col-span-2 lg:col-span-1">
                <p class="font-bold text-xl mb-4" style="color: var(--color-text); font-family: var(--font-sans); letter-spacing: -0.02em;">
                    DevAim Labs<span style="color: var(--color-accent);">.</span>
                </p>
                <p class="text-sm leading-relaxed mb-6" style="color: var(--color-text-muted);">
                    Custom software, websites en integraties. Direct contact met de developers.
                </p>
                <!-- Availability badge -->
                <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-full text-sm font-medium" style="background: var(--color-surface-1); border: 1px solid var(--color-border-dim);">
                    <span class="relative flex items-center justify-center w-2.5 h-2.5">
                        <span class="absolute w-full h-full rounded-full animate-ping" style="background: #22C55E; opacity: 0.75;"></span>
                        <span class="relative w-2 h-2 rounded-full" style="background: #22C55E;"></span>
                    </span>
                    <span style="color: var(--color-text-muted);">Beschikbaar voor projecten</span>
                </div>
            </div>

            <!-- Navigation -->
            <div>
                <p class="text-xs uppercase tracking-wider font-semibold mb-5" style="color: var(--color-text-dim);">Navigatie</p>
                <nav class="flex flex-col gap-3 text-sm" style="color: var(--color-text-muted);">
                    <a href="/over-ons" class="hover:text-[var(--color-accent)] transition-colors duration-200">Over ons</a>
                    <a href="/diensten" class="hover:text-[var(--color-accent)] transition-colors duration-200">Diensten</a>
                    <a href="/werkwijze" class="hover:text-[var(--color-accent)] transition-colors duration-200">Werkwijze</a>
                    <a href="/klantwerk" class="hover:text-[var(--color-accent)] transition-colors duration-200">Klantwerk</a>
                </nav>
            </div>

            <!-- Resources -->
            <div>
                <p class="text-xs uppercase tracking-wider font-semibold mb-5" style="color: var(--color-text-dim);">Resources</p>
                <nav class="flex flex-col gap-3 text-sm" style="color: var(--color-text-muted);">
                    <a href="/veelgestelde-vragen" class="hover:text-[var(--color-accent)] transition-colors duration-200">FAQ</a>
                    <a href="/privacyverklaring" class="hover:text-[var(--color-accent)] transition-colors duration-200">Privacyverklaring</a>
                    <a href="/contact" class="hover:text-[var(--color-accent)] transition-colors duration-200">Contact</a>
                </nav>
            </div>

            <!-- Contact info -->
            <div>
                <p class="text-xs uppercase tracking-wider font-semibold mb-5" style="color: var(--color-text-dim);">Contact</p>
                <div class="space-y-4 text-sm" style="color: var(--color-text-muted);">
                    <a href="mailto:devaimlabs@gmail.com" class="flex items-center gap-3 hover:text-[var(--color-accent)] transition-colors duration-200">
                        <svg class="w-4 h-4 shrink-0" style="color: var(--color-accent);" viewBox="0 -960 960 960" fill="currentColor">
                            <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/>
                        </svg>
                        devaimlabs@gmail.com
                    </a>
                    <a href="tel:+31638523099" class="flex items-center gap-3 hover:text-[var(--color-accent)] transition-colors duration-200">
                        <svg class="w-4 h-4 shrink-0" style="color: var(--color-accent);" viewBox="0 -960 960 960" fill="currentColor">
                            <path d="M798-120q-125 0-247-54.5T329-329Q229-429 174.5-551T120-798q0-18 12-30t30-12h162q14 0 25 9.5t13 22.5l26 140q2 16-1 27t-11 19l-97 98q20 37 47.5 71.5T387-386q31 31 65 57.5t72 48.5l94-94q9-9 23.5-13.5T670-390l138 28q14 4 23 14.5t9 23.5v162q0 18-12 30t-30 12Z"/>
                        </svg>
                        +31 6 38523099
                    </a>
                    <div class="pt-2 space-y-1 text-xs" style="color: var(--color-text-dim);">
                        <p>KvK: 42051464</p>
                        <p>BTW: NL005458933B79</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="mt-12 pt-8" style="border-top: 1px solid var(--color-border-dim);">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
                <div>
                    <p class="font-semibold text-lg mb-1" style="color: var(--color-text); letter-spacing: -0.01em;">
                        Klaar om te beginnen?
                    </p>
                    <p class="text-sm" style="color: var(--color-text-muted);">
                        Laten we samen iets moois bouwen.
                    </p>
                </div>
                <a
                    href="/contact"
                    class="btn-primary inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold self-start sm:self-center"
                    style="box-shadow: 0 8px 24px -8px var(--color-accent-glow);"
                    data-track="cta_click"
                    data-track-label="Start een project"
                    data-track-location="footer"
                >
                    Start een project
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <!-- Bottom bar -->
    <div style="background: var(--color-surface-1); border-top: 1px solid var(--color-border-dim);">
        <div class="max-w-6xl mx-auto px-6 py-5 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-xs" style="color: var(--color-text-dim);">
                &copy; {{ date('Y') }} DevAim Labs. Alle rechten voorbehouden.
            </p>
            <div class="flex items-center gap-6 text-xs" style="color: var(--color-text-dim);">
                <span>Gebouwd met Laravel & Vue</span>
            </div>
        </div>
    </div>
</footer>
