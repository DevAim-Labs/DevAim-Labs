{{--
    Real, relevant cases only (config: `cases` per service). Rendered only
    when the service lists at least one; it repeats what was built there,
    nothing more.
--}}
<section class="section" aria-labelledby="proof-title">
    <div class="wrap">
        <x-v2::section-head id="proof-title" :eyebrow="$ui['proof_eyebrow']" :title="$s['proof']['title']" :intro="$s['proof']['intro']" />

        <div class="cases">
            @foreach ($s['cases'] as $case)
                @include('v2.partials.case-card', ['case' => $case, 'id' => 'svc-case-'.$loop->index])
            @endforeach
        </div>
    </div>
</section>
