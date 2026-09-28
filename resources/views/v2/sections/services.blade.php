@php $s = $t['services']; @endphp

<section class="section" id="{{ $t['ids']['services'] }}" aria-labelledby="services-title">
    <div class="wrap">
        <x-v2::section-head id="services-title" :eyebrow="$s['eyebrow']" :title="$s['title']" :intro="$s['intro']" />

        <ul class="services-grid">
            @foreach ($s['items'] as $item)
                <li class="card service-card" data-reveal>
                    <span class="service-card__icon"><x-v2::icon :name="$item['icon']" class="size-6" /></span>
                    <h3 class="h3">{{ $item['title'] }}</h3>
                    <p class="service-card__outcome">{{ $item['outcome'] }}</p>
                    <a href="{{ $item['href'] }}" class="link-arrow card-link">
                        {{ $s['link_prefix'] }} {{ preg_match('/^[A-Z]{2}/', $item['title']) ? $item['title'] : lcfirst($item['title']) }}
                        <x-v2::icon name="arrow-right" class="size-4" />
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</section>
