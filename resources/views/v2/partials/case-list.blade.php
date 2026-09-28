{{--
    Real client cases as an index: one row per client (logo, name, domain,
    tags), opened for the brief and what was built. Content comes from
    resources/data/clients.json via ClientCases.

    The first 3 rows are always shown. The rest render too (so they are there
    without JavaScript); main.js hides them behind a "show all" button.

    Pass `cases` and a unique `id`.
--}}
@php
    $labels = $t['work'];
    $limit = 3;
    $shown = array_slice($cases, 0, $limit);
    $extra = array_slice($cases, $limit);
    $row = fn (array $case, int $index) => ['case' => $case, 'rowId' => $id.'-'.$index, 'open' => $index === 0];
@endphp

<div class="case-list" data-case-list data-reveal>
    @foreach ($shown as $case)
        @include('v2.partials.case-row', $row($case, $loop->index))
    @endforeach

    @if ($extra)
        <div class="case-list__more" id="{{ $id }}-more" data-case-more>
            @foreach ($extra as $case)
                @include('v2.partials.case-row', $row($case, $limit + $loop->index))
            @endforeach
        </div>

        <button type="button" class="btn btn-outline case-list__toggle" data-case-toggle hidden
                aria-controls="{{ $id }}-more" aria-expanded="true"
                data-label-more="{{ str_replace(':count', count($cases), $labels['more_label']) }}"
                data-label-less="{{ $labels['less_label'] }}">
            <span data-case-toggle-label>{{ $labels['less_label'] }}</span>
            <x-v2::icon name="chevron-down" class="size-4 case-list__toggle-icon" />
        </button>
    @endif
</div>
