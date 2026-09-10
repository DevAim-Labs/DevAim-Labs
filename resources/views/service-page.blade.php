@extends('layouts.site')

@section('content')
    @include('partials.nav', ['locale' => $locale])

    <div
        id="service-scroll-mount"
        data-service="{{ $service }}"
        data-locale="{{ $locale }}"
    ></div>

    @include('partials.footer', ['locale' => $locale])
@endsection

@push('scripts')
<script nonce="{{ $cspNonce ?? '' }}">
    window.__LOCALE__ = '{{ $locale }}';
    window.__TRANSLATIONS__ = @json(config('translations'));
</script>
@endpush
