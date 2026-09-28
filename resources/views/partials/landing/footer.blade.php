@php
    $year = date('Y');
    $footerLinks = [
        ['href' => '#over-mij', 'label' => 'Over mij'],
        ['href' => '#diensten', 'label' => 'Diensten'],
        ['href' => '#werkwijze', 'label' => 'Werkwijze'],
        ['href' => '#prijzen', 'label' => 'Prijzen'],
        ['href' => '#contact', 'label' => 'Contact'],
    ];
@endphp
<footer class="border-t py-14" style="border-color: var(--color-border-strong); background: var(--color-surface)">
    <div class="mx-auto max-w-6xl px-6">
        <div class="grid gap-10 md:grid-cols-[1.3fr_1fr_1fr]">
            <div>
                <a href="#top" class="flex items-center gap-2.5" style="color: var(--color-text)">
                    <img src="{{ asset('DevAim_IMG.png') }}" alt="" width="24" height="24" aria-hidden="true" loading="lazy">
                    <span class="font-display font-bold tracking-tight">DevAim Labs</span>
                </a>
                <p class="mt-3 max-w-xs text-sm leading-relaxed" style="color: var(--color-text-muted)">
                    Maatwerksoftware. Van idee tot productie.
                </p>
            </div>

            <div>
                <p class="font-mono text-xs tracking-widest" style="color: var(--color-text-dim)">NAVIGATIE</p>
                <ul class="mt-4 space-y-2.5">
                    @foreach ($footerLinks as $link)
                        <li><a href="{{ $link['href'] }}" class="footer-link text-sm cursor-pointer">{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div>
                <p class="font-mono text-xs tracking-widest" style="color: var(--color-text-dim)">CONTACT</p>
                <ul class="mt-4 space-y-2.5 text-sm">
                    <li>
                        <a href="mailto:contact@devaimlabs.com" class="footer-link inline-flex items-center gap-2 cursor-pointer">
                            @include('partials.icon', ['name' => 'mail', 'size' => 16])
                            contact@devaimlabs.com
                        </a>
                    </li>
                    <li>
                        <a href="tel:+31638523099" class="footer-link inline-flex items-center gap-2 cursor-pointer">
                            @include('partials.icon', ['name' => 'phone', 'size' => 16])
                            +31 6 38 52 30 99
                        </a>
                    </li>
                    <li><a href="/privacyverklaring" class="footer-link cursor-pointer">Privacyverklaring</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 flex flex-col gap-2 border-t pt-6 text-xs sm:flex-row sm:items-center sm:justify-between" style="border-color: var(--color-border-strong); color: var(--color-text-dim)">
            <p>&copy; {{ $year }} DevAim Labs — eenmanszaak</p>
            <p>KvK 42051464 · BTW NL005458933B79</p>
        </div>
    </div>
</footer>

<style>
.footer-link { color: var(--color-text-muted); transition: color 0.15s ease; }
.footer-link:hover, .footer-link:focus-visible { color: var(--color-accent); }
</style>
