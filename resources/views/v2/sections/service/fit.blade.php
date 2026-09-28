{{-- Fit check: when this service is (and is not) the right choice. --}}
@php
    $fit = $s['fit'];
    $fu = $ui['fit'];
@endphp

<section class="section section--sand" aria-labelledby="fit-title">
    <div class="wrap">
        <x-v2::section-head id="fit-title" :eyebrow="$fu['eyebrow']" :title="$fu['title']" />

        <div class="svc-fit">
            <div class="card svc-fit__col" data-reveal>
                <h3 class="h3 svc-fit__title">{{ $fu['good'] }}</h3>
                <ul class="svc-fit__list svc-fit__list--good">
                    @foreach ($fit['good'] as $line)
                        <li><x-v2::icon name="check" class="size-5" /><span>{{ $line }}</span></li>
                    @endforeach
                </ul>
            </div>
            <div class="svc-fit__col svc-fit__col--bad" data-reveal>
                <h3 class="h3 svc-fit__title">{{ $fu['bad'] }}</h3>
                <ul class="svc-fit__list svc-fit__list--bad">
                    @foreach ($fit['bad'] as $line)
                        <li><x-v2::icon name="x" class="size-5" /><span>{{ $line }}</span></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</section>
