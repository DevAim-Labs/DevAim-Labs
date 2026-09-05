@extends('layouts.site')

@section('content')
@include('partials.nav')
@include('partials.hero')
    <div id="services-mount" data-section-id="services"></div>
    @if(($initialSection ?? null) === 'services')
        @include('partials.diensten-verdieping')
    @endif
    <div id="process-mount" data-section-id="process"></div>
    <div id="client-work-mount" data-section-id="client-work"></div>
@include('partials.about')
    @include('partials.faq')
    <div id="contact-mount" data-section-id="contact"></div>
    @if(($initialSection ?? null) === 'personal-projects')
        <div id="personal-projects-mount" data-section-id="personal-projects"></div>
    @endif
    @include('partials.footer')
@endsection

@push('scripts')
<script nonce="{{ $cspNonce ?? '' }}">
    window.__INITIAL_SECTION__ = @json($initialSection ?? null);
    window.__ANALYTICS_SECTIONS__ = @json($analyticsSections ?? []);
    window.__GA_MEASUREMENT_ID__ = 'G-4DGM3LBT0E';
</script>
@endpush
