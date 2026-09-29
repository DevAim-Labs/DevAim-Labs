{{-- Eyebrow + H2 + optional intro. --}}
@props(['eyebrow' => null, 'title', 'intro' => null, 'id' => null, 'align' => 'left'])

<header {{ $attributes->merge(['class' => 'section-head'.($align === 'center' ? ' section-head--center' : '')]) }} data-reveal>
    @if ($eyebrow)
        <p class="eyebrow">{{ $eyebrow }}</p>
    @endif
    <h2 @if ($id) id="{{ $id }}" @endif class="h2">{{ $title }}</h2>
    @if ($intro)
        <p class="lede">{{ $intro }}</p>
    @endif
</header>
