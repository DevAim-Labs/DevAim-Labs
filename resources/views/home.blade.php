@extends('layouts.site')

@section('content')
@include('partials.nav')
@include('partials.hero')
@include('partials.about')
    <div id="services-mount" data-section-id="services"></div>
    <div id="process-mount" data-section-id="process"></div>
    <div id="client-work-mount" data-section-id="client-work"></div>
    <div id="personal-projects-mount" data-section-id="personal-projects"></div>
    <div id="contact-mount" data-section-id="contact"></div>
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
