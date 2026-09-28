@extends('v2.layout')

{{--
    Kept minimal on purpose: config strings and static links only, no
    database, no nav. View data: App\Support\SitePage::error().
--}}
@section('content')
    <section class="error-page" aria-labelledby="page-title">
        <div class="wrap error-page__inner">
            <p class="error-page__code" aria-hidden="true">503</p>
            <h1 class="h1" id="page-title">{{ $error['heading'] }}</h1>
            <p class="lede">{{ $error['text'] }}</p>
            <div class="error-page__actions">
                <a href="{{ url()->current() }}" class="btn btn-cta">{{ $error['home'] }}</a>
            </div>
            <div class="error-page__reach">
                <p>{{ $t['errors']['reach'] }}</p>
                @include('v2.partials.contact-lines')
            </div>
        </div>
    </section>
@endsection
