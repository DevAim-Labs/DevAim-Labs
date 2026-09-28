{{--
    Real, relevant cases only: the clients in resources/data/clients.json
    that list this service. Rendered only when there is at least one.
    A service without its own `proof` copy falls back to the home heading.
--}}
@php $proof = $s['proof'] ?? ['title' => $t['work']['title'], 'intro' => null]; @endphp

<section class="section" aria-labelledby="proof-title">
    <div class="wrap">
        <x-v2::section-head id="proof-title" :eyebrow="$ui['proof_eyebrow']" :title="$proof['title']" :intro="$proof['intro'] ?? null" />

        @include('v2.partials.case-list', ['cases' => $s['cases'], 'id' => 'svc-cases'])
    </div>
</section>
