@extends('v2.layout')

{{--
    Service detail page. One view for every service: all copy comes from
    config/site-v2-services.php through App\Support\ServiceCatalog, and the
    page data (meta, canonical, hreflang, JSON-LD) from SitePage::service().

    Section order follows the blueprint in docs/research/service-pages.md:
    hero > live demo (or data flow) > what you get > fit > proof (only with
    a real case) > process > pricing > FAQ > related services > contact.
--}}

@php
    $s = $service;
    $ui = $s['ui'];
@endphp

@section('content')
    @include('v2.sections.service.hero')

    @if ($s['demo'])
        @include('v2.sections.service.demo')
    @elseif ($s['flow'])
        @include('v2.sections.service.flow')
    @endif

    @include('v2.sections.service.deliverables')
    @include('v2.sections.service.fit')

    @if ($s['cases'])
        @include('v2.sections.service.proof')
    @endif

    @include('v2.sections.process', [
        'process' => ['eyebrow' => $ui['process_eyebrow']] + $s['process'],
        'sectionId' => $t['ids']['process'],
    ])

    @include('v2.sections.service.pricing')
    @include('v2.sections.service.faq')
    @include('v2.sections.service.related')
    @include('v2.sections.service.contact')
@endsection
