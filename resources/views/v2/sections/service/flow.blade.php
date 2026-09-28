{{--
    API integrations: no demo (an integration has no UI of its own), so an
    illustrated data flow with an example sync log instead, in the same
    dark tech panel as the demos.

    Motion (resources/js/v2/sync-flow.js + v2.css): dots travel along the
    wires (CSS transform), the log re-plays its rows. Pause/play button
    (WCAG 2.2.2), stops off-screen, static and complete under reduced
    motion. The log is not a live region; the diagram has a text label.
--}}
@php
    $f = $s['flow'];
    $u = $ui['flow'];
    $n = $f['nodes'];
    $targetIcons = ['book-open', 'users'];
@endphp

<section class="section svc-demo-section" id="demo" aria-labelledby="demo-title">
    <div class="wrap">
        <div class="tech-panel svc-demo svc-flow" data-flow>
            <div class="svc-demo__head">
                <div class="svc-demo__heading">
                    <p class="tech-eyebrow">{{ $f['eyebrow'] }}</p>
                    <h2 class="tech-title" id="demo-title">{{ $f['title'] }}</h2>
                </div>
                <div class="svc-flow__controls">
                    <span class="tech-tag">{{ $u['badge'] }}</span>
                    <button type="button" class="svc-flow__toggle" data-flow-toggle aria-pressed="false"
                            aria-label="{{ $u['pause'] }}" data-label-pause="{{ $u['pause'] }}" data-label-play="{{ $u['play'] }}">
                        <x-v2::icon name="pause" class="size-4 svc-flow__icon-pause" />
                        <x-v2::icon name="play" class="size-4 svc-flow__icon-play" />
                    </button>
                </div>
                <p class="tech-lede svc-demo__try">{{ $f['try'] }}</p>
            </div>

            <div class="svc-flow__diagram" role="img" aria-label="{{ $f['diagram_label'] }}">
                <div class="flow-node flow-node--source">
                    <span class="flow-node__icon"><x-v2::icon name="shopping-bag" class="size-5" /></span>
                    <span class="flow-node__title">{{ $n['source']['title'] }}</span>
                    <span class="flow-node__meta">{{ $n['source']['meta'] }}</span>
                </div>
                <span class="flow-wire flow-wire--a"><i class="flow-dot"></i></span>
                <div class="flow-node flow-node--hub">
                    <span class="flow-node__icon"><x-v2::icon name="workflow" class="size-5" /></span>
                    <span class="flow-node__title">{{ $n['hub']['title'] }}</span>
                    <span class="flow-node__meta">{{ $n['hub']['meta'] }}</span>
                </div>
                @foreach ($n['targets'] as $target)
                    <span class="flow-wire flow-wire--out flow-wire--{{ $loop->iteration }}"><i class="flow-dot"></i></span>
                    <div class="flow-node flow-node--target flow-node--t{{ $loop->iteration }}">
                        <span class="flow-node__icon"><x-v2::icon :name="$targetIcons[$loop->index] ?? 'check'" class="size-5" /></span>
                        <span class="flow-node__title">{{ $target['title'] }}</span>
                        <span class="flow-node__meta">{{ $target['meta'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="svc-flow__log">
                <p class="svc-flow__log-head">
                    <span>{{ $f['log_title'] }}</span>
                    <span class="tech-tag">{{ $u['badge'] }}</span>
                </p>
                <ol class="flow-log" aria-label="{{ $f['log_label'] }}" data-flow-log>
                    @foreach ($f['log'] as $row)
                        <li class="flow-log__row flow-log__row--{{ $row['status'] }}" data-flow-row>
                            <span class="flow-log__time">{{ $row['time'] }}</span>
                            <span class="flow-log__text">
                                <span class="flow-log__event">{{ $row['event'] }}</span>
                                <span class="flow-log__result">{{ $row['result'] }}</span>
                            </span>
                            <span class="flow-log__status">
                                <x-v2::icon :name="$row['status'] === 'retry' ? 'refresh' : 'check'" class="size-4" />
                                {{ $f['status'][$row['status']] }}
                            </span>
                        </li>
                    @endforeach
                </ol>
            </div>

            <div class="svc-flow__compare">
                <p class="svc-flow__state svc-flow__state--before">
                    <span class="tech-kpi__label">{{ $f['before']['label'] }}</span>
                    {{ $f['before']['text'] }}
                </p>
                <p class="svc-flow__state svc-flow__state--after">
                    <span class="tech-kpi__label">{{ $f['after']['label'] }}</span>
                    {{ $f['after']['text'] }}
                </p>
            </div>
        </div>
    </div>
</section>
