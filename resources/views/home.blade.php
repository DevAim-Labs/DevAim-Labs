@extends('layouts.site')

@section('content')
@include('partials.nav')
@include('partials.hero')
@include('partials.about')
    <div id="services-mount"></div>
    <div id="process-mount"></div>
    <div id="client-work-mount"></div>
    <div id="personal-projects-mount"></div>
    <div id="contact-mount"></div>
    @include('partials.faq')
    @include('partials.footer')
@endsection

@push('scripts')
<script nonce="{{ $cspNonce ?? '' }}">
    window.__INITIAL_SECTION__ = @json($initialSection ?? null);
    window.__ANALYTICS_SECTIONS__ = @json($analyticsSections ?? []);
    window.__GA_MEASUREMENT_ID__ = 'G-WY86R8VE0V';
</script>
@endpush
