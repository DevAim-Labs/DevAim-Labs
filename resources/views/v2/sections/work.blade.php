@php
    $w = $t['work'];
@endphp

<section class="section section--tight-bottom" id="{{ $t['ids']['work'] }}" aria-labelledby="work-title">
    <div class="wrap">
        <x-v2::section-head id="work-title" :eyebrow="$w['eyebrow']" :title="$w['title']" :intro="$w['intro']" />

        <div class="cases">
            @foreach ($w['cases'] as $case)
                @include('v2.partials.case-card', ['case' => $case, 'id' => 'case-'.$loop->index])
            @endforeach
        </div>

    </div>
</section>
