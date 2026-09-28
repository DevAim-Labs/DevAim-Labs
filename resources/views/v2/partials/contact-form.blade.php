{{--
    The contact form (posts JSON to /contact through main.js). Shared by the
    home contact section, the contact page and the service pages. Pass
    `labelledby`: the id of the heading that names the form. Optional
    `projectType`: a key of contact.project_types to preselect.
--}}
@php
    $c = $t['contact'];
    $f = $c['fields'];
@endphp

<x-v2::form-shell id="contact-form" type="contact" :locale="$locale" :t="$t"
                  :success="$t['forms']['success_contact']" aria-labelledby="{{ $labelledby }}">
    <div class="form-grid">
        <x-v2::field form="contact-form" name="name" :label="$f['name']" autocomplete="name" required />
        <x-v2::field form="contact-form" name="email" type="email" :label="$f['email']"
                     inputmode="email" autocomplete="email" required />
        <x-v2::field form="contact-form" name="project_type" as="select" :label="$f['project_type']"
                     :options="$c['project_types']" :empty-option="$f['project_type_placeholder']"
                     :optional="$f['optional']" :value="$projectType ?? null" />
        <x-v2::field form="contact-form" name="budget" as="select" :label="$f['budget']"
                     :options="$c['budgets']" :empty-option="$f['budget_placeholder']"
                     :optional="$f['optional']" />
    </div>
    <x-v2::field form="contact-form" name="message" as="textarea" :label="$f['message']"
                 :hint="$f['message_hint']" required />
    <div class="form-actions form-actions--split">
        <x-v2::submit :label="$c['submit']" :sending="$t['forms']['sending']" />
        <p class="form-promise"><x-v2::icon name="clock" class="size-4" /> {{ $c['response'] }}</p>
    </div>
</x-v2::form-shell>
