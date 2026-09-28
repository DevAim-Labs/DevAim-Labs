@extends('layouts.site')

@section('content')
<div class="landing-page">
    @include('partials.landing.navbar')
    @include('partials.landing.hero')
    @include('partials.landing.about')
    @include('partials.landing.clients')
    @include('partials.landing.techstack')
    @include('partials.landing.services')
    @include('partials.landing.pricing')
    @include('partials.landing.workflow')
    @include('partials.landing.contact')
    @include('partials.landing.footer')
</div>
@endsection

@push('scripts')
<script nonce="{{ $cspNonce ?? '' }}">
    window.__INITIAL_SECTION__ = @json($initialSection ?? null);
    window.__ANALYTICS_SECTIONS__ = @json($analyticsSections ?? []);
    window.__GA_MEASUREMENT_ID__ = 'G-4DGM3LBT0E';
    window.__LOCALE__ = @json($locale ?? 'nl');
</script>
@endpush
