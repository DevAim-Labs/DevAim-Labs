{{--
    A real client case: arched logo plate, the brief, what was built and
    (only when set) verifiable results. Pass `case` and a unique `id`.
    Used by the home work section and the service pages.
--}}
@php $labels = $t['work']; @endphp
<article class="card case-card" aria-labelledby="{{ $id }}-title" data-reveal>
    <div class="plate plate--arch plate--case">
        <span class="plate__sun" aria-hidden="true"></span>
        <span class="plate__hills" aria-hidden="true"></span>
        <span class="plate__logo">
            <img src="{{ asset(ltrim($case['image'], '/')) }}" width="{{ $case['width'] }}" height="{{ $case['height'] }}"
                 alt="{{ $case['alt'] }}" loading="lazy" decoding="async">
        </span>
    </div>
    <div class="case-card__body">
        <p class="mono-label">{{ $case['domain'] }}</p>
        <h3 class="h3" id="{{ $id }}-title">{{ $case['name'] }}</h3>
        <ul class="chips" aria-label="{{ $labels['tags_label'] }}">
            @foreach ($case['tags'] as $tag)
                <li class="chip">{{ $tag }}</li>
            @endforeach
        </ul>
        <dl class="case-card__story">
            <div>
                <dt>{{ $labels['problem_label'] }}</dt>
                <dd>{{ $case['problem'] }}</dd>
            </div>
            <div>
                <dt>{{ $labels['built_label'] }}</dt>
                <dd>{{ $case['built'] }}</dd>
            </div>
            @if (! empty($case['results']))
                <div>
                    <dt>{{ $labels['results_label'] }}</dt>
                    <dd>
                        <ul class="check-list">
                            @foreach ($case['results'] as $result)
                                <li><x-v2::icon name="check" class="size-4" />{{ $result }}</li>
                            @endforeach
                        </ul>
                    </dd>
                </div>
            @endif
        </dl>
        <a href="{{ $case['url'] }}" class="link-arrow" target="_blank" rel="noopener noreferrer">
            {{ $labels['live_label'] }}
            <span class="sr-only">{{ $case['name'] }} {{ $t['a11y']['new_tab'] }}</span>
            <x-v2::icon name="arrow-up-right" class="size-4" />
        </a>
    </div>
</article>
