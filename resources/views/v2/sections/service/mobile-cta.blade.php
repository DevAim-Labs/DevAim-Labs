{{-- Sticky mobile CTA on service pages (below 768px); same behaviour as the home bar (main.js). --}}
<div class="mobile-cta" data-mobile-cta hidden>
    <a href="#{{ $t['ids']['contact'] }}" class="btn btn-cta mobile-cta__main" data-preselect="{{ $service['project_type'] }}">
        {{ $service['ui']['mobile_cta'] }}
        <x-v2::icon name="arrow-right" class="size-5" />
    </a>
    <a href="#demo" class="btn btn-outline mobile-cta__alt">{{ $service['ui']['mobile_demo'] }}</a>
</div>
