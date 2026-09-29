{{-- Service-specific objections, written out on the page (FAQPage JSON-LD comes from SitePage). --}}
<section class="section" id="{{ $t['ids']['faq'] }}" aria-labelledby="faq-title">
    <div class="wrap faq">
        <x-v2::section-head id="faq-title" :eyebrow="$ui['faq_eyebrow']" :title="$t['faq']['title']" />

        @include('v2.partials.faq-list', ['items' => $s['faq']])

        <p class="faq__more">
            {{ $ui['faq_more'] }}
            <a href="#{{ $t['ids']['contact'] }}" class="link-arrow">{{ $ui['faq_more_link'] }} <x-v2::icon name="arrow-right" class="size-4" /></a>
        </p>
    </div>
</section>
