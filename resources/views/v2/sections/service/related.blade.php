{{-- 2-3 related services, each with its demo thumbnail (or a flow icon for integrations). --}}
@php $ru = $ui['related']; @endphp

<section class="section section--tight-top" aria-labelledby="related-title">
    <div class="wrap">
        <x-v2::section-head id="related-title" :eyebrow="$ru['eyebrow']" :title="$ru['title']" />

        <ul class="svc-related">
            @foreach ($s['related'] as $card)
                <li class="card svc-related__card" data-reveal>
                    <div class="svc-related__media">
                        @if ($card['image'])
                            <img src="{{ asset(ltrim($card['image'], '/')) }}" width="1600" height="956" alt=""
                                 loading="lazy" decoding="async">
                        @else
                            <span class="svc-related__flow" aria-hidden="true">
                                <i></i><x-v2::icon :name="$card['icon']" class="size-6" /><i></i>
                            </span>
                        @endif
                    </div>
                    <div class="svc-related__body">
                        <h3 class="h3">{{ $card['title'] }}</h3>
                        <p class="svc-related__summary">{{ $card['summary'] }}</p>
                        <a href="{{ $card['href'] }}" class="link-arrow card-link">
                            {{ $ru['link'] }} <span class="sr-only">{{ $card['title'] }}</span>
                            <x-v2::icon name="arrow-right" class="size-4" />
                        </a>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</section>
