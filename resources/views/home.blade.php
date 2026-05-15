@extends('layouts.site')

@section('title', 'DevAim Labs — Full-Stack Web Development')
@section('meta_description', 'Custom websites, web apps, dashboards, third-party integrations and payment systems built by a solo full-stack developer.')

@section('content')
    @include('partials.nav')
    @include('partials.hero')
    @include('partials.about')
    <div id="services-mount"></div>

    <div id="client-work-mount"></div>

    <div id="personal-projects-mount"></div>

    <div id="contact-mount"></div>

    @include('partials.footer')
@endsection
