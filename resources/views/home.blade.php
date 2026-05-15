@extends('layouts.site')

@section('title', 'DevAim Labs — Full-Stack Web Development')
@section('meta_description', 'Custom websites, web apps, dashboards, third-party integrations and payment systems built by a solo full-stack developer.')

@section('content')
    @include('partials.nav')
    @include('partials.hero')
    @include('partials.about')
    @include('partials.services')

    <div id="portfolio-mount" class="border-t border-[--color-border-dim]"></div>

    <div id="contact-mount" class="border-t border-[--color-border-dim]"></div>

    @include('partials.footer')
@endsection
