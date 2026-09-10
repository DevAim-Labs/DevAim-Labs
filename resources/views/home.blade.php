@extends('layouts.site')

@section('content')
@include('partials.nav', ['locale' => $locale ?? 'nl', 't' => $translations ?? []])
@include('partials.hero', ['locale' => $locale ?? 'nl', 't' => $translations ?? []])
    <div id="logo-slider-mount"></div>
    <div id="services-mount" data-section-id="services" data-locale="{{ $locale ?? 'nl' }}"></div>
    <div id="process-mount" data-section-id="process" data-locale="{{ $locale ?? 'nl' }}"></div>
    <div id="pricing-mount" data-section-id="pricing" data-locale="{{ $locale ?? 'nl' }}"></div>
    <div id="techstack-mount"></div>
    <div id="client-work-mount" data-section-id="client-work"></div>
@include('partials.about', ['locale' => $locale ?? 'nl', 't' => $translations ?? []])
    @include('partials.faq', ['locale' => $locale ?? 'nl', 't' => $translations ?? []])
    <!-- <div id="contact-mount" data-section-id="contact" data-locale="{{ $locale ?? 'nl' }}"></div> -->
    @if(($initialSection ?? null) === 'personal-projects')
        <div id="personal-projects-mount" data-section-id="personal-projects"></div>
    @endif
    @include('partials.footer', ['locale' => $locale ?? 'nl', 't' => $translations ?? []])
@endsection

@push('scripts')
<script nonce="{{ $cspNonce ?? '' }}">
    window.__INITIAL_SECTION__ = @json($initialSection ?? null);
    window.__ANALYTICS_SECTIONS__ = @json($analyticsSections ?? []);
    window.__GA_MEASUREMENT_ID__ = 'G-4DGM3LBT0E';
    window.__LOCALE__ = @json($locale ?? 'nl');
    window.__TRANSLATIONS__ = @json($translations ?? []);
</script>
@endpush
