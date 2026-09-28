@extends('v2.layout')

{{-- View data: App\Support\SitePage::error(), via the composer in AppServiceProvider. --}}
@section('content')
    <section class="error-page" aria-labelledby="page-title">
        <div class="wrap error-page__inner">
            <p class="error-page__code" aria-hidden="true">404</p>
            <h1 class="h1" id="page-title">{{ $error['heading'] }}</h1>
            <p class="lede">{{ $error['text'] }}</p>
            <div class="error-page__actions">
                <a href="{{ $homeUrl }}" class="btn btn-cta">
                    {{ $error['home'] }}
                    <x-v2::icon name="arrow-right" class="btn__arrow size-5" />
                </a>
                <a href="{{ url(\App\Support\SitePage::sectionPath($locale, 'services')) }}" class="btn btn-outline">{{ $error['services'] }}</a>
                <a href="{{ \App\Support\SitePage::url('contact', $locale) }}" class="link-arrow">
                    {{ $error['contact'] }}
                    <x-v2::icon name="arrow-right" class="size-4" />
                </a>
            </div>
        </div>
    </section>
@endsection
