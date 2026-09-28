{{-- One client row in the case list: summary line, opens to the story. --}}
<details class="case-row" @if ($open) open @endif>
    <summary class="case-row__summary">
        <span class="case-row__logo">
            <img src="{{ asset(ltrim($case['image'], '/')) }}" width="{{ $case['width'] }}" height="{{ $case['height'] }}"
                 alt="{{ $case['alt'] }}" loading="lazy" decoding="async">
        </span>
        <span class="case-row__name">
            <strong class="case-row__title" id="{{ $rowId }}-title">{{ $case['name'] }}</strong>
            <span class="mono-label">{{ $case['domain'] }}</span>
        </span>
        @if ($case['tags'])
            <ul class="chips case-row__tags" aria-label="{{ $labels['tags_label'] }}">
                @foreach ($case['tags'] as $tag)
                    <li class="chip">{{ $tag }}</li>
                @endforeach
            </ul>
        @endif
        <x-v2::icon name="chevron-down" class="size-5 case-row__chevron" />
    </summary>

    <div class="case-row__detail">
        <div>
            <p class="case-row__label">{{ $labels['problem_label'] }}</p>
            <p>{{ $case['problem'] }}</p>
        </div>
        <div>
            <p class="case-row__label">{{ $labels['built_label'] }}</p>
            <p>{{ $case['built'] }}</p>
        </div>
        @if ($case['results'])
            <div class="case-row__results">
                <p class="case-row__label">{{ $labels['results_label'] }}</p>
                <ul class="check-list">
                    @foreach ($case['results'] as $result)
                        <li><x-v2::icon name="check" class="size-4" />{{ $result }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <a href="{{ $case['url'] }}" class="link-arrow case-row__link" target="_blank" rel="noopener noreferrer">
            {{ $labels['live_label'] }}
            <span class="sr-only">{{ $case['name'] }} {{ $t['a11y']['new_tab'] }}</span>
            <x-v2::icon name="arrow-up-right" class="size-4" />
        </a>
    </div>
</details>
