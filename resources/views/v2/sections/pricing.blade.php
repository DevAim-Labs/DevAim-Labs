@php $p = $t['pricing']; @endphp

<section class="section" id="{{ $t['ids']['pricing'] }}" aria-labelledby="pricing-title">
    <div class="wrap">
        <x-v2::section-head id="pricing-title" :eyebrow="$p['eyebrow']" :title="$p['title']" :intro="$p['intro']" />

        <ul class="pricing-grid">
            @foreach ($p['packages'] as $package)
                <li class="card price-card {{ $package['highlighted'] ? 'price-card--featured' : '' }}"
                    aria-labelledby="price-{{ $package['key'] }}-title" data-reveal>
                    @if ($package['highlighted'])
                        <p class="price-card__badge">{{ $p['highlight'] }}</p>
                    @endif
                    <h3 class="h3" id="price-{{ $package['key'] }}-title">{{ $package['name'] }}</h3>
                    <p class="price-card__tagline">{{ $package['tagline'] }}</p>

                    <p class="price-card__price">
                        @if ($package['price_from'] !== null)
                            <span class="price-card__from">{{ $p['from'] }}</span>
                            <span class="price-card__amount">{{ $p['currency'] }} {{ number_format($package['price_from'], 0, ',', '.') }}</span>
                        @else
                            <span class="price-card__request">{{ $p['on_request'] }}</span>
                        @endif
                    </p>

                    <ul class="check-list price-card__features">
                        @foreach ($package['features'] as $feature)
                            <li><x-v2::icon name="check" class="size-4" />{{ $feature }}</li>
                        @endforeach
                    </ul>

                    <a href="#{{ $t['ids']['contact'] }}" class="btn {{ $package['highlighted'] ? 'btn-cta' : 'btn-outline' }} price-card__cta"
                       data-preselect="{{ $package['project_type'] }}">
                        {{ $package['cta'] }}
                        <x-v2::icon name="arrow-right" class="size-5" />
                    </a>
                </li>
            @endforeach
        </ul>

        <p class="pricing-note" data-reveal>
            <x-v2::icon name="shield-check" class="size-5" />
            {{ $p['note'] }}
        </p>
    </div>
</section>
