{{-- "Wat u krijgt": 4-6 deliverables, each tied to something visible in the demo where possible. --}}
@php
    $dl = $s['deliverables'];
    $hintLabel = $s['demo'] ? $ui['demo_hint'] : $ui['flow_hint'];
@endphp

<section class="section" aria-labelledby="deliverables-title">
    <div class="wrap">
        <x-v2::section-head id="deliverables-title" :eyebrow="$ui['deliverables_eyebrow']" :title="$dl['title']" :intro="$dl['intro']" />

        <ul class="svc-deliverables">
            @foreach ($dl['items'] as $item)
                <li class="card svc-deliverable" data-reveal>
                    <span class="service-card__icon"><x-v2::icon :name="$item['icon']" class="size-6" /></span>
                    <h3 class="h3">{{ $item['title'] }}</h3>
                    <p class="svc-deliverable__text">{{ $item['text'] }}</p>
                    @if (! empty($item['demo']))
                        <p class="svc-deliverable__hint">
                            <span class="mono-label">{{ $hintLabel }}</span>
                            <span>{{ $item['demo'] }}</span>
                        </p>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</section>
