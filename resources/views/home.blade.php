@extends('layouts.site')

@section('title', 'DevAim Labs — Custom software development')
@section('meta_description', 'Custom software for your business — admin panels, KPI dashboards, websites, API integrations and payment systems. Built with Laravel, Vue, Stripe and Mollie.')

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
