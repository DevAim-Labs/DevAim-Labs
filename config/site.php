<?php

/**
 * Secties: routing, analytics (GTM / GA4) en SEO.
 * `id` = HTML-sectie & scroll-target (Engels intern).
 * `slug` / `path` = Nederlandse URL.
 */
return [
    'sections' => [
        'home' => [
            'id' => 'home',
            'slug' => null,
            'path' => '/',
            'title' => 'DevAim Labs — Maatwerksoftware ontwikkeling',
            'description' => 'Maatwerksoftware en custom software ontwikkeling voor bedrijven — adminpanelen, KPI-dashboards, landingspagina\'s, Stripe & Mollie en API-koppelingen.',
            'keywords' => 'maatwerksoftware laten bouwen, custom software ontwikkeling, landingspagina laten maken',
        ],
        'about' => [
            'id' => 'about',
            'slug' => 'over-ons',
            'path' => '/over-ons',
            'title' => 'Over ons — DevAim Labs',
            'description' => 'Werk direct met de developer. Maatwerksoftware die past bij hoe jouw bedrijf werkt.',
            'keywords' => 'custom software ontwikkeling, maatwerksoftware voor bedrijven',
        ],
        'services' => [
            'id' => 'services',
            'slug' => 'diensten',
            'path' => '/diensten',
            'title' => 'Diensten — Admin, dashboards, integraties',
            'description' => 'Maatwerksoftware laten bouwen: adminpaneel met Laravel en Vue, KPI-dashboard, landingspagina, Stripe- en Mollie-integratie, API-koppelingen tussen CRM en boekhouding.',
            'keywords' => 'maatwerksoftware laten bouwen, adminpaneel laravel vue, kpi dashboard, stripe mollie integratie',
        ],
        'process' => [
            'id' => 'process',
            'slug' => 'werkwijze',
            'path' => '/werkwijze',
            'title' => 'Werkwijze — Van kennismaking tot oplevering',
            'description' => 'Ons proces voor maatwerksoftware: kennismaking, scope, bouwen, oplevering en doorontwikkeling — helder en stap voor stap.',
            'keywords' => 'werkwijze maatwerksoftware, custom software ontwikkeling',
        ],
        'client-work' => [
            'id' => 'client-work',
            'slug' => 'klantwerk',
            'path' => '/klantwerk',
            'title' => 'Klantwerk — DevAim Labs',
            'description' => 'Voorbeelden van maatwerksoftware en projecten voor eerdere klanten.',
            'keywords' => 'maatwerksoftware portfolio, software projecten',
        ],
        'personal-projects' => [
            'id' => 'personal-projects',
            'slug' => 'projecten',
            'path' => '/projecten',
            'title' => 'Eigen projecten — DevAim Labs',
            'description' => 'Eigen projecten en experimenten met Laravel, Vue en integraties.',
            'keywords' => 'custom software ontwikkeling, side projects',
        ],
        'faq' => [
            'id' => 'faq',
            'slug' => 'veelgestelde-vragen',
            'path' => '/veelgestelde-vragen',
            'title' => 'Veelgestelde vragen — Maatwerksoftware',
            'description' => 'Antwoorden over maatwerksoftware, doorlooptijd, eigendom van code, betalingen en onderhoud.',
            'keywords' => 'maatwerksoftware vragen, software ontwikkeling faq',
        ],
        'contact' => [
            'id' => 'contact',
            'slug' => 'contact',
            'path' => '/contact',
            'title' => 'Contact — Start je project',
            'description' => 'Neem contact op voor maatwerksoftware. Offerte, kennismakingsgesprek of bericht via het formulier.',
            'keywords' => 'maatwerksoftware offerte, software ontwikkeling contact',
        ],
    ],

    /** Extra SEO-paden → sectie (canonical blijft hoofd-URL) */
    'aliases' => [
        'maatwerksoftware' => 'services',
        'custom-software-ontwikkeling' => 'home',
        'adminpaneel-laravel-vue' => 'services',
        'kpi-dashboard' => 'services',
        'stripe-mollie-integratie' => 'services',
        'api-koppelingen' => 'services',
        'landingspagina' => 'services',
    ],

    /** Oude Engelse URL's → 301 naar Nederlandse paden */
    'redirects' => [
        '/about' => '/over-ons',
        '/services' => '/diensten',
        '/process' => '/werkwijze',
        '/work' => '/klantwerk',
        '/projects' => '/projecten',
        '/faq' => '/veelgestelde-vragen',
    ],

    'organization' => [
        'name' => 'DevAim Labs',
        'email' => 'devaimlabs@gmail.com',
        'phone' => '+316385230999',
        'logo' => '/DevAim_IMG.png',
    ],
];
