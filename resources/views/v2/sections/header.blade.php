@php
    $isNl = $locale === 'nl';
    $homeLabel = $isHome ? $t['a11y']['home'] : $t['a11y']['home_link'];
    $nlUrl = $isNl ? ($canonicalUrl ?? $homeUrl) : $otherLocaleUrl;
    $enUrl = $isNl ? $otherLocaleUrl : ($canonicalUrl ?? $homeUrl);
    // Marks the current service page in the services menus.
    $currentPath = ! empty($canonicalUrl) ? parse_url($canonicalUrl, PHP_URL_PATH) : null;
@endphp

<header class="site-header" data-header>
    <div class="wrap site-header__inner">
        <a href="{{ $brandHref }}" class="brand" aria-label="{{ $homeLabel }}">
            @include('v2.partials.brand-mark')
            <span class="brand__word">DevAim <span>Labs</span></span>
        </a>

        @unless ($minimalChrome)
            <nav class="site-nav" aria-label="{{ $t['a11y']['main_nav'] }}">
                <ul>
                    @foreach ($navLinks as $link)
                        @if (! empty($link['menu']))
                            {{--
                                Disclosure menu (not an ARIA menu): a button with
                                aria-expanded that shows a plain list of links.
                                main.js: Esc closes and returns focus, arrow keys
                                move between links, leaving the menu closes it.
                            --}}
                            <li class="nav-menu" data-nav-menu>
                                <button type="button" class="site-nav__link nav-menu__toggle"
                                        aria-expanded="false" aria-controls="services-menu" data-nav-menu-toggle>
                                    {{ $link['label'] }}
                                    <x-v2::icon name="chevron-down" class="nav-menu__chevron size-4" />
                                </button>
                                <div class="nav-menu__panel" id="services-menu" hidden data-nav-menu-panel>
                                    <ul>
                                        @foreach ($servicesMenu['items'] as $item)
                                            <li><a href="{{ $item['href'] }}" class="nav-menu__link" @if ($item['href'] === $currentPath) aria-current="page" @endif>{{ $item['label'] }}</a></li>
                                        @endforeach
                                        <li class="nav-menu__overview">
                                            <a href="{{ $link['href'] }}" class="nav-menu__link">
                                                {{ $servicesMenu['overview'] }}
                                                <x-v2::icon name="arrow-right" class="size-4" />
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @else
                            <li>
                                <a href="{{ $link['href'] }}" class="site-nav__link"
                                   @if ($link['current']) aria-current="page" @endif>{{ $link['label'] }}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        @endunless

        <div class="site-header__actions">
            <div class="lang-switch" role="group" aria-label="{{ $t['a11y']['lang_label'] }}">
                <a href="{{ $nlUrl }}" hreflang="nl" lang="nl" @if ($isNl) aria-current="true" @endif>NL</a>
                <a href="{{ $enUrl }}" hreflang="en" lang="en" @if (! $isNl) aria-current="true" @endif>EN</a>
            </div>

            <button type="button" class="icon-btn" data-theme-toggle aria-pressed="false" aria-label="{{ $t['a11y']['theme'] }}">
                <x-v2::icon name="moon" class="theme-icon theme-icon--moon size-5" />
                <x-v2::icon name="sun" class="theme-icon theme-icon--sun size-5" />
            </button>

            @unless ($minimalChrome)
                <a href="{{ $ctaHref }}" class="btn btn-cta btn-sm site-header__cta">
                    {{ $t['nav']['cta']['label'] }}
                </a>

                <button type="button" class="icon-btn site-header__menu" data-menu-open
                        aria-expanded="false" aria-controls="mobile-menu" aria-label="{{ $t['a11y']['menu_open'] }}">
                    <x-v2::icon name="menu" class="size-6" />
                </button>
            @endunless
        </div>
    </div>
</header>

@unless ($minimalChrome)
    {{-- Mobile sheet menu: focus-trapped dialog, Esc / backdrop / link click closes. --}}
    <div class="sheet" id="mobile-menu" role="dialog" aria-modal="true" aria-labelledby="mobile-menu-title" hidden data-sheet>
        <div class="sheet__backdrop" data-menu-close></div>
        <div class="sheet__panel">
            <div class="sheet__head">
                <p class="sheet__title" id="mobile-menu-title">{{ $t['a11y']['menu_title'] }}</p>
                <button type="button" class="icon-btn" data-menu-close aria-label="{{ $t['a11y']['menu_close'] }}">
                    <x-v2::icon name="x" class="size-6" />
                </button>
            </div>
            <nav aria-label="{{ $t['a11y']['main_nav'] }}">
                <ul class="sheet__links">
                    @foreach ($navLinks as $link)
                        <li>
                            <a href="{{ $link['href'] }}" data-menu-link
                               @if ($link['current']) aria-current="page" @endif>{{ $link['label'] }}</a>
                            @if (! empty($link['menu']))
                                <ul class="sheet__sublinks" aria-label="{{ $link['label'] }}">
                                    @foreach ($servicesMenu['items'] as $item)
                                        <li><a href="{{ $item['href'] }}" data-menu-link @if ($item['href'] === $currentPath) aria-current="page" @endif>{{ $item['label'] }}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </nav>
            <div class="sheet__foot">
                <a href="{{ $ctaHref }}" class="btn btn-cta" data-menu-link>
                    {{ $t['nav']['cta']['label'] }}
                    <x-v2::icon name="arrow-right" class="size-5" />
                </a>
                <a href="{{ $otherLocaleUrl }}" class="sheet__lang" hreflang="{{ $t['footer']['language']['hreflang'] }}" lang="{{ $t['footer']['language']['hreflang'] }}">
                    <x-v2::icon name="globe" class="size-5" />
                    {{ $t['footer']['language']['label'] }}
                </a>
            </div>
        </div>
    </div>
@endunless
