@extends('v2.layout')

@php
    $p = $t['pages']['contact'];
    $c = $t['contact'];
    $faqItems = array_values(array_filter(
        array_map(fn (int $i) => $t['faq']['items'][$i] ?? null, $p['faq_items']),
    ));
@endphp

@section('content')
    @include('v2.partials.page-head', ['eyebrow' => $p['eyebrow'], 'title' => $p['heading'], 'intro' => $p['intro']])

    <section class="section section--contact section--page-first" aria-labelledby="contact-form-title" data-contact>
        <div class="wrap contact">
            <div class="contact__copy">
                <div class="contact__direct">
                    <p class="mono-label">{{ $c['direct'] }}</p>
                    @include('v2.partials.contact-lines', ['response' => $c['response']])
                </div>

                <div class="contact__next">
                    <h2 class="h3">{{ $p['next_title'] }}</h2>
                    <ol class="steps-list">
                        @foreach ($p['next'] as $step)
                            <li>
                                <span class="steps-list__num" aria-hidden="true">{{ $loop->iteration }}</span>
                                <span>{{ $step }}</span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <div class="card contact__card">
                <h2 class="h3 contact__form-title" id="contact-form-title">{{ $p['form_title'] }}</h2>
                @include('v2.partials.contact-form', ['labelledby' => 'contact-form-title'])
            </div>
        </div>
    </section>

    @if ($faqItems)
        <section class="section" aria-labelledby="contact-faq-title">
            <div class="wrap faq">
                <x-v2::section-head id="contact-faq-title" :title="$p['faq_title']" />
                @include('v2.partials.faq-list', ['items' => $faqItems])
                <p class="faq__more">
                    <a href="{{ url(\App\Support\SitePage::sectionPath($locale, 'faq')) }}" class="link-arrow">
                        {{ $p['faq_more'] }} <x-v2::icon name="arrow-right" class="size-4" />
                    </a>
                </p>
            </div>
        </section>
    @endif
@endsection
