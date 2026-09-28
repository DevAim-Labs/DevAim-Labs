@php
    $navLinks = [
        ['href' => '#over-mij', 'label' => 'Over mij'],
        ['href' => '#diensten', 'label' => 'Diensten'],
        ['href' => '#werkwijze', 'label' => 'Werkwijze'],
        ['href' => '#prijzen', 'label' => 'Prijzen'],
        ['href' => '#contact', 'label' => 'Contact'],
    ];
@endphp
<header id="site-nav" class="landing-nav fixed inset-x-0 top-0 z-50 border-b border-transparent">
    <nav class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4" aria-label="Hoofdnavigatie">
        <a href="#top" class="flex items-center gap-2.5 shrink-0" style="color: var(--color-text)">
            <img src="{{ asset('DevAim_IMG.png') }}" alt="" width="28" height="28" aria-hidden="true" loading="eager">
            <span class="font-display font-bold tracking-tight text-base">DevAim Labs</span>
        </a>

        <ul class="hidden md:flex items-center gap-8">
            @foreach($navLinks as $link)
                <li><a href="{{ $link['href'] }}" class="nav-link text-sm font-medium cursor-pointer">{{ $link['label'] }}</a></li>
            @endforeach
        </ul>

        <a href="#contact" class="btn-hover btn-hover-primary hidden md:inline-flex cursor-pointer">
            <span class="btn-hover__dot" aria-hidden="true"></span>
            <span class="btn-hover__label">Start een project</span>
            <span class="btn-hover__reveal" aria-hidden="true">
                Start een project
                @include('partials.icon', ['name' => 'arrowRight', 'size' => 16])
            </span>
        </a>

        <button type="button" id="nav-menu-toggle" class="md:hidden inline-flex h-11 w-11 items-center justify-center cursor-pointer" style="color: var(--color-text); border: 1px solid var(--color-border-strong)" aria-expanded="false" aria-controls="mobile-menu" aria-label="Menu">
            @include('partials.icon', ['name' => 'menu', 'size' => 22])
        </button>
    </nav>

    <div id="mobile-menu" class="landing-mobile-menu md:hidden border-t px-6 py-4" style="background: var(--color-surface-1); border-color: var(--color-border-strong)" hidden>
        <ul class="flex flex-col gap-1">
            @foreach($navLinks as $link)
                <li><a href="{{ $link['href'] }}" class="block px-3 py-3 text-sm font-medium cursor-pointer" style="color: var(--color-text); min-height: 44px">{{ $link['label'] }}</a></li>
            @endforeach
        </ul>
        <a href="#contact" class="btn-hover btn-hover-primary mt-3 w-full justify-center cursor-pointer">
            <span class="btn-hover__dot" aria-hidden="true"></span>
            <span class="btn-hover__label">Start een project</span>
            <span class="btn-hover__reveal" aria-hidden="true">
                Start een project
                @include('partials.icon', ['name' => 'arrowRight', 'size' => 16])
            </span>
        </a>
    </div>
</header>

<style>
.landing-nav {
    /* Solid, not blurred glass — the editorial/brutalist language uses
       hard edges, so the nav simply gains a visible bottom border. */
    transition: background-color 0.15s ease, border-color 0.15s ease;
}
.landing-nav.is-scrolled {
    background: var(--color-surface);
    border-color: var(--color-border-strong);
}
.nav-link {
    color: var(--color-text-muted);
    transition: color 0.15s ease;
}
.nav-link:hover,
.nav-link:focus-visible {
    color: var(--color-text);
}
</style>
