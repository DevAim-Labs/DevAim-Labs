@php
    $faqs = config('faq');
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => collect($faqs)->map(fn ($item) => [
            '@type' => 'Question',
            'name' => $item['q'],
            'acceptedAnswer' => [
                '@type' => 'Answer',
                'text' => $item['a'],
            ],
        ])->all(),
    ];
@endphp

@push('structured_data')
<script type="application/ld+json">@json($faqSchema)</script>
@endpush

<section id="faq" data-gsap="section-faq" class="reveal-hidden">
    <div class="section-card">
        <div class="max-w-3xl mx-auto px-6 py-24">
            <p class="section-eyebrow mb-4">FAQ</p>
            <h2 class="text-3xl md:text-4xl section-title mb-10">
                Veelgestelde vragen
            </h2>

            <div class="space-y-3">
                @foreach ($faqs as $faq)
                    <details class="group card-glow rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)] overflow-hidden">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-5 py-4 text-sm font-semibold text-[var(--color-text)] [&::-webkit-details-marker]:hidden">
                            {{ $faq['q'] }}
                            <span class="shrink-0 text-[var(--color-accent)] transition-transform duration-200 group-open:rotate-45 text-lg leading-none">+</span>
                        </summary>
                        <p class="px-5 pb-4 text-sm leading-relaxed text-[var(--color-text-muted)] border-t border-[var(--color-border)] pt-4">
                            {{ $faq['a'] }}
                        </p>
                    </details>
                @endforeach
            </div>
        </div>
    </div>
</section>
