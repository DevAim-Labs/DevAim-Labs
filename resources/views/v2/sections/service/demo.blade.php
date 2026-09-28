{{--
    Live demo in an A-style dark tech panel (stays dark in both themes).

    Click-to-load facade: the page ships only the screenshot. The iframe is
    created by resources/js/v2/demo-embed.js on "Start live demo", with
    sandbox="allow-scripts allow-forms" (never allow-same-origin: the demos
    are same-origin, so that pair would let them lift the sandbox).

    Per breakpoint (CSS + demo-embed.js):
      >= 1024px   facade, then the inline iframe; optional full screen.
      768-1023px  facade; for desktop-only demos "Open in nieuw tabblad"
                  is the primary action and inline start the secondary.
      <  768px    no iframe: screenshot + full-width "Open de demo".
    The fictional-business label sits outside the frame (badge + note)
    and inside it (the demo's own banner).
--}}
@php
    $d = $s['demo'];
    $u = $ui['demo'];
@endphp

<section class="section svc-demo-section" id="demo" aria-labelledby="demo-title">
    <div class="wrap">
        <div class="tech-panel svc-demo" data-demo
             data-src="{{ $d['embed_src'] }}" data-title="{{ $d['iframe_title'] }}"
             @if ($d['desktop_only']) data-desktop-only @endif>
            <div class="svc-demo__head">
                <div class="svc-demo__heading">
                    <p class="tech-eyebrow">{{ $u['eyebrow'] }}</p>
                    <h2 class="tech-title" id="demo-title">{{ $d['title'] }}</h2>
                </div>
                <span class="tech-tag svc-demo__badge">{{ $u['badge'] }}</span>
                <p class="tech-lede svc-demo__try">{{ $d['try'] }}</p>
            </div>

            <a href="#after-demo" class="svc-skip">{{ $u['skip'] }}</a>

            <div class="svc-demo__frame" data-demo-frame>
                <div class="svc-demo__bar" aria-hidden="true">
                    <span class="browser__dots"><i></i><i></i><i></i></span>
                    <span class="svc-demo__url">{{ $d['url_label'] }}</span>
                </div>
                <div class="svc-demo__stage" data-demo-stage>
                    <img src="{{ asset(ltrim($d['image'], '/')) }}" width="{{ $d['width'] }}" height="{{ $d['height'] }}"
                         alt="{{ $d['alt'] }}" decoding="async" class="svc-demo__poster">
                    <span class="tech-tag svc-demo__stage-badge" aria-hidden="true">{{ $u['badge'] }}</span>
                    <div class="svc-demo__overlay">
                        <button type="button" class="btn btn-blue svc-demo__start" data-demo-start>
                            <x-v2::icon name="play" class="size-5" />
                            {{ $u['start'] }}
                            <span class="sr-only">: {{ $d['business'] }}</span>
                        </button>
                    </div>
                    <p class="svc-demo__loading" data-demo-loading role="status" hidden>
                        <x-v2::icon name="loader" class="size-5 svc-demo__spinner" />
                        {{ $u['loading'] }}
                    </p>
                </div>
            </div>

            <div class="svc-demo__actions">
                <a href="{{ $d['src'] }}" class="btn btn-sm btn-tech svc-demo__open" target="_blank" rel="noopener noreferrer">
                    {{ $u['open_tab'] }}
                    <span class="sr-only">{{ $d['business'] }} {{ $t['a11y']['new_tab'] }}</span>
                    <x-v2::icon name="arrow-up-right" class="size-4" />
                </a>
                <button type="button" class="btn btn-sm btn-tech" data-demo-fullscreen hidden>
                    <x-v2::icon name="maximize" class="size-4" />
                    {{ $u['fullscreen'] }}
                </button>
                <button type="button" class="btn btn-sm btn-tech" data-demo-close hidden>
                    <x-v2::icon name="x" class="size-4" />
                    {{ $u['close'] }}
                </button>
                @if ($d['desktop_only'])
                    <p class="svc-demo__wide">{{ $u['wide'] }}</p>
                @endif
            </div>

            {{-- Below 768px: no iframe, the demo opens as a full page. --}}
            <div class="svc-demo__mobile">
                <a href="{{ $d['src'] }}" class="btn btn-blue svc-demo__mobile-open" target="_blank" rel="noopener noreferrer">
                    {{ $u['open_mobile'] }}
                    <span class="sr-only">{{ $d['business'] }} {{ $t['a11y']['new_tab'] }}</span>
                    <x-v2::icon name="arrow-up-right" class="size-5" />
                </a>
                @if ($d['desktop_only'])
                    <p class="svc-demo__wide">{{ $u['wide'] }}</p>
                @endif
            </div>

            <p class="svc-demo__disclaimer">
                <x-v2::icon name="shield-check" class="size-4" />
                {{ $u['disclaimer'] }}
            </p>
        </div>
        <div id="after-demo" class="svc-after-demo" tabindex="-1"></div>
    </div>
</section>
