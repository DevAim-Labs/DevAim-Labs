<?php

/**
 * English site configuration - sections, routing, analytics & SEO.
 */
return [
    'sections' => [
        'home' => [
            'id' => 'home',
            'slug' => null,
            'path' => '/en',
            'title' => 'DevAim Labs | Custom Software Development',
            'description' => 'DevAim Labs builds custom websites, systems and integrations for individuals and businesses. Direct contact with the developer who builds, no middleman.',
            'keywords' => 'custom software development, bespoke software, web application development',
            'indexable' => true,
        ],
        'about' => [
            'id' => 'about',
            'slug' => 'about',
            'path' => '/en/about',
            'title' => 'About Me | DevAim Labs',
            'description' => 'Work directly with the developer who builds. Custom software that fits how your business works.',
            'keywords' => 'custom software development, bespoke software for business',
            'indexable' => true,
        ],
        'services' => [
            'id' => 'services',
            'slug' => 'services',
            'path' => '/en/services',
            'title' => 'Services | Admin panels, dashboards, integrations',
            'description' => 'Custom software development: admin panels with Laravel and Vue, KPI dashboards, landing pages, Stripe and Mollie integrations, API connections.',
            'keywords' => 'custom software development, admin panel laravel vue, kpi dashboard, stripe mollie integration',
            'indexable' => true,
        ],
        'process' => [
            'id' => 'process',
            'slug' => 'process',
            'path' => '/en/process',
            'title' => 'Process | From introduction to delivery',
            'description' => 'My clear process for custom software, step by step: introduction, scope, development, delivery and ongoing support.',
            'keywords' => 'software development process, custom software methodology',
            'indexable' => true,
        ],
        'pricing' => [
            'id' => 'pricing',
            'slug' => 'pricing',
            'path' => '/en/pricing',
            'title' => 'Pricing | Flexible pricing models',
            'description' => 'Flexible pricing for custom software: fixed price, per phase or hourly rate. Pricing negotiable per project.',
            'keywords' => 'custom software pricing, software development rates, developer hourly rate',
            'indexable' => true,
        ],
        'client-work' => [
            'id' => 'client-work',
            'slug' => 'work',
            'path' => '/en/work',
            'title' => 'Client Work | DevAim Labs',
            'description' => 'Examples of custom software and projects for previous clients.',
            'keywords' => 'custom software portfolio, software projects',
            'indexable' => true,
        ],
        'personal-projects' => [
            'id' => 'personal-projects',
            'slug' => 'projects',
            'path' => '/en/projects',
            'title' => 'Personal Projects | DevAim Labs',
            'description' => 'Personal projects and experiments with Laravel, Vue and integrations.',
            'keywords' => 'custom software development, side projects',
        ],
        'faq' => [
            'id' => 'faq',
            'slug' => 'faq',
            'path' => '/en/faq',
            'title' => 'FAQ | Custom Software Questions',
            'description' => 'Answers about custom software, timeline, code ownership, payments and maintenance.',
            'keywords' => 'custom software questions, software development faq',
            'indexable' => true,
        ],
        'contact' => [
            'id' => 'contact',
            'slug' => 'contact',
            'path' => '/en/contact',
            'title' => 'Contact | Start your project',
            'description' => 'Get in touch for custom software. Quote, introduction call or message via the form.',
            'keywords' => 'custom software quote, software development contact',
            'indexable' => true,
        ],
    ],

    'aliases' => [
        'custom-software' => 'services',
        'admin-panel' => 'services',
        'dashboard' => 'services',
    ],

    'organization' => [
        'name' => 'DevAim Labs',
        'email' => 'devaimlabs@gmail.com',
        'phone' => '+316385230999',
        'logo' => '/DevAim_IMG.png',
    ],
];
