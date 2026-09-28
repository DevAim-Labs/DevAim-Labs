@php
    $f = $t['footer'];
    $homeLabel = $isHome ? $t['a11y']['home'] : $t['a11y']['home_link'];
    // The nav link that carries the services menu ("Diensten") titles the services column.
    $servicesLabel = collect($navLinks)->firstWhere('menu', true)['label'] ?? null;
@endphp

<footer class="site-footer {{ $minimalChrome ? 'site-footer--minimal' : '' }}" data-footer>
    @unless ($minimalChrome)
        <div class="wrap site-footer__grid">
            <div class="site-footer__brand">
                <a href="{{ $brandHref }}" class="brand" aria-label="{{ $homeLabel }}">
                    <span class="brand__mark" aria-hidden="true">D</span>
                    <span class="brand__word">DevAim <span>Labs</span></span>
                </a>
                <p>{{ $f['tagline'] }}</p>
            </div>

            <nav aria-labelledby="footer-nav-title">
                <p class="footer-title" id="footer-nav-title">{{ $f['nav_title'] }}</p>
                <ul class="footer-links">
                    @foreach ($navLinks as $link)
                        <li><a href="{{ $link['href'] }}" @if ($link['current']) aria-current="page" @endif>{{ $link['label'] }}</a></li>
                    @endforeach
                </ul>
            </nav>

            @if ($servicesLabel)
                <nav aria-labelledby="footer-services-title">
                    <p class="footer-title" id="footer-services-title">{{ $servicesLabel }}</p>
                    <ul class="footer-links">
                        @foreach ($servicesMenu['items'] as $item)
                            <li><a href="{{ $item['href'] }}" @if (! empty($canonicalUrl) && url($item['href']) === $canonicalUrl) aria-current="page" @endif>{{ $item['label'] }}</a></li>
                        @endforeach
                    </ul>
                </nav>
            @endif

            <div>
                <p class="footer-title">{{ $f['contact_title'] }}</p>
                <ul class="footer-links">
                    <li><a href="mailto:{{ $org['email'] }}">{{ $org['email'] }}</a></li>
                    <li><a href="{{ $phoneHref }}">{{ $org['phone'] }}</a></li>
                </ul>
            </div>

            <div>
                <p class="footer-title">{{ $f['legal_title'] }}</p>
                <ul class="footer-links footer-links--meta">
                    <li>{{ $f['kvk'] }}: <span class="mono">{{ $company['kvk'] }}</span></li>
                    <li>{{ $f['btw'] }}: <span class="mono">{{ $company['btw'] }}</span></li>
                    {{-- The privacy statement is Dutch only: announce the target language on /en pages. --}}
                    <li><a href="{{ url($f['privacy']['href']) }}" @if ($locale !== 'nl') hreflang="nl" @endif @if ($pageKey === 'privacy') aria-current="page" @endif>{{ $f['privacy']['label'] }}</a></li>
                    <li><a href="{{ url($f['sitemap']['href']) }}">{{ $f['sitemap']['label'] }}</a></li>
                    <li>
                        <a href="{{ $otherLocaleUrl }}" hreflang="{{ $f['language']['hreflang'] }}" lang="{{ $f['language']['hreflang'] }}">
                            <x-v2::icon name="globe" class="size-4" /> {{ $f['language']['label'] }}
                        </a>
                    </li>
                    <li>
                        <button type="button" class="footer-theme" data-theme-toggle aria-pressed="false">
                            <x-v2::icon name="moon" class="theme-icon theme-icon--moon size-4" />
                            <x-v2::icon name="sun" class="theme-icon theme-icon--sun size-4" />
                            {{ $f['theme'] }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    @endunless
    <div class="wrap site-footer__base">
        <p>&copy; {{ date('Y') }} {{ $org['name'] }}. {{ $f['rights'] }}</p>
    </div>
</footer>
