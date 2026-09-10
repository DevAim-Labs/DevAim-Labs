<?php

/**
 * Secties: routing, analytics (GA4) en SEO.
 * `id` = HTML-sectie & scroll-target (Engels intern).
 * `slug` / `path` = Nederlandse URL.
 */
return [
    'sections' => [
        'home' => [
            'id' => 'home',
            'slug' => null,
            'path' => '/',
            'title' => 'DevAim Labs | Maatwerksoftware & Custom Development',
            'description' => 'DevAim Labs bouwt custom websites, systemen en integraties voor particulieren en bedrijven. Direct contact met de developer die bouwt, geen tussenpersoon.',
            'keywords' => 'maatwerksoftware laten bouwen, custom software ontwikkeling, landingspagina laten maken',
            'indexable' => true,
        ],
        'about' => [
            'id' => 'about',
            'slug' => 'over-ons',
            'path' => '/over-ons',
            'title' => 'Over mij | DevAim Labs',
            'description' => 'Werk direct met de developer die bouwt. Maatwerksoftware die past bij hoe jouw bedrijf werkt.',
            'keywords' => 'custom software ontwikkeling, maatwerksoftware voor bedrijven',
            'indexable' => true,
        ],
        'services' => [
            'id' => 'services',
            'slug' => 'diensten',
            'path' => '/diensten',
            'title' => 'Diensten | Admin, dashboards, integraties',
            'description' => 'Maatwerksoftware laten bouwen: adminpaneel met Laravel en Vue, KPI-dashboard, landingspagina, Stripe- en Mollie-integratie, API-koppelingen tussen CRM en boekhouding.',
            'keywords' => 'maatwerksoftware laten bouwen, adminpaneel laravel vue, kpi dashboard, stripe mollie integratie',
            'indexable' => true,
        ],
        'process' => [
            'id' => 'process',
            'slug' => 'werkwijze',
            'path' => '/werkwijze',
            'title' => 'Werkwijze | Van kennismaking tot oplevering',
            'description' => 'Mijn heldere proces voor maatwerksoftware, stap voor stap: kennismaking, scope, bouwen, oplevering en doorontwikkeling.',
            'keywords' => 'werkwijze maatwerksoftware, custom software ontwikkeling',
            'indexable' => true,
        ],
        'pricing' => [
            'id' => 'pricing',
            'slug' => 'tarieven',
            'path' => '/tarieven',
            'title' => 'Tarieven | Flexibele prijsmodellen',
            'description' => 'Flexibele tarieven voor maatwerksoftware: vaste prijs, per fase of uurtarief. Prijs in overleg per project.',
            'keywords' => 'maatwerksoftware prijzen, software ontwikkeling tarieven, uurtarief developer',
            'indexable' => true,
        ],
        'client-work' => [
            'id' => 'client-work',
            'slug' => 'klantwerk',
            'path' => '/klantwerk',
            'title' => 'Klantwerk | DevAim Labs',
            'description' => 'Voorbeelden van maatwerksoftware en projecten voor eerdere klanten.',
            'keywords' => 'maatwerksoftware portfolio, software projecten',
            'indexable' => true,
        ],
        'personal-projects' => [
            'id' => 'personal-projects',
            'slug' => 'projecten',
            'path' => '/projecten',
            'title' => 'Eigen projecten | DevAim Labs',
            'description' => 'Eigen projecten en experimenten met Laravel, Vue en integraties.',
            'keywords' => 'custom software ontwikkeling, side projects',
        ],
        'faq' => [
            'id' => 'faq',
            'slug' => 'veelgestelde-vragen',
            'path' => '/veelgestelde-vragen',
            'title' => 'Veelgestelde vragen | Maatwerksoftware',
            'description' => 'Antwoorden over maatwerksoftware, doorlooptijd, eigendom van code, betalingen en onderhoud.',
            'keywords' => 'maatwerksoftware vragen, software ontwikkeling faq',
            'indexable' => true,
        ],
        'contact' => [
            'id' => 'contact',
            'slug' => 'contact',
            'path' => '/contact',
            'title' => 'Contact | Start je project',
            'description' => 'Neem contact op voor maatwerksoftware. Offerte, kennismakingsgesprek of bericht via het formulier.',
            'keywords' => 'maatwerksoftware offerte, software ontwikkeling contact',
            'indexable' => true,
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
        'email' => 'contact@devaimlabs.com',
        'phone' => '+316385230999',
        'logo' => '/DevAim_IMG.png',
    ],
];
