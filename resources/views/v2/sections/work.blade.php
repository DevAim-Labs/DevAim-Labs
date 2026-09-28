@php
    $w = $t['work'];
@endphp

<section class="section section--tight-bottom" id="{{ $t['ids']['work'] }}" aria-labelledby="work-title">
    <div class="wrap">
        <x-v2::section-head id="work-title" :eyebrow="$w['eyebrow']" :title="$w['title']" :intro="$w['intro']" />

        @include('v2.partials.case-list', ['cases' => $w['cases'], 'id' => 'work-cases'])
    </div>
</section>
