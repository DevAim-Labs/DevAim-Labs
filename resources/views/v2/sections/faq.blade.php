@php $f = $t['faq']; @endphp

<section class="section" id="{{ $t['ids']['faq'] }}" aria-labelledby="faq-title">
    <div class="wrap faq">
        <x-v2::section-head id="faq-title" :eyebrow="$f['eyebrow']" :title="$f['title']" />

        @include('v2.partials.faq-list', ['items' => $f['items']])

        <p class="faq__more">
            {{ $f['more'] }}
            <a href="#{{ $t['ids']['contact'] }}" class="link-arrow">{{ $f['more_link'] }} <x-v2::icon name="arrow-right" class="size-4" /></a>
        </p>
    </div>
</section>
