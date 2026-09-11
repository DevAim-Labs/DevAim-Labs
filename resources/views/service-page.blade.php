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

@php
    // Service-specific schema data
    $serviceSchemaData = [
        'websites' => [
            'name' => $locale === 'en' ? 'Website & Portfolio Development' : 'Website & Portfolio Ontwikkeling',
            'serviceType' => 'Web Development',
            'price' => '2500',
        ],
        'admin-panels' => [
            'name' => $locale === 'en' ? 'Admin Panel Development' : 'Adminpaneel Ontwikkeling',
            'serviceType' => 'Custom Software Development',
            'price' => '3500',
        ],
        'dashboards' => [
            'name' => $locale === 'en' ? 'KPI Dashboard Development' : 'KPI Dashboard Ontwikkeling',
            'serviceType' => 'Business Intelligence',
            'price' => '4000',
        ],
        'payments' => [
            'name' => $locale === 'en' ? 'Payment Integration Services' : 'Betaalintegratie Diensten',
            'serviceType' => 'Payment Gateway Integration',
            'price' => '1500',
        ],
        'api-integrations' => [
            'name' => $locale === 'en' ? 'API Integration Services' : 'API Integratie Diensten',
            'serviceType' => 'System Integration',
            'price' => '2000',
        ],
    ];

    $currentServiceSchema = $serviceSchemaData[$service] ?? null;

    // Build the Service schema
    $serviceSchema = $currentServiceSchema ? [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        '@id' => $canonicalUrl . '#service',
        'name' => $currentServiceSchema['name'],
        'serviceType' => $currentServiceSchema['serviceType'],
        'description' => $pageDescription,
        'provider' => ['@id' => url('/') . '#organization'],
        'areaServed' => ['@type' => 'Country', 'name' => 'Nederland'],
        'availableChannel' => [
            '@type' => 'ServiceChannel',
            'serviceUrl' => $canonicalUrl,
            'serviceLocation' => [
                '@type' => 'Place',
                'address' => ['@type' => 'PostalAddress', 'addressCountry' => 'NL'],
            ],
        ],
        'offers' => [
            '@type' => 'Offer',
            'price' => $currentServiceSchema['price'],
            'priceCurrency' => 'EUR',
            'priceSpecification' => [
                '@type' => 'PriceSpecification',
                'price' => $currentServiceSchema['price'],
                'priceCurrency' => 'EUR',
                'valueAddedTaxIncluded' => false,
            ],
            'availability' => 'https://schema.org/InStock',
            'validFrom' => date('Y-m-d'),
        ],
        'url' => $canonicalUrl,
        'inLanguage' => $locale === 'en' ? 'en' : 'nl',
    ] : null;

    // Build the WebPage schema
    $webPageSchema = $currentServiceSchema ? [
        '@context' => 'https://schema.org',
        '@type' => 'WebPage',
        '@id' => $canonicalUrl . '#webpage',
        'url' => $canonicalUrl,
        'name' => $pageTitle,
        'description' => $pageDescription,
        'isPartOf' => ['@id' => url('/') . '#website'],
        'about' => ['@id' => $canonicalUrl . '#service'],
        'breadcrumb' => ['@id' => $canonicalUrl . '#breadcrumb'],
        'inLanguage' => $locale === 'en' ? 'en' : 'nl',
        'potentialAction' => ['@type' => 'ReadAction', 'target' => $canonicalUrl],
    ] : null;
@endphp

@push('structured_data')
@if($serviceSchema)
<script type="application/ld+json">{!! json_encode($serviceSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
<script type="application/ld+json">{!! json_encode($webPageSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}</script>
@endif
@endpush
