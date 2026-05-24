<section id="faq" data-gsap="section-faq" class="reveal-hidden">
    <div class="section-card">
        <div class="max-w-3xl mx-auto px-6 py-24">
            <p class="section-eyebrow mb-4">FAQ</p>
            <h2 class="text-3xl md:text-4xl section-title mb-10">
                Common questions
            </h2>

            <div class="space-y-3">
                @foreach([
                    [
                        'q' => 'What kind of custom software do you build?',
                        'a' => 'Admin panels, KPI dashboards, websites, REST APIs, third-party integrations (CRM), and payment flows. Typically with Laravel, Vue, and providers like Stripe or Mollie. Though the stack can depends on the scope.',
                    ],
                    [
                        'q' => 'Can you connect to our existing systems?',
                        'a' => 'Yes. Integrations are a core part of the work. Webhooks, APIs, and sync jobs designed so you are not locked into one vendor forever.',
                    ],
                    [
                        'q' => 'How long does a typical project take?',
                        'a' => 'It depends on scope. A focused landing page or admin MVP might be a few weeks; larger dashboards with integrations often run several months. We define milestones in the scope phase so you know what to expect.',
                    ],
                    [
                        'q' => 'Who owns the code?',
                        'a' => "You do. You receive the source code and documentation needed to run and extend the product. If you'd like for us to be the host then that can also be arranged.",
                    ],
                    [
                        'q' => 'Do you handle payments and subscriptions?',
                        'a' => 'Yes, checkout, subscriptions, invoicing, webhooks, and customer portals using Stripe, with proper error handling and test coverage.',
                    ],
                    [
                        'q' => 'Do you offer maintenance after launch?',
                        'a' => 'Yes. Clients keep us on for fixes, new features, and integration updates. In these cases, we can discuss further ongoing payment.',
                    ],
                ] as $faq)
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
