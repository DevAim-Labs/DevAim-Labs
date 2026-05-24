<section id="testimonials" data-gsap="section-testimonials" class="reveal-hidden">
    <div class="section-card">
        <div class="max-w-6xl mx-auto px-6 py-16">
            <p class="section-eyebrow text-center mb-10">What clients say</p>

            <div class="grid md:grid-cols-3 gap-6">
                @foreach([
                    [
                        'quote' => 'We went from scattered spreadsheets to one admin panel the whole team actually uses. Updates that used to take hours now take minutes.',
                        'name' => 'Operations lead',
                        'role' => 'Retail & hospitality',
                    ],
                    [
                        'quote' => 'The dashboard gave us KPIs we could trust for the first time — live numbers instead of end-of-week exports.',
                        'name' => 'Founder',
                        'role' => 'E-commerce',
                    ],
                    [
                        'quote' => 'Stripe, our CRM, and internal tools finally talk to each other. We stopped double-entering orders and payment status.',
                        'name' => 'Product owner',
                        'role' => 'SaaS',
                    ],
                ] as $t)
                    <blockquote class="card-glow flex flex-col h-full p-6 rounded-xl border border-[var(--color-border)] bg-[var(--color-surface)]">
                        <p class="text-sm leading-relaxed text-[var(--color-text-muted)] flex-1 mb-6">
                            &ldquo;{{ $t['quote'] }}&rdquo;
                        </p>
                        <footer>
                            <cite class="not-italic font-semibold text-sm text-[var(--color-text)]">{{ $t['name'] }}</cite>
                            <p class="text-xs text-[var(--color-text-dim)] mt-0.5">{{ $t['role'] }}</p>
                        </footer>
                    </blockquote>
                @endforeach
            </div>
        </div>
    </div>
</section>
