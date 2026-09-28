@php $h = $t['hero']; @endphp

<section class="hero" id="top" aria-labelledby="hero-title" data-hero>
    <div class="wrap hero__grid">
        <div class="hero__copy">
            <p class="badge-available" data-reveal>
                <span class="pulse-dot" aria-hidden="true"></span>
                {{ $h['badge'] }}
            </p>

            <p class="eyebrow" data-reveal>{{ $h['eyebrow'] }}</p>
            <h1 id="hero-title" class="h1" data-reveal>
                {{ $h['title'] }} <em>{{ $h['title_em'] }}</em>
            </h1>
            <p class="hero__sub" data-reveal>{{ $h['subtitle'] }}</p>

            <ul class="trust-row" data-reveal>
                @foreach ($h['trust'] as $item)
                    <li><x-v2::icon name="check" class="size-4" />{{ $item }}</li>
                @endforeach
            </ul>

            {{-- Inline 2-field website check (direction C). --}}
            <x-v2::form-shell id="hero-check" type="website_check" :locale="$locale" :t="$t"
                              :success="$t['forms']['success_check']" class="hero-form" data-reveal
                              aria-labelledby="hero-form-title">
                <p class="hero-form__title" id="hero-form-title">{{ $h['form']['title'] }}</p>
                <div class="hero-form__row">
                    <x-v2::field form="hero-check" name="scan_url" type="url" :label="$h['form']['url_label']"
                                 :placeholder="$h['form']['url_placeholder']" inputmode="url" autocomplete="url" required />
                    <x-v2::field form="hero-check" name="email" type="email" :label="$h['form']['email_label']"
                                 :placeholder="$h['form']['email_placeholder']" inputmode="email" autocomplete="email" required />
                </div>
                <div class="hero-form__actions">
                    <x-v2::submit :label="$h['form']['submit']" :sending="$t['forms']['sending']" />
                    <a href="{{ $h['secondary']['href'] }}" class="link-arrow">
                        {{ $h['secondary']['label'] }}
                        <x-v2::icon name="arrow-right" class="size-4" />
                    </a>
                </div>
                <p class="form-note">{{ $h['form']['note'] }}</p>
            </x-v2::form-shell>
        </div>

        <div class="hero__visual" data-reveal>
            @php $m = $h['mock']; @endphp
            {{-- Illustration of the lead flow: visitor → enquiry → dashboard.
                 A generic business site, deliberately not client work. --}}
            <figure class="browser" role="img" aria-label="{{ $m['aria'] }}">
                <div class="browser__bar" aria-hidden="true">
                    <span class="browser__dots"><i></i><i></i><i></i></span>
                    <span class="browser__url">{{ $m['url'] }}</span>
                </div>
                <div class="mock-site" aria-hidden="true">
                    <div class="mock-site__nav">
                        <strong>{{ $m['brand'] }}</strong>
                        <span>@foreach ($m['nav'] as $item)<i>{{ $item }}</i>@endforeach</span>
                    </div>
                    <div class="mock-site__hero">
                        <div class="mock-site__copy">
                            <p class="mock-site__title">{{ $m['title'] }}</p>
                            <p class="mock-site__text">{{ $m['text'] }}</p>
                            <span class="mock-site__btn">{{ $m['button'] }}</span>
                        </div>
                        <div class="mock-site__art">
                            <span class="plate__sun"></span>
                            <span class="plate__hills"></span>
                        </div>
                    </div>
                    <div class="mock-site__tiles">
                        @foreach ($m['tiles'] as $tile)
                            <span><i></i>{{ $tile }}</span>
                        @endforeach
                    </div>
                </div>
            </figure>

            <div class="hero-toast" aria-hidden="true">
                <span class="hero-toast__icon"><x-v2::icon name="check" class="size-4" /></span>
                <span class="hero-toast__body">
                    <strong>{{ $m['toast_title'] }}</strong>
                    <span>{{ $m['toast_meta'] }}</span>
                </span>
                <span class="hero-toast__time">{{ $m['toast_time'] }}</span>
            </div>

            {{-- Small A-style tech card with clearly labelled example data. --}}
            <div class="tech-card hero__tech" role="group" aria-label="{{ $h['tech']['caption'] }}">
                <div class="tech-card__top">
                    <span class="tech-tag">{{ $h['tech']['label'] }}</span>
                </div>
                <div class="tech-paid">
                    <span>{{ $h['tech']['order'] }}</span>
                    <b class="tech-chip">{{ $h['tech']['status'] }}</b>
                </div>
                <div class="tech-kpi">
                    <span class="tech-kpi__label">{{ $h['tech']['kpi_label'] }}</span>
                    <span class="tech-kpi__value" data-countup>{{ $h['tech']['kpi_value'] }}<em>{{ $h['tech']['kpi_delta'] }}</em></span>
                    <span class="tech-bars" aria-hidden="true">
                        @foreach ([40, 55, 48, 70, 62, 88, 100] as $bar)
                            <i style="height: {{ $bar }}%"></i>
                        @endforeach
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>
