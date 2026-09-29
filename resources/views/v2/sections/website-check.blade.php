@php
    $c = $t['check'];
    $f = $c['form'];
@endphp

<section class="section section--sand" id="{{ $t['ids']['check'] }}" aria-labelledby="check-title">
    <div class="wrap check">
        <div class="check__copy">
            <x-v2::section-head id="check-title" :eyebrow="$c['eyebrow']" :title="$c['title']" :intro="$c['text']" />
            <ul class="check__points">
                @foreach ($c['points'] as $point)
                    <li data-reveal>
                        <span class="check__icon"><x-v2::icon :name="$point['icon']" class="size-5" /></span>
                        <span>
                            <strong>{{ $point['title'] }}</strong>
                            {{ $point['text'] }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card check__card" data-reveal>
            <x-v2::form-shell id="check-form" type="website_check" :locale="$locale" :t="$t"
                              :success="$t['forms']['success_check']" aria-labelledby="check-title">
                <x-v2::field form="check-form" name="scan_url" type="url" :label="$f['url_label']"
                             :placeholder="$f['url_placeholder']" inputmode="url" autocomplete="url" required />
                <x-v2::field form="check-form" name="email" type="email" :label="$f['email_label']"
                             :placeholder="$f['email_placeholder']" inputmode="email" autocomplete="email" required />
                <x-v2::field form="check-form" name="name" :label="$f['name_label']" :optional="$f['optional']"
                             :placeholder="$f['name_placeholder']" autocomplete="name" />
                <div class="form-actions">
                    <x-v2::submit :label="$f['submit']" :sending="$t['forms']['sending']" class="w-full" />
                </div>
                <p class="form-note"><x-v2::icon name="clock" class="size-4" /> {{ $f['note'] }}</p>
            </x-v2::form-shell>
        </div>
    </div>
</section>
