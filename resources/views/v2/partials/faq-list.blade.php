{{--
    FAQ accordion. Native <details>: keyboard and screen-reader support
    built in, works without JS. Pass `items` (q/a pairs).
--}}
<div class="faq__list">
    @foreach ($items as $item)
        <details class="faq__item" data-reveal>
            <summary class="faq__q">
                <span>{{ $item['q'] }}</span>
                <x-v2::icon name="chevron-down" class="faq__chevron size-5" />
            </summary>
            <div class="faq__a">
                <p>{{ $item['a'] }}</p>
            </div>
        </details>
    @endforeach
</div>
