{{-- Pricing: the "vanaf" price (or "Prijs op aanvraag"), what drives the cost, one CTA. --}}
@php
    $pc = $s['pricing'];
    $pu = $ui['pricing'];
@endphp

<section class="section section--sand" id="{{ $t['ids']['pricing'] }}" aria-labelledby="pricing-title">
    <div class="wrap svc-pricing">
        <x-v2::section-head id="pricing-title" :eyebrow="$pu['eyebrow']" :title="$pc['title']" :intro="$pc['intro']" />

        <div class="card svc-price" data-reveal>
            <p class="mono-label">{{ $ui['price_label'] }}</p>
            <p class="svc-price__amount">@include('v2.sections.service.price-value')</p>
            <p class="svc-price__fixed"><x-v2::icon name="shield-check" class="size-5" />{{ $pu['fixed'] }}</p>

            <h3 class="svc-price__drivers-title">{{ $pu['drivers'] }}</h3>
            <ul class="check-list svc-price__drivers">
                @foreach ($pc['drivers'] as $driver)
                    <li><x-v2::icon name="check" class="size-4" />{{ $driver }}</li>
                @endforeach
            </ul>

            @if (! empty($pc['note']))
                <p class="svc-price__note">{{ $pc['note'] }}</p>
            @endif

            <a href="#{{ $t['ids']['contact'] }}" class="btn btn-cta svc-price__cta" data-preselect="{{ $s['project_type'] }}">
                {{ $pu['cta'] }}
                <x-v2::icon name="arrow-right" class="btn__arrow size-5" />
            </a>
        </div>
    </div>
</section>
