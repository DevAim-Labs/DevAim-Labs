{{-- The page's single form: the shared contact form, project type preselected for this service. --}}
@php $c = $t['contact']; @endphp

<section class="section section--contact" id="{{ $t['ids']['contact'] }}" aria-labelledby="contact-title" data-contact>
    <div class="wrap contact">
        <div class="contact__copy">
            <x-v2::section-head id="contact-title" :eyebrow="$ui['contact_eyebrow']" :title="$s['contact']['title']" :intro="$s['contact']['intro']" />

            <div class="contact__direct" data-reveal>
                <p class="mono-label">{{ $c['direct'] }}</p>
                @include('v2.partials.contact-lines', ['response' => $c['response']])
            </div>
        </div>

        <div class="card contact__card" data-reveal>
            @include('v2.partials.contact-form', ['labelledby' => 'contact-title', 'projectType' => $s['project_type']])
        </div>
    </div>
</section>
