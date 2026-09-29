{{-- Submit button with idle / loading / success states (driven by main.js via data-state). --}}
@props(['label', 'sending'])

<button type="submit" {{ $attributes->merge(['class' => 'btn btn-cta']) }} data-submit data-state="idle">
    <span class="btn__spinner" aria-hidden="true"><x-v2::icon name="loader" class="size-5" /></span>
    <span class="btn__label" data-label-idle>{{ $label }}</span>
    <span class="btn__label" data-label-loading hidden>{{ $sending }}</span>
    <x-v2::icon name="arrow-right" class="btn__arrow size-5" />
</button>
