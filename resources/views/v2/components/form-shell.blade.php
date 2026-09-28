{{--
    Shared <form> wrapper for the site's lead forms. main.js posts it as JSON
    to /contact. `novalidate`: validation messages come from the server
    (same wording in every browser), shown inline next to each field.
    Bot traps: the honeypot and the signed render time (App\Support\FormTimer).
--}}
@props(['type', 'locale', 't', 'id', 'success'])

<form {{ $attributes->merge(['class' => 'v2-form']) }} id="{{ $id }}" action="/contact" method="POST" novalidate
      data-v2-form
      data-msg-error="{{ $t['forms']['error'] }}"
      data-msg-generic="{{ $t['forms']['error_generic'] }}"
      data-msg-expired="{{ $t['forms']['error_expired'] }}"
      data-msg-throttled="{{ $t['forms']['error_throttled'] }}"
      data-msg-success="{{ $success }}">
    @csrf
    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="locale" value="{{ $locale }}">

    {{-- Honeypot: visually hidden, skipped by keyboard and autofill. --}}
    <div class="hp" aria-hidden="true">
        <label for="{{ $id }}-website_url">{{ $t['forms']['honeypot'] }}</label>
        <input type="text" id="{{ $id }}-website_url" name="website_url" tabindex="-1" autocomplete="off" value="">
    </div>
    <input type="hidden" name="{{ \App\Support\FormTimer::FIELD }}" value="{{ \App\Support\FormTimer::token() }}">

    {{ $slot }}

    <p class="form-note form-privacy">
        <x-v2::icon name="shield-check" class="size-4" />
        <span>{{ $t['forms']['privacy_note'] }} <a href="{{ route('privacy') }}" @if ($locale !== 'nl') hreflang="nl" @endif>{{ $t['forms']['privacy_link'] }}</a>.</span>
    </p>

    <p class="form-status" data-form-status role="status" aria-live="polite" tabindex="-1" hidden></p>
</form>
