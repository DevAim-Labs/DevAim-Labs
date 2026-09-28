@php
    $p = $t['proof'];
    $clients = $t['work']['cases'];
    // Each half of the loop repeats the logos until it is wider than the
    // screen; the second half is a copy so translate(-50%) loops seamlessly.
    $repeat = max(2, (int) ceil(8 / max(1, count($clients))));
@endphp

<section class="proof" aria-label="{{ $p['clients_label'] }}">
    <div class="wrap proof__inner" data-reveal>
        <p class="mono-label proof__label">{{ $p['clients_label'] }}</p>

        <div class="marquee" data-marquee>
            <div class="marquee__track">
                @foreach ([false, true] as $isCopy)
                    <ul class="marquee__set" @if ($isCopy) aria-hidden="true" @endif>
                        @for ($i = 0; $i < $repeat; $i++)
                            @foreach ($clients as $client)
                                {{-- Only the very first set is announced; repeats are decoration. --}}
                                <li @if ($isCopy || $i > 0) aria-hidden="true" class="marquee__repeat" @endif>
                                    <span class="logo-chip">
                                        <img src="{{ asset(ltrim($client['image'], '/')) }}" width="{{ $client['width'] }}" height="{{ $client['height'] }}"
                                             alt="{{ $isCopy || $i > 0 ? '' : $client['name'] }}" loading="lazy" decoding="async">
                                    </span>
                                </li>
                            @endforeach
                        @endfor
                    </ul>
                @endforeach
            </div>
        </div>

        <button type="button" class="marquee__toggle" data-marquee-toggle aria-pressed="false"
                aria-label="{{ $p['pause'] }}" data-label-pause="{{ $p['pause'] }}" data-label-play="{{ $p['play'] }}">
            <x-v2::icon name="pause" class="size-4 marquee__icon-pause" />
            <x-v2::icon name="play" class="size-4 marquee__icon-play" />
        </button>
    </div>
</section>
