{{-- Service hero: breadcrumb, search-intent H1, problem-first sub, CTAs, price line, trust row. --}}
@php $h = $s['hero']; @endphp

<section class="svc-hero" aria-labelledby="page-title" data-hero>
    <div class="wrap svc-hero__inner">
        @include('v2.partials.breadcrumb')

        <p class="eyebrow">{{ $h['eyebrow'] }}</p>
        <h1 class="h1 svc-hero__title" id="page-title">{{ $h['title'] }} <em>{{ $h['title_em'] }}</em></h1>
        <p class="svc-hero__sub">{{ $h['subtitle'] }}</p>

        <div class="svc-hero__actions">
            <a href="#{{ $t['ids']['contact'] }}" class="btn btn-cta" data-preselect="{{ $s['project_type'] }}">
                {{ $ui['cta_primary'] }}
                <x-v2::icon name="arrow-right" class="btn__arrow size-5" />
            </a>
            <a href="#demo" class="link-arrow">
                {{ $s['demo'] ? $ui['cta_demo'] : $ui['cta_flow'] }}
                <x-v2::icon name="arrow-down" class="size-4" />
            </a>
        </div>

        <p class="svc-hero__price">
            <span class="mono-label">{{ $ui['price_label'] }}</span>
            @include('v2.sections.service.price-value')
        </p>

        <ul class="trust-row">
            @foreach ($t['hero']['trust'] as $item)
                <li><x-v2::icon name="check" class="size-4" />{{ $item }}</li>
            @endforeach
        </ul>
    </div>
</section>
