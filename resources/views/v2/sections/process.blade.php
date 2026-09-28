{{--
    Process steps with the scroll-linked line. Home uses $t['process'];
    a service page passes `process` (eyebrow, title, intro, steps with an
    optional `time`) and its own `sectionId`.
--}}
@php
    $p = $process ?? $t['process'];
    $sectionId = $sectionId ?? $t['ids']['process'];
    $count = count($p['steps']);
@endphp

<section class="section" id="{{ $sectionId }}" aria-labelledby="process-title">
    <div class="wrap">
        <x-v2::section-head id="process-title" :eyebrow="$p['eyebrow']" :title="$p['title']" :intro="$p['intro']" />

        <div class="process {{ $count === 4 ? 'process--4' : '' }}">
            {{-- Connecting line; scroll-linked by resources/js/v2/process-line.js. --}}
            <span class="process__line" aria-hidden="true" data-process-line><span class="process__line-fill" data-process-line-fill></span></span>
            <ol class="process__steps">
                @foreach ($p['steps'] as $step)
                    <li class="process__step" data-reveal data-process-step>
                        <span class="process__num" aria-hidden="true">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        <h3 class="h3">{{ $step['title'] }}</h3>
                        @if (! empty($step['time']))
                            <p class="process__time mono-label">{{ $step['time'] }}</p>
                        @endif
                        <p>{{ $step['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
