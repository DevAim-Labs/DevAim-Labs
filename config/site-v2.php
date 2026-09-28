<?php

/**
 * Content for the site (the "v2" design, live on /, /en, /contact,
 * /en/contact, /privacyverklaring and the error pages).
 *
 * - Organisation name, e-mail, phone and logo come from config('site.organization')
 *   and are NOT duplicated here (render them from there).
 * - Dutch copy uses formal "u" and first person singular ("ik"): one developer.
 * - No fabricated testimonials, metrics or quotes. Case `results` stay empty
 *   until there are real, verifiable numbers (the view renders nothing then).
 */
return [

    /*
     * Company registration details. They are not (yet) in config/site.php,
     * which has uncommitted edits, so they live here for now.
     * TODO: move to config('site.organization') once that file is settled.
     */
    'company' => [
        'kvk' => '42051464',
        'btw' => 'NL005458933B79',
    ],

    /*
     * Old one-page URLs (config/site.php and config/site-en.php: section
     * slugs, `aliases` and `redirects`) now 301 to an anchor on the home
     * page. Maps an old section id to a key of `ids` (null = top of home).
     * See App\Support\LegacyRedirects.
     */
    'legacy_sections' => [
        'home' => null,
        'about' => 'about',
        'services' => 'services',
        'process' => 'process',
        'pricing' => 'pricing',
        'client-work' => 'work',
        'personal-projects' => 'work',
        'faq' => 'faq',
        'contact' => 'contact',
    ],

    'nl' => [
        'meta' => [
            'title' => 'DevAim Labs | Websites, adminpanelen en betalingen op maat',
            'description' => 'Ik bouw websites, adminpanelen, KPI-dashboards en betaalkoppelingen voor ondernemers. Vaste prijs vooraf, één vaste developer, reactie binnen 1 werkdag.',
            'og_locale' => 'nl_NL',
        ],

        'a11y' => [
            'skip' => 'Naar de inhoud',
            'new_tab' => '(opent in een nieuw tabblad)',
            'menu_open' => 'Menu openen',
            'menu_close' => 'Menu sluiten',
            'menu_title' => 'Menu',
            'theme' => 'Donker thema',
            'lang_label' => 'Taal',
            'main_nav' => 'Hoofdnavigatie',
            'home' => 'DevAim Labs, naar boven',
            'home_link' => 'DevAim Labs, naar de homepage',
            'breadcrumb' => 'Kruimelpad',
        ],

        /*
         * Links point at a home `section` (a key of `ids`: an in-page anchor on
         * the home page, "/#anchor" elsewhere) or at a `page` (see App\Support\SitePage).
         * `menu` adds the services disclosure menu to that link.
         */
        'nav' => [
            'links' => [
                ['label' => 'Diensten', 'section' => 'services', 'menu' => true],
                ['label' => 'Werk', 'section' => 'work'],
                ['label' => 'Werkwijze', 'section' => 'process'],
                ['label' => 'Tarieven', 'section' => 'pricing'],
                ['label' => 'Over mij', 'section' => 'about'],
                ['label' => 'Contact', 'page' => 'contact'],
            ],
            'cta' => ['label' => 'Gratis website-check', 'section' => 'check'],
            'services_menu' => [
                'overview' => 'Alle diensten',
                'items' => [
                    ['label' => 'Websites', 'service' => 'websites'],
                    ['label' => 'Adminpanelen', 'service' => 'admin-panels'],
                    ['label' => 'KPI-dashboards', 'service' => 'dashboards'],
                    ['label' => 'Betalingen', 'service' => 'payments'],
                    ['label' => 'API-koppelingen', 'service' => 'api-integrations'],
                ],
            ],
        ],

        'ids' => [
            'services' => 'diensten',
            'work' => 'werk',
            'process' => 'werkwijze',
            'pricing' => 'tarieven',
            'about' => 'over-mij',
            'check' => 'website-check',
            'faq' => 'vragen',
            'contact' => 'contact',
        ],

        'hero' => [
            'eyebrow' => 'Websites & software op maat',
            'title' => 'Meer klanten, meer aanvragen,',
            'title_em' => 'minder gedoe.',
            'subtitle' => 'Ik bouw websites, adminpanelen, KPI-dashboards en betaalkoppelingen die voor uw zaak werken, zodat u minder tijd kwijt bent aan losse lijstjes en meer aan uw klanten.',
            'badge' => 'Beschikbaar voor nieuwe projecten',
            'trust' => ['Reactie binnen 1 werkdag', 'Vaste prijs vooraf', 'Eén vaste developer'],
            'form' => [
                'title' => 'Vraag een gratis website-check aan',
                'url_label' => 'Uw website',
                'url_placeholder' => 'uwzaak.nl',
                'email_label' => 'Uw e-mailadres',
                'email_placeholder' => 'naam@uwzaak.nl',
                'submit' => 'Check aanvragen',
                'note' => 'U ontvangt binnen 2 werkdagen een kort rapport. Gratis en vrijblijvend.',
            ],
            'secondary' => ['label' => 'Bekijk mijn werk', 'href' => '#werk'],
            // Illustration only: a generic business site, not client work.
            'mock' => [
                'aria' => 'Illustratie: een bezoeker vraagt via de website een offerte aan en de aanvraag verschijnt direct in het dashboard.',
                'url' => 'uwzaak.nl',
                'brand' => 'Uw bedrijf',
                'nav' => ['Diensten', 'Over ons', 'Contact'],
                'title' => 'Kwaliteit die blijft',
                'text' => 'Bekijk onze diensten en vraag vrijblijvend een offerte aan.',
                'button' => 'Offerte aanvragen',
                'tiles' => ['Diensten', 'Projecten', 'Reviews'],
                'toast_title' => 'Nieuwe aanvraag',
                'toast_meta' => 'Via het contactformulier',
                'toast_time' => 'zojuist',
            ],
            'tech' => [
                'label' => 'Voorbeelddata',
                'order' => 'Betaling #2041 · iDEAL',
                'status' => 'betaald',
                'kpi_label' => 'Aanvragen deze maand',
                'kpi_value' => '148',
                'kpi_delta' => '+23%',
                'caption' => 'Voorbeelddata uit een demo-dashboard',
            ],
        ],

        'proof' => [
            'clients_label' => 'Gewerkt met',
            'pause' => 'Logo\'s pauzeren',
            'play' => 'Logo\'s afspelen',
        ],

        'services' => [
            'eyebrow' => 'Diensten',
            'title' => 'Wat ik voor uw zaak kan bouwen',
            'intro' => 'Van een eerste website tot een koppeling tussen uw kassa, boekhouding en webshop. U krijgt één aanspreekpunt voor het hele traject.',
            'link_prefix' => 'Meer over',
            'items' => [
                ['icon' => 'globe', 'title' => 'Websites', 'outcome' => 'Een snelle, vindbare website die bezoekers omzet in reserveringen, aanvragen of telefoontjes.', 'service' => 'websites'],
                ['icon' => 'shopping-bag', 'title' => 'Webshops', 'outcome' => 'Online verkopen met een eigen webshop: overzichtelijke collectie, winkelmand en afrekenen met iDEAL, creditcard en meer.', 'service' => 'websites'],
                ['icon' => 'layout-dashboard', 'title' => 'Adminpanelen', 'outcome' => 'Klanten, orders en planning op één plek beheren, in plaats van in losse Excel-lijsten.', 'service' => 'admin-panels'],
                ['icon' => 'chart', 'title' => 'KPI-dashboards', 'outcome' => 'Omzet, bestellingen en trends in één oogopslag, bijgewerkt zonder handwerk.', 'service' => 'dashboards'],
                ['icon' => 'credit-card', 'title' => 'Betalingen', 'outcome' => 'Betalingen, abonnementen en facturen via Stripe of Mollie, inclusief webhooks en foutafhandeling.', 'service' => 'payments'],
                ['icon' => 'workflow', 'title' => 'API-koppelingen', 'outcome' => 'Uw systemen praten met elkaar: CRM, boekhouding, kassa of webshop, zonder dubbel overtypen.', 'service' => 'api-integrations'],
            ],
        ],

        'work' => [
            'eyebrow' => 'Werk',
            'title' => 'Recent opgeleverd',
            'intro' => 'Echte projecten voor echte ondernemers. Dit is wat ik heb gebouwd.',
            'problem_label' => 'De vraag',
            'built_label' => 'Wat ik bouwde',
            'results_label' => 'Resultaat',
            'tags_label' => 'Kenmerken',
            'live_label' => 'Bekijk de live site',
            'cases' => [
                [
                    'name' => 'Lokanta Proeflokaal',
                    'domain' => 'lokanta-proeflokaal.nl',
                    'url' => 'https://lokanta-proeflokaal.nl',
                    'image' => '/lokanta.webp',
                    'width' => 200,
                    'height' => 71,
                    'alt' => 'Logo van Lokanta Proeflokaal',
                    'tags' => ['Restaurant', 'Website', 'Astro'],
                    // TODO: owner to confirm the wording of the client's original question.
                    'problem' => 'Een tapasbar die gasten online al wil laten proeven wat hen te wachten staat: de kaart, de sfeer en hoe ze kunnen reserveren.',
                    'built' => 'Een restaurantwebsite met de menukaart, sfeerbeelden, reserveren en alle praktische informatie die gasten nodig hebben voordat ze binnenstappen.',
                    // TODO: add real, verifiable results (e.g. from analytics). Leave empty until then.
                    'results' => [],
                ],
                [
                    'name' => 'Slowdown Store',
                    'domain' => 'slowdownstore.com',
                    'url' => 'https://slowdownstore.com',
                    'image' => '/slowdown.webp',
                    'width' => 125,
                    'height' => 65,
                    'alt' => 'Logo van Slowdown Store',
                    'tags' => ['Mode', 'Webshop', 'Astro'],
                    // TODO: owner to confirm the wording of the client's original question.
                    'problem' => 'Een onafhankelijk modelabel dat zijn collectie in een eigen winkel wil verkopen, los van grote platformen.',
                    'built' => 'Een webshop voor het label, met productpagina\'s die de collectie laten zien en een eigen online verkoopkanaal.',
                    // TODO: add real, verifiable results. Leave empty until then.
                    'results' => [],
                ],
            ],
        ],

        'process' => [
            'eyebrow' => 'Werkwijze',
            'title' => 'Drie stappen, geen verrassingen',
            'intro' => 'U weet vooraf wat u krijgt, wat het kost en wanneer het klaar is.',
            'steps' => [
                ['title' => 'Kennismaking & advies', 'text' => 'We bespreken uw zaak en uw doelen. Ik geef eerlijk advies over wat nodig is, en wat niet. Daarna ontvangt u een voorstel met een vaste prijs en planning.'],
                ['title' => 'Ontwerp & bouw', 'text' => 'Ik ontwerp en bouw in korte rondes. U ziet tussentijds werkende versies en kunt bijsturen voordat iets definitief is.'],
                ['title' => 'Live & support', 'text' => 'Na uw akkoord gaat alles live. De code is van u, en ik blijf beschikbaar voor onderhoud, updates en nieuwe wensen.'],
            ],
        ],

        'about' => [
            'eyebrow' => 'Over mij',
            'title' => 'U praat direct met de developer die bouwt',
            'initials' => 'DL', // TODO: real photo (replace the initials plate) and the developer's initials.
            'photo_alt' => 'Portretfoto volgt',
            'paragraphs' => [
                'Ik ben de developer achter DevAim Labs. Ik bouw uw website, adminpaneel, dashboard of koppeling zelf, van het eerste gesprek tot de livegang.',
                'Geen accountmanager en geen wisselende contactpersonen. Wat u met mij bespreekt, is precies wat er gebouwd wordt. Dat betekent korte lijnen en snel schakelen als er iets verandert.',
            ],
            'direct' => 'Direct contact',
            'stack_label' => 'Waar ik mee werk',
            'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Astro', 'Tailwind CSS', 'Stripe', 'Mollie', 'REST API\'s'],
        ],

        'pricing' => [
            'eyebrow' => 'Tarieven',
            'title' => 'Duidelijke pakketten',
            'intro' => 'Elk project is anders, maar u weet altijd vooraf waar u aan toe bent.',
            'note' => 'Vaste prijs vooraf, geen verrassingen.',
            'from' => 'vanaf',
            'on_request' => 'Prijs op aanvraag',
            'highlight' => 'Aanbevolen',
            'currency' => '€',
            'packages' => [
                [
                    'key' => 'starter',
                    'name' => 'Starter website',
                    'tagline' => 'Voor ondernemers die professioneel online willen staan.',
                    // TODO: fill in real "vanaf" price
                    'price_from' => null,
                    'features' => ['Website op maat, tot 5 pagina\'s', 'Mobielvriendelijk en snel', 'Basis-SEO en Google Maps', 'Contactformulier', 'Hulp bij hosting en livegang'],
                    'cta' => 'Start met een website',
                    'project_type' => 'website',
                    'highlighted' => false,
                ],
                [
                    'key' => 'groei',
                    'name' => 'Groei',
                    'tagline' => 'Website + leads & CMS: zelf teksten beheren en meer aanvragen binnenhalen.',
                    // TODO: fill in real "vanaf" price
                    'price_from' => null,
                    'features' => ['Alles uit Starter', 'Zelf content beheren (CMS)', 'Reserverings- of offerteformulieren', 'Koppeling met e-mail of agenda', 'Statistieken en conversiemeting'],
                    'cta' => 'Kies Groei',
                    'project_type' => 'website',
                    'highlighted' => true,
                ],
                [
                    'key' => 'maatwerk',
                    'name' => 'Maatwerk',
                    'tagline' => 'Dashboards, portalen en integraties voor processen die niet in een standaardpakket passen.',
                    // TODO: fill in real "vanaf" price
                    'price_from' => null,
                    'features' => ['Adminpanelen en klantportalen', 'KPI-dashboards', 'Betalingen via Stripe of Mollie', 'API-koppelingen met uw systemen', 'Onderhoud en doorontwikkeling'],
                    'cta' => 'Bespreek uw project',
                    'project_type' => 'maatwerk',
                    'highlighted' => false,
                ],
            ],
        ],

        'check' => [
            'eyebrow' => 'Gratis website-check',
            'title' => 'Hoe goed werkt uw huidige website?',
            'text' => 'Laat uw website gratis checken. Binnen 2 werkdagen ontvangt u een kort, geschreven rapport met concrete verbeterpunten. Vrijblijvend, zonder verkooppraatje.',
            'points' => [
                ['icon' => 'gauge', 'title' => 'Snelheid', 'text' => 'Hoe snel laadt uw site op een telefoon?'],
                ['icon' => 'search', 'title' => 'SEO', 'text' => 'Wordt u gevonden op de zoektermen die ertoe doen?'],
                ['icon' => 'trending-up', 'title' => 'Conversie', 'text' => 'Wordt het bezoekers makkelijk gemaakt om contact op te nemen of te bestellen?'],
            ],
            'form' => [
                'url_label' => 'Uw website',
                'url_placeholder' => 'uwzaak.nl',
                'email_label' => 'Uw e-mailadres',
                'email_placeholder' => 'naam@uwzaak.nl',
                'name_label' => 'Uw naam',
                'optional' => 'optioneel',
                'submit' => 'Vraag de gratis check aan',
                'note' => 'Rapport binnen 2 werkdagen in uw inbox.',
            ],
        ],

        'faq' => [
            'eyebrow' => 'Veelgestelde vragen',
            'title' => 'Goed om te weten',
            'more' => 'Staat uw vraag er niet bij?',
            'more_link' => 'Stel hem direct',
            // Based on config/faq.php, rewritten for the new tone.
            'items' => [
                ['q' => 'Wat voor websites en software bouwt u?', 'a' => 'Websites, webshops, adminpanelen, KPI-dashboards, koppelingen met CRM of boekhouding, en betaalstromen. Meestal met Laravel en Vue, en met aanbieders als Stripe of Mollie.'],
                ['q' => 'Kunt u koppelen met de systemen die ik al gebruik?', 'a' => 'Ja. Koppelingen horen bij de kern van mijn werk: webhooks, API\'s en synchronisaties, zodat uw systemen met elkaar praten en u niet vastzit aan één leverancier.'],
                ['q' => 'Hoe lang duurt een project?', 'a' => 'Dat hangt af van de omvang. Een website of een eerste versie van een adminpaneel kan in enkele weken klaar zijn; grotere dashboards met koppelingen duren vaak enkele maanden. U krijgt vooraf een planning.'],
                ['q' => 'Wie is eigenaar van de code?', 'a' => 'U. Na oplevering ontvangt u de volledige broncode en de documentatie die nodig is om alles zelf te beheren of uit te breiden, zonder beperkingen.'],
                ['q' => 'Hoe werken onderhoud en updates na de livegang?', 'a' => 'U kunt kiezen voor een maandelijks supportpakket voor kleine aanpassingen, bugfixes en updates, met snelle reactietijden. Grotere nieuwe functies prijs ik apart, na overleg.'],
                ['q' => 'Wat kost doorlopende support?', 'a' => 'Dat hangt af van de omvang van uw project. Kleine fixes en updates vallen binnen het pakket; grotere wensen bespreken we vooraf, zodat u nooit voor verrassingen staat.'],
                ['q' => 'Regelt u ook betalingen en abonnementen?', 'a' => 'Ja. Checkout, abonnementen, facturatie en webhooks via Stripe en Mollie, inclusief foutafhandeling en nieuwe pogingen bij mislukte betalingen.'],
                ['q' => 'Kan ik eerst vrijblijvend kennismaken?', 'a' => 'Ja. Het eerste gesprek is gratis en vrijblijvend. Laat uw gegevens achter via het formulier en ik reageer binnen 1 werkdag.'],
            ],
        ],

        'contact' => [
            'eyebrow' => 'Contact',
            'title' => 'Vertel me over uw project',
            'intro' => 'Beschrijf kort wat u zoekt. Ik reageer binnen 1 werkdag met een eerste reactie of een voorstel voor een kennismaking.',
            'direct' => 'Liever direct contact?',
            'email_label' => 'E-mail',
            'phone_label' => 'Telefoon',
            'response' => 'Reactie binnen 1 werkdag',
            'fields' => [
                'name' => 'Naam',
                'email' => 'E-mailadres',
                'project_type' => 'Type project',
                'project_type_placeholder' => 'Kies een type',
                'budget' => 'Budget',
                'budget_placeholder' => 'Nog niet bekend',
                'optional' => 'optioneel',
                'message' => 'Bericht',
                'message_hint' => 'Minimaal 20 tekens. Bijvoorbeeld: wat u wilt bereiken en wanneer.',
            ],
            'project_types' => [
                'website' => 'Website',
                'webshop' => 'Webshop',
                'adminpaneel' => 'Adminpaneel',
                'dashboard' => 'KPI-dashboard',
                'betalingen' => 'Betalingen',
                'api' => 'API-koppeling',
                'maatwerk' => 'Maatwerk / anders',
            ],
            'budgets' => [
                'lt-2500' => 'Tot € 2.500',
                '2500-5000' => '€ 2.500 – € 5.000',
                '5000-10000' => '€ 5.000 – € 10.000',
                'gt-10000' => 'Meer dan € 10.000',
            ],
            'submit' => 'Verstuur bericht',
        ],

        'forms' => [
            'sending' => 'Bezig met versturen…',
            'success_contact' => 'Bedankt! Uw bericht is verstuurd. Ik reageer binnen 1 werkdag.',
            'success_check' => 'Bedankt! Uw aanvraag is binnen. U ontvangt het rapport binnen 2 werkdagen.',
            'error' => 'Er ging iets mis. Controleer de gemarkeerde velden.',
            'error_generic' => 'Verzenden is mislukt. Probeer het later opnieuw of mail rechtstreeks.',
            'error_expired' => 'Uw sessie is verlopen. Ververs de pagina en probeer het opnieuw.',
            'error_throttled' => 'Te veel pogingen. Wacht een minuut en probeer het opnieuw.',
            'honeypot' => 'Laat dit veld leeg',
            // Under every form, with a link to the privacy statement.
            'privacy_note' => 'Ik gebruik uw gegevens alleen om te reageren.',
            'privacy_link' => 'Zie de privacyverklaring',
        ],

        'footer' => [
            'tagline' => 'Websites, adminpanelen, dashboards en betaalkoppelingen voor ondernemers.',
            'nav_title' => 'Navigatie',
            'contact_title' => 'Contact',
            'legal_title' => 'Gegevens',
            'kvk' => 'KvK',
            'btw' => 'BTW',
            'privacy' => ['label' => 'Privacyverklaring', 'href' => '/privacyverklaring'],
            'sitemap' => ['label' => 'Sitemap', 'href' => '/sitemap.xml'],
            'language' => ['label' => 'English', 'hreflang' => 'en'],
            'theme' => 'Donker thema',
            'rights' => 'Alle rechten voorbehouden.',
        ],

        'mobile_cta' => [
            'label' => 'Gratis website-check',
            'href' => '#website-check',
            'secondary' => 'Contact',
        ],

        /* Pages other than home. Home uses `meta` above. */
        'pages' => [
            'home' => ['crumb' => 'Home'],
            'contact' => [
                'title' => 'Contact | DevAim Labs',
                'description' => 'Neem contact op met DevAim Labs over uw website, adminpaneel, dashboard of koppeling. Via het formulier, e-mail of telefoon. Reactie binnen 1 werkdag.',
                'crumb' => 'Contact',
                'eyebrow' => 'Contact',
                'heading' => 'Vertel me over uw project',
                'intro' => 'Beschrijf kort wat u zoekt, via het formulier of rechtstreeks per e-mail of telefoon. U krijgt binnen 1 werkdag een eerste reactie of een voorstel voor een kennismaking.',
                'form_title' => 'Stuur een bericht',
                'next_title' => 'Wat er daarna gebeurt',
                'next' => [
                    'Ik lees uw bericht en reageer binnen 1 werkdag.',
                    'We plannen een kort, vrijblijvend gesprek over uw doelen.',
                    'U ontvangt een voorstel met een vaste prijs en planning.',
                ],
                'faq_title' => 'Veelgestelde vragen',
                // Indexes into `faq.items`.
                'faq_items' => [7, 2, 3, 1],
                'faq_more' => 'Alle vragen bekijken',
            ],
            'privacy' => [
                'title' => 'Privacyverklaring | DevAim Labs',
                'description' => 'Hoe DevAim Labs omgaat met persoonsgegevens: welke gegevens ik verwerk, waarom, hoe lang ik ze bewaar en welke rechten u heeft.',
                'crumb' => 'Privacyverklaring',
            ],
        ],

        'errors' => [
            'reach' => 'U kunt mij ook direct bereiken:',
            '404' => [
                'title' => 'Pagina niet gevonden | DevAim Labs',
                'heading' => 'Deze pagina bestaat niet (meer).',
                'text' => 'De link klopt niet, of de pagina is verplaatst. Ga naar de homepage, bekijk mijn diensten of neem contact op.',
                'home' => 'Naar de homepage',
                'services' => 'Bekijk diensten',
                'contact' => 'Neem contact op',
            ],
            '500' => [
                'title' => 'Er ging iets mis | DevAim Labs',
                'heading' => 'Er ging iets mis.',
                'text' => 'Er trad een fout op aan mijn kant. Probeer het over een paar minuten opnieuw.',
                'home' => 'Naar de homepage',
            ],
            '503' => [
                'title' => 'Even onderhoud | DevAim Labs',
                'heading' => 'Even onderhoud, zo terug.',
                'text' => 'De website wordt op dit moment bijgewerkt. Probeer het over een paar minuten opnieuw.',
                'home' => 'Opnieuw proberen',
            ],
        ],
    ],

    'en' => [
        'meta' => [
            'title' => 'DevAim Labs | Custom websites, admin panels and payments',
            'description' => 'I build websites, admin panels, KPI dashboards and payment integrations for business owners. Fixed price up front, one dedicated developer, a reply within 1 working day.',
            'og_locale' => 'en_US',
        ],

        'a11y' => [
            'skip' => 'Skip to content',
            'new_tab' => '(opens in a new tab)',
            'menu_open' => 'Open menu',
            'menu_close' => 'Close menu',
            'menu_title' => 'Menu',
            'theme' => 'Dark theme',
            'lang_label' => 'Language',
            'main_nav' => 'Main navigation',
            'home' => 'DevAim Labs, back to top',
            'home_link' => 'DevAim Labs, go to the home page',
            'breadcrumb' => 'Breadcrumb',
        ],

        'nav' => [
            'links' => [
                ['label' => 'Services', 'section' => 'services', 'menu' => true],
                ['label' => 'Work', 'section' => 'work'],
                ['label' => 'Process', 'section' => 'process'],
                ['label' => 'Pricing', 'section' => 'pricing'],
                ['label' => 'About', 'section' => 'about'],
                ['label' => 'Contact', 'page' => 'contact'],
            ],
            'cta' => ['label' => 'Free website check', 'section' => 'check'],
            'services_menu' => [
                'overview' => 'All services',
                'items' => [
                    ['label' => 'Websites', 'service' => 'websites'],
                    ['label' => 'Admin panels', 'service' => 'admin-panels'],
                    ['label' => 'KPI dashboards', 'service' => 'dashboards'],
                    ['label' => 'Payments', 'service' => 'payments'],
                    ['label' => 'API integrations', 'service' => 'api-integrations'],
                ],
            ],
        ],

        'ids' => [
            'services' => 'services',
            'work' => 'work',
            'process' => 'process',
            'pricing' => 'pricing',
            'about' => 'about',
            'check' => 'website-check',
            'faq' => 'faq',
            'contact' => 'contact',
        ],

        'hero' => [
            'eyebrow' => 'Custom websites & software',
            'title' => 'More customers, more enquiries,',
            'title_em' => 'less hassle.',
            'subtitle' => 'I build websites, admin panels, KPI dashboards and payment integrations that work for your business, so you spend less time on scattered spreadsheets and more on your customers.',
            'badge' => 'Available for new projects',
            'trust' => ['Reply within 1 working day', 'Fixed price up front', 'One dedicated developer'],
            'form' => [
                'title' => 'Request a free website check',
                'url_label' => 'Your website',
                'url_placeholder' => 'yourbusiness.com',
                'email_label' => 'Your email',
                'email_placeholder' => 'name@yourbusiness.com',
                'submit' => 'Request check',
                'note' => 'You get a short report within 2 working days. Free, no strings attached.',
            ],
            'secondary' => ['label' => 'See my work', 'href' => '#work'],
            // Illustration only: a generic business site, not client work.
            'mock' => [
                'aria' => 'Illustration: a visitor requests a quote through the website and the enquiry appears in the dashboard right away.',
                'url' => 'yourbusiness.com',
                'brand' => 'Your business',
                'nav' => ['Services', 'About', 'Contact'],
                'title' => 'Quality that lasts',
                'text' => 'Browse our services and request a free quote.',
                'button' => 'Request a quote',
                'tiles' => ['Services', 'Projects', 'Reviews'],
                'toast_title' => 'New enquiry',
                'toast_meta' => 'Via the contact form',
                'toast_time' => 'just now',
            ],
            'tech' => [
                'label' => 'Example data',
                'order' => 'Payment #2041 · iDEAL',
                'status' => 'paid',
                'kpi_label' => 'Enquiries this month',
                'kpi_value' => '148',
                'kpi_delta' => '+23%',
                'caption' => 'Example data from a demo dashboard',
            ],
        ],

        'proof' => [
            'clients_label' => 'Worked with',
            'pause' => 'Pause logos',
            'play' => 'Play logos',
        ],

        'services' => [
            'eyebrow' => 'Services',
            'title' => 'What I can build for your business',
            'intro' => 'From a first website to a link between your till, accounting and webshop. One point of contact for the whole project.',
            'link_prefix' => 'More about',
            'items' => [
                ['icon' => 'globe', 'title' => 'Websites', 'outcome' => 'A fast, findable website that turns visitors into bookings, enquiries or calls.', 'service' => 'websites'],
                ['icon' => 'shopping-bag', 'title' => 'Webshops', 'outcome' => 'Sell online with your own webshop: a clear collection, a basket and checkout with iDEAL, cards and more.', 'service' => 'websites'],
                ['icon' => 'layout-dashboard', 'title' => 'Admin panels', 'outcome' => 'Manage customers, orders and planning in one place instead of scattered spreadsheets.', 'service' => 'admin-panels'],
                ['icon' => 'chart', 'title' => 'KPI dashboards', 'outcome' => 'Revenue, orders and trends at a glance, updated without manual work.', 'service' => 'dashboards'],
                ['icon' => 'credit-card', 'title' => 'Payments', 'outcome' => 'Payments, subscriptions and invoices via Stripe or Mollie, including webhooks and error handling.', 'service' => 'payments'],
                ['icon' => 'workflow', 'title' => 'API integrations', 'outcome' => 'Your systems talk to each other: CRM, accounting, till or webshop, with no retyping.', 'service' => 'api-integrations'],
            ],
        ],

        'work' => [
            'eyebrow' => 'Work',
            'title' => 'Recently delivered',
            'intro' => 'Real projects for real business owners. This is what I built.',
            'problem_label' => 'The brief',
            'built_label' => 'What I built',
            'results_label' => 'Results',
            'tags_label' => 'Tags',
            'live_label' => 'Visit the live site',
            'cases' => [
                [
                    'name' => 'Lokanta Proeflokaal',
                    'domain' => 'lokanta-proeflokaal.nl',
                    'url' => 'https://lokanta-proeflokaal.nl',
                    'image' => '/lokanta.webp',
                    'width' => 200,
                    'height' => 71,
                    'alt' => 'Lokanta Proeflokaal logo',
                    'tags' => ['Restaurant', 'Website', 'Astro'],
                    // TODO: owner to confirm the wording of the client's original question.
                    'problem' => 'A tapas bar that wanted guests to get a taste online first: the menu, the atmosphere and how to book a table.',
                    'built' => 'A restaurant website with the menu, atmosphere photos, booking and all the practical information guests need before they walk in.',
                    // TODO: add real, verifiable results. Leave empty until then.
                    'results' => [],
                ],
                [
                    'name' => 'Slowdown Store',
                    'domain' => 'slowdownstore.com',
                    'url' => 'https://slowdownstore.com',
                    'image' => '/slowdown.webp',
                    'width' => 125,
                    'height' => 65,
                    'alt' => 'Slowdown Store logo',
                    'tags' => ['Fashion', 'Webshop', 'Astro'],
                    // TODO: owner to confirm the wording of the client's original question.
                    'problem' => 'An independent fashion label that wanted to sell its collection in its own store, independent of the big platforms.',
                    'built' => 'A webshop for the label, with product pages that show off the collection and its own online sales channel.',
                    // TODO: add real, verifiable results. Leave empty until then.
                    'results' => [],
                ],
            ],
        ],

        'process' => [
            'eyebrow' => 'Process',
            'title' => 'Three steps, no surprises',
            'intro' => 'You know up front what you get, what it costs and when it is ready.',
            'steps' => [
                ['title' => 'Intro & advice', 'text' => 'We talk about your business and your goals. I give honest advice on what you need, and what you don\'t. Then you get a proposal with a fixed price and timeline.'],
                ['title' => 'Design & build', 'text' => 'I design and build in short rounds. You see working versions along the way and can steer before anything is final.'],
                ['title' => 'Launch & support', 'text' => 'Once you approve, everything goes live. The code is yours, and I stay available for maintenance, updates and new ideas.'],
            ],
        ],

        'about' => [
            'eyebrow' => 'About me',
            'title' => 'You talk directly to the developer who builds',
            'initials' => 'DL', // TODO: real photo (replace the initials plate) and the developer's initials.
            'photo_alt' => 'Portrait photo coming soon',
            'paragraphs' => [
                'I\'m the developer behind DevAim Labs. I build your website, admin panel, dashboard or integration myself, from the first conversation to launch.',
                'No account manager and no changing contacts. What you discuss with me is exactly what gets built. That means short lines and quick changes when things shift.',
            ],
            'direct' => 'Direct contact',
            'stack_label' => 'What I work with',
            'stack' => ['Laravel', 'PHP', 'Vue', 'TypeScript', 'Astro', 'Tailwind CSS', 'Stripe', 'Mollie', 'REST APIs'],
        ],

        'pricing' => [
            'eyebrow' => 'Pricing',
            'title' => 'Clear packages',
            'intro' => 'Every project is different, but you always know where you stand up front.',
            'note' => 'Fixed price up front, no surprises.',
            'from' => 'from',
            'on_request' => 'Price on request',
            'highlight' => 'Recommended',
            'currency' => '€',
            'packages' => [
                [
                    'key' => 'starter',
                    'name' => 'Starter website',
                    'tagline' => 'For business owners who want a professional presence online.',
                    // TODO: fill in real "vanaf" price
                    'price_from' => null,
                    'features' => ['Custom website, up to 5 pages', 'Mobile-friendly and fast', 'Basic SEO and Google Maps', 'Contact form', 'Help with hosting and launch'],
                    'cta' => 'Start with a website',
                    'project_type' => 'website',
                    'highlighted' => false,
                ],
                [
                    'key' => 'groei',
                    'name' => 'Growth',
                    'tagline' => 'Website + leads & CMS: edit your own content and bring in more enquiries.',
                    // TODO: fill in real "vanaf" price
                    'price_from' => null,
                    'features' => ['Everything in Starter', 'Manage your own content (CMS)', 'Booking or quote forms', 'Email or calendar integration', 'Analytics and conversion tracking'],
                    'cta' => 'Choose Growth',
                    'project_type' => 'website',
                    'highlighted' => true,
                ],
                [
                    'key' => 'maatwerk',
                    'name' => 'Custom',
                    'tagline' => 'Dashboards, portals and integrations for processes that don\'t fit an off-the-shelf package.',
                    // TODO: fill in real "vanaf" price
                    'price_from' => null,
                    'features' => ['Admin panels and client portals', 'KPI dashboards', 'Payments via Stripe or Mollie', 'API integrations with your systems', 'Maintenance and ongoing development'],
                    'cta' => 'Discuss your project',
                    'project_type' => 'maatwerk',
                    'highlighted' => false,
                ],
            ],
        ],

        'check' => [
            'eyebrow' => 'Free website check',
            'title' => 'How well does your current website work?',
            'text' => 'Get your website checked for free. Within 2 working days you receive a short written report with concrete improvements. No obligation, no sales pitch.',
            'points' => [
                ['icon' => 'gauge', 'title' => 'Speed', 'text' => 'How fast does your site load on a phone?'],
                ['icon' => 'search', 'title' => 'SEO', 'text' => 'Are you found for the search terms that matter?'],
                ['icon' => 'trending-up', 'title' => 'Conversion', 'text' => 'Is it easy for visitors to get in touch or place an order?'],
            ],
            'form' => [
                'url_label' => 'Your website',
                'url_placeholder' => 'yourbusiness.com',
                'email_label' => 'Your email',
                'email_placeholder' => 'name@yourbusiness.com',
                'name_label' => 'Your name',
                'optional' => 'optional',
                'submit' => 'Request the free check',
                'note' => 'Report in your inbox within 2 working days.',
            ],
        ],

        'faq' => [
            'eyebrow' => 'FAQ',
            'title' => 'Good to know',
            'more' => 'Don\'t see your question?',
            'more_link' => 'Ask me directly',
            'items' => [
                ['q' => 'What kind of websites and software do you build?', 'a' => 'Websites, webshops, admin panels, KPI dashboards, integrations with CRM or accounting, and payment flows. Usually with Laravel and Vue, and providers like Stripe or Mollie.'],
                ['q' => 'Can you connect to the systems I already use?', 'a' => 'Yes. Integrations are at the core of my work: webhooks, APIs and sync jobs, so your systems talk to each other and you\'re not locked into one vendor.'],
                ['q' => 'How long does a project take?', 'a' => 'It depends on the scope. A website or a first version of an admin panel can be ready in a few weeks; larger dashboards with integrations often take a few months. You get a timeline up front.'],
                ['q' => 'Who owns the code?', 'a' => 'You do. After delivery you receive the complete source code and the documentation you need to run or extend it yourself, without restrictions.'],
                ['q' => 'How do maintenance and updates work after launch?', 'a' => 'You can choose a monthly support package for small changes, bug fixes and updates, with fast response times. Larger new features are priced separately, after we discuss them.'],
                ['q' => 'What does ongoing support cost?', 'a' => 'It depends on the size of your project. Small fixes and updates are included in the package; larger requests are agreed up front, so there are never surprises.'],
                ['q' => 'Do you handle payments and subscriptions?', 'a' => 'Yes. Checkout, subscriptions, invoicing and webhooks via Stripe and Mollie, including error handling and retries for failed payments.'],
                ['q' => 'Can we have a no-obligation intro first?', 'a' => 'Yes. The first conversation is free and without obligation. Leave your details via the form and I\'ll reply within 1 working day.'],
            ],
        ],

        'contact' => [
            'eyebrow' => 'Contact',
            'title' => 'Tell me about your project',
            'intro' => 'Briefly describe what you are looking for. I reply within 1 working day with a first response or a proposal to meet.',
            'direct' => 'Prefer direct contact?',
            'email_label' => 'Email',
            'phone_label' => 'Phone',
            'response' => 'Reply within 1 working day',
            'fields' => [
                'name' => 'Name',
                'email' => 'Email address',
                'project_type' => 'Project type',
                'project_type_placeholder' => 'Choose a type',
                'budget' => 'Budget',
                'budget_placeholder' => 'Not sure yet',
                'optional' => 'optional',
                'message' => 'Message',
                'message_hint' => 'At least 20 characters. For example: what you want to achieve and when.',
            ],
            'project_types' => [
                'website' => 'Website',
                'webshop' => 'Webshop',
                'adminpaneel' => 'Admin panel',
                'dashboard' => 'KPI dashboard',
                'betalingen' => 'Payments',
                'api' => 'API integration',
                'maatwerk' => 'Custom / other',
            ],
            'budgets' => [
                'lt-2500' => 'Up to € 2,500',
                '2500-5000' => '€ 2,500 – € 5,000',
                '5000-10000' => '€ 5,000 – € 10,000',
                'gt-10000' => 'More than € 10,000',
            ],
            'submit' => 'Send message',
        ],

        'forms' => [
            'sending' => 'Sending…',
            'success_contact' => 'Thank you! Your message has been sent. I\'ll reply within 1 working day.',
            'success_check' => 'Thank you! Your request is in. You\'ll receive the report within 2 working days.',
            'error' => 'Something went wrong. Please check the highlighted fields.',
            'error_generic' => 'Sending failed. Please try again later or email me directly.',
            'error_expired' => 'Your session has expired. Please refresh the page and try again.',
            'error_throttled' => 'Too many attempts. Please wait a minute and try again.',
            'honeypot' => 'Leave this field empty',
            'privacy_note' => 'I only use your details to reply to you.',
            'privacy_link' => 'See the privacy statement (in Dutch)',
        ],

        'footer' => [
            'tagline' => 'Websites, admin panels, dashboards and payment integrations for business owners.',
            'nav_title' => 'Navigation',
            'contact_title' => 'Contact',
            'legal_title' => 'Company details',
            'kvk' => 'Chamber of Commerce (KvK)',
            'btw' => 'VAT',
            'privacy' => ['label' => 'Privacy statement (Dutch)', 'href' => '/privacyverklaring'],
            'sitemap' => ['label' => 'Sitemap', 'href' => '/sitemap.xml'],
            'language' => ['label' => 'Nederlands', 'hreflang' => 'nl'],
            'theme' => 'Dark theme',
            'rights' => 'All rights reserved.',
        ],

        'mobile_cta' => [
            'label' => 'Free website check',
            'href' => '#website-check',
            'secondary' => 'Contact',
        ],

        'pages' => [
            'home' => ['crumb' => 'Home'],
            'contact' => [
                'title' => 'Contact | DevAim Labs',
                'description' => 'Get in touch with DevAim Labs about your website, admin panel, dashboard or integration. Use the form, email or phone. Reply within 1 working day.',
                'crumb' => 'Contact',
                'eyebrow' => 'Contact',
                'heading' => 'Tell me about your project',
                'intro' => 'Briefly describe what you are looking for, through the form or directly by email or phone. Within 1 working day you get a first response or a proposal to meet.',
                'form_title' => 'Send a message',
                'next_title' => 'What happens next',
                'next' => [
                    'I read your message and reply within 1 working day.',
                    'We schedule a short, no-obligation call about your goals.',
                    'You receive a proposal with a fixed price and timeline.',
                ],
                'faq_title' => 'Frequently asked questions',
                'faq_items' => [7, 2, 3, 1],
                'faq_more' => 'See all questions',
            ],
        ],

        'errors' => [
            'reach' => 'You can also reach me directly:',
            '404' => [
                'title' => 'Page not found | DevAim Labs',
                'heading' => 'This page does not exist (anymore).',
                'text' => 'The link is wrong, or the page has moved. Go to the home page, see my services or get in touch.',
                'home' => 'Go to the home page',
                'services' => 'See services',
                'contact' => 'Get in touch',
            ],
            '500' => [
                'title' => 'Something went wrong | DevAim Labs',
                'heading' => 'Something went wrong.',
                'text' => 'An error occurred on my side. Please try again in a few minutes.',
                'home' => 'Go to the home page',
            ],
            '503' => [
                'title' => 'Down for maintenance | DevAim Labs',
                'heading' => 'Down for maintenance, back soon.',
                'text' => 'The website is being updated right now. Please try again in a few minutes.',
                'home' => 'Try again',
            ],
        ],
    ],
];
