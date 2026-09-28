{{-- Email + phone lines, shared by the about and contact sections. Pass `response` to add the reply-time line. --}}
<ul class="contact-lines">
    <li>
        <x-v2::icon name="mail" class="size-5" />
        <a href="mailto:{{ $org['email'] }}"><span class="sr-only">{{ $t['contact']['email_label'] }}: </span>{{ $org['email'] }}</a>
    </li>
    <li>
        <x-v2::icon name="phone" class="size-5" />
        <a href="{{ $phoneHref }}"><span class="sr-only">{{ $t['contact']['phone_label'] }}: </span>{{ $org['phone'] }}</a>
    </li>
    @isset($response)
        <li>
            <x-v2::icon name="clock" class="size-5" />
            <span>{{ $response }}</span>
        </li>
    @endisset
</ul>
