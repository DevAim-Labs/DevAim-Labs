@php
    $locale = $locale ?? 'nl';
    $isEn = $locale === 'en';
    $faqs = config($isEn ? 'faq-en' : 'faq') ?? config('faq');
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
    $contactPath = $isEn ? '/en/contact' : '/contact';
@endphp

@push('structured_data')
<script type="application/ld+json">@json($faqSchema)</script>
@endpush

<section id="faq" data-gsap="section-faq" class="reveal-hidden">
    <div class="section-card">
        <div class="max-w-3xl mx-auto px-6 py-24">
            <header class="mb-12">
                <p class="section-eyebrow mb-3">FAQ</p>
                <h2 class="text-3xl md:text-4xl section-title mb-3">{{ $isEn ? 'Frequently asked questions' : 'Veelgestelde vragen' }}</h2>
                <p class="text-sm md:text-base" style="color: var(--color-text-muted);">
                    {{ $isEn ? 'Answers to the most common questions about our services.' : 'Antwoorden op de meest gestelde vragen over onze diensten.' }}
                </p>
            </header>

            <div class="space-y-3" id="faq-accordion">
                @foreach ($faqs as $index => $faq)
                    <details
                        class="faq-item group rounded-2xl border overflow-hidden transition-all duration-300"
                        style="border-color: var(--color-border-dim); background: var(--color-surface-1);"
                    >
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 px-6 py-5 text-sm font-semibold transition-colors duration-200 [&::-webkit-details-marker]:hidden hover:bg-[var(--color-surface-2)]" style="color: var(--color-text);">
                            <span class="flex-1">{{ $faq['q'] }}</span>
                            <span class="faq-icon relative w-6 h-6 shrink-0 flex items-center justify-center rounded-full transition-all duration-300" style="background: var(--color-accent-glow);">
                                <span class="absolute w-3 h-0.5 rounded-full rotate-90 transition-transform duration-300 group-open:rotate-0" style="background: var(--color-accent);"></span>
                                <span class="absolute w-3 h-0.5 rounded-full transition-transform duration-300" style="background: var(--color-accent);"></span>
                            </span>
                        </summary>
                        <div class="faq-content px-6 pb-5">
                            <div class="pt-4 border-t" style="border-color: var(--color-border-dim);">
                                <p class="text-sm leading-relaxed" style="color: var(--color-text-muted);">
                                    {{ $faq['a'] }}
                                </p>
                            </div>
                        </div>
                    </details>
                @endforeach
            </div>

            <div class="mt-12 text-center">
                <p class="text-sm mb-4" style="color: var(--color-text-muted);">
                    {{ $isEn ? 'Still have questions? We\'re happy to help.' : 'Nog vragen? We helpen je graag verder.' }}
                </p>
                <a
                    href="{{ $contactPath }}"
                    class="btn-outline inline-flex items-center gap-2 px-6 py-3 rounded-lg text-sm font-medium"
                    data-track="cta_click"
                    data-track-label="{{ $isEn ? 'Get in touch' : 'Neem contact op' }}"
                    data-track-location="faq"
                >
                    {{ $isEn ? 'Get in touch' : 'Neem contact op' }}
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .faq-item[open] {
        border-color: var(--color-border);
        box-shadow: 0 4px 20px -8px rgba(0, 0, 0, 0.2);
    }

    html[data-theme="light"] .faq-item[open] {
        box-shadow: 0 4px 16px -6px rgba(0, 0, 0, 0.08);
    }

    .faq-item[open] .faq-icon {
        background: var(--color-accent);
    }

    .faq-item[open] .faq-icon span {
        background: var(--color-on-accent);
    }

    .faq-content {
        animation: faq-expand 0.3s ease-out;
    }

    @keyframes faq-expand {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
