@php
    $a = $t['about'];
@endphp

<section class="section section--sand" id="{{ $t['ids']['about'] }}" aria-labelledby="about-title">
    <div class="wrap about">
        {{-- TODO: real photo. Replace the initials plate with an <img> (arched crop, width/height set). --}}
        <div class="about__portrait" data-reveal>
            <div class="plate plate--portrait" role="img" aria-label="{{ $a['photo_alt'] }}">
                <span class="plate__initials" aria-hidden="true">{{ $a['initials'] }}</span>
            </div>
        </div>

        <div class="about__copy">
            <x-v2::section-head id="about-title" :eyebrow="$a['eyebrow']" :title="$a['title']" />
            <div class="prose" data-reveal>
                @foreach ($a['paragraphs'] as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>

            <div class="about__direct" data-reveal>
                <p class="mono-label">{{ $a['direct'] }}</p>
                @include('v2.partials.contact-lines')
            </div>

            <div data-reveal>
                <p class="mono-label">{{ $a['stack_label'] }}</p>
                <ul class="chips chips--mono">
                    @foreach ($a['stack'] as $tool)
                        <li class="chip">{{ $tool }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
