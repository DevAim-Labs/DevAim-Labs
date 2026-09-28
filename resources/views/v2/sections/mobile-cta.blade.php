{{--
    Sticky mobile CTA (below 768px). main.js shows it after the hero and
    hides it while the contact section or footer is in view.
--}}
<div class="mobile-cta" data-mobile-cta hidden>
    <a href="{{ $t['mobile_cta']['href'] }}" class="btn btn-cta mobile-cta__main">
        {{ $t['mobile_cta']['label'] }}
        <x-v2::icon name="arrow-right" class="size-5" />
    </a>
    <a href="#{{ $t['ids']['contact'] }}" class="btn btn-outline mobile-cta__alt">{{ $t['mobile_cta']['secondary'] }}</a>
</div>
