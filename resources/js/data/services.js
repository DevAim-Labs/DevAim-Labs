/**
 * Service page content data for all 5 services in NL and EN
 */

export const servicesData = {
    nl: {
        websites: {
            id: 'websites',
            title: "Websites & Portfolio's",
            tagline: 'Snelle, SEO-vriendelijke websites die converteren.',
            demoUrl: '/demo/website.html',
            demoLabel: 'Bekijk live demo',
            problem: {
                headline: 'Je huidige website werkt tegen je',
                description: 'Trage laadtijden, slechte mobiele ervaring, onvindbaar in Google. Bezoekers haken af voordat ze je verhaal horen. Je mist klanten aan concurrenten met betere websites.',
            },
            solution: {
                headline: 'Een website die voor je werkt',
                description: 'Ik bouw websites die razendsnel laden, perfect werken op elk apparaat en hoog scoren in zoekmachines. Van portfolio tot bedrijfssite — elke pixel telt.',
            },
            features: [
                {
                    title: 'SEO-geoptimaliseerd',
                    description: 'Technische SEO, structured data en snelle laadtijden voor betere vindbaarheid.',
                },
                {
                    title: 'Razendsnelle performance',
                    description: 'Core Web Vitals die groen scoren. Geen frustrerende wachttijden.',
                },
                {
                    title: 'Volledig responsive',
                    description: 'Perfect op desktop, tablet en mobiel. Geen compromissen.',
                },
                {
                    title: 'Eenvoudig te beheren',
                    description: 'CMS-integratie zodat je zelf content kunt aanpassen.',
                },
            ],
            cta: {
                headline: 'Klaar voor een website die werkt?',
                label: 'Start een project',
                link: '/contact',
            },
            accent: 'teal',
        },

        'admin-panels': {
            id: 'admin-panels',
            title: 'Adminpanelen',
            tagline: 'Vervang spreadsheets door echte tooling.',
            demoUrl: '/demo/adminpaneel.html',
            demoLabel: 'Bekijk live demo',
            problem: {
                headline: 'Spreadsheets groeien je boven het hoofd',
                description: 'Excel-bestanden vol formules die niemand begrijpt. Handmatig kopiëren tussen systemen. Geen overzicht, geen controle, geen audit trail.',
            },
            solution: {
                headline: 'Een adminpaneel op maat',
                description: 'Ik bouw interne tools die precies doen wat jij nodig hebt. Met rollen en rechten, zoekfuncties, bulk-acties en complete audit logs.',
            },
            features: [
                {
                    title: 'Rollen & rechten',
                    description: 'Bepaal wie wat mag zien en doen. Granulaire RBAC-permissies.',
                },
                {
                    title: 'Krachtig zoeken & filteren',
                    description: 'Vind direct wat je zoekt. Geavanceerde filters en full-text search.',
                },
                {
                    title: 'Bulk-acties',
                    description: 'Bewerk honderden records in één keer. Geen handmatig werk meer.',
                },
                {
                    title: 'Complete audit logs',
                    description: 'Zie precies wie wat wanneer heeft aangepast. Volledige traceerbaarheid.',
                },
            ],
            cta: {
                headline: 'Klaar om van spreadsheets af te komen?',
                label: 'Start een project',
                link: '/contact',
            },
            accent: 'violet',
        },

        dashboards: {
            id: 'dashboards',
            title: 'KPI-dashboards',
            tagline: 'Realtime inzicht in je bedrijfsdata.',
            demoUrl: '/demo/kpi-dashboard.html',
            demoLabel: 'Bekijk live demo',
            problem: {
                headline: 'Je data zit verspreid en verouderd',
                description: 'Rapporten die dagen oud zijn. Data in verschillende systemen die niet praten. Beslissingen nemen op gevoel in plaats van feiten.',
            },
            solution: {
                headline: 'Live dashboards met je KPIs',
                description: 'Ik bouw dashboards die realtime data tonen uit al je bronnen. Grafieken, alerts en exports — alles wat je nodig hebt voor data-gedreven beslissingen.',
            },
            features: [
                {
                    title: 'Realtime data',
                    description: 'Live cijfers die automatisch updaten. Geen verouderde rapporten meer.',
                },
                {
                    title: 'Slimme alerts',
                    description: 'Automatische notificaties wanneer KPIs buiten bereik gaan.',
                },
                {
                    title: 'Multi-source integratie',
                    description: 'Data uit CRM, ERP, analytics en meer — allemaal op één plek.',
                },
                {
                    title: 'Export & rapportage',
                    description: 'Genereer PDF-rapporten en exporteer data naar Excel.',
                },
            ],
            cta: {
                headline: 'Klaar voor realtime inzicht?',
                label: 'Start een project',
                link: '/contact',
            },
            accent: 'green',
        },

        payments: {
            id: 'payments',
            title: 'Betaalintegraties',
            tagline: 'Stripe en Mollie voor naadloze betalingen.',
            demoUrl: '/demo/betaalsysteem.html',
            demoLabel: 'Bekijk live demo',
            problem: {
                headline: 'Betalingen kosten je tijd en geld',
                description: 'Handmatig facturen versturen. Achter wanbetalers aan moeten. Geen inzicht in recurring revenue. Checkout die klanten afschrikt.',
            },
            solution: {
                headline: 'Betalingen die automatisch lopen',
                description: 'Ik integreer Stripe of Mollie zodat betalingen vanzelf gaan. Checkout, abonnementen, facturatie en webhooks — volledig geautomatiseerd.',
            },
            features: [
                {
                    title: 'Checkout integratie',
                    description: 'Naadloze betaalervaring met iDEAL, creditcard, Bancontact en meer.',
                },
                {
                    title: 'Abonnementen',
                    description: 'Recurring billing met prorates, upgrades en downgrades.',
                },
                {
                    title: 'Automatische facturatie',
                    description: 'Facturen worden automatisch gegenereerd en verstuurd.',
                },
                {
                    title: 'Webhook handling',
                    description: 'Betrouwbare afhandeling van betaalevents. Nooit meer gemiste betalingen.',
                },
            ],
            cta: {
                headline: 'Klaar om betalingen te automatiseren?',
                label: 'Start een project',
                link: '/contact',
            },
            accent: 'green',
        },

        'api-integrations': {
            id: 'api-integrations',
            title: 'API-koppelingen',
            tagline: 'Koppel al je systemen aan elkaar.',
            demoUrl: null,
            demoLabel: null,
            problem: {
                headline: 'Je systemen praten niet met elkaar',
                description: 'Handmatig data overzetten tussen tools. Fouten door dubbele invoer. Geen single source of truth. Frustratie bij je team.',
            },
            solution: {
                headline: 'Systemen die samenwerken',
                description: "Ik bouw API-koppelingen die je systemen verbinden. REST API's, webhooks en synchronisaties — zodat data automatisch stroomt waar het moet zijn.",
            },
            features: [
                {
                    title: "REST API's",
                    description: 'Robuuste API-integraties met externe services en platforms.',
                },
                {
                    title: 'Webhooks',
                    description: 'Realtime events die direct actie triggeren in je systemen.',
                },
                {
                    title: 'Data synchronisatie',
                    description: 'Automatische sync tussen CRM, ERP, e-commerce en meer.',
                },
                {
                    title: 'Foutafhandeling',
                    description: 'Retry-mechanismen en logging zodat niets verloren gaat.',
                },
            ],
            cta: {
                headline: 'Klaar om je systemen te verbinden?',
                label: 'Start een project',
                link: '/contact',
            },
            accent: 'blue',
        },
    },

    en: {
        websites: {
            id: 'websites',
            title: 'Websites & Portfolios',
            tagline: 'Fast, SEO-friendly websites that convert.',
            demoUrl: '/demo/website.html',
            demoLabel: 'View live demo',
            problem: {
                headline: 'Your current website is working against you',
                description: "Slow load times, poor mobile experience, invisible in Google. Visitors leave before hearing your story. You're losing customers to competitors with better websites.",
            },
            solution: {
                headline: 'A website that works for you',
                description: 'I build websites that load lightning fast, work perfectly on every device, and rank high in search engines. From portfolio to business site — every pixel counts.',
            },
            features: [
                {
                    title: 'SEO Optimized',
                    description: 'Technical SEO, structured data, and fast load times for better visibility.',
                },
                {
                    title: 'Lightning Fast Performance',
                    description: 'Core Web Vitals that score green. No frustrating wait times.',
                },
                {
                    title: 'Fully Responsive',
                    description: 'Perfect on desktop, tablet, and mobile. No compromises.',
                },
                {
                    title: 'Easy to Manage',
                    description: 'CMS integration so you can update content yourself.',
                },
            ],
            cta: {
                headline: 'Ready for a website that works?',
                label: 'Start a project',
                link: '/en/contact',
            },
            accent: 'teal',
        },

        'admin-panels': {
            id: 'admin-panels',
            title: 'Admin Panels',
            tagline: 'Replace spreadsheets with real tooling.',
            demoUrl: '/demo/adminpaneel.html',
            demoLabel: 'View live demo',
            problem: {
                headline: 'Spreadsheets are getting out of control',
                description: 'Excel files full of formulas nobody understands. Manual copying between systems. No overview, no control, no audit trail.',
            },
            solution: {
                headline: 'A custom admin panel',
                description: 'I build internal tools that do exactly what you need. With roles and permissions, search functions, bulk actions, and complete audit logs.',
            },
            features: [
                {
                    title: 'Roles & Permissions',
                    description: 'Control who can see and do what. Granular RBAC permissions.',
                },
                {
                    title: 'Powerful Search & Filter',
                    description: 'Find what you need instantly. Advanced filters and full-text search.',
                },
                {
                    title: 'Bulk Actions',
                    description: 'Edit hundreds of records at once. No more manual work.',
                },
                {
                    title: 'Complete Audit Logs',
                    description: 'See exactly who changed what and when. Full traceability.',
                },
            ],
            cta: {
                headline: 'Ready to ditch the spreadsheets?',
                label: 'Start a project',
                link: '/en/contact',
            },
            accent: 'violet',
        },

        dashboards: {
            id: 'dashboards',
            title: 'KPI Dashboards',
            tagline: 'Real-time insight into your business data.',
            demoUrl: '/demo/kpi-dashboard.html',
            demoLabel: 'View live demo',
            problem: {
                headline: 'Your data is scattered and outdated',
                description: "Reports that are days old. Data in different systems that don't talk. Making decisions on gut feeling instead of facts.",
            },
            solution: {
                headline: 'Live dashboards with your KPIs',
                description: 'I build dashboards that show real-time data from all your sources. Charts, alerts, and exports — everything you need for data-driven decisions.',
            },
            features: [
                {
                    title: 'Real-time Data',
                    description: 'Live metrics that update automatically. No more outdated reports.',
                },
                {
                    title: 'Smart Alerts',
                    description: 'Automatic notifications when KPIs go out of range.',
                },
                {
                    title: 'Multi-source Integration',
                    description: 'Data from CRM, ERP, analytics and more — all in one place.',
                },
                {
                    title: 'Export & Reporting',
                    description: 'Generate PDF reports and export data to Excel.',
                },
            ],
            cta: {
                headline: 'Ready for real-time insight?',
                label: 'Start a project',
                link: '/en/contact',
            },
            accent: 'green',
        },

        payments: {
            id: 'payments',
            title: 'Payment Integrations',
            tagline: 'Stripe and Mollie for seamless payments.',
            demoUrl: '/demo/betaalsysteem.html',
            demoLabel: 'View live demo',
            problem: {
                headline: 'Payments are costing you time and money',
                description: 'Manually sending invoices. Chasing late payments. No insight into recurring revenue. Checkout that scares away customers.',
            },
            solution: {
                headline: 'Payments that run automatically',
                description: 'I integrate Stripe or Mollie so payments happen automatically. Checkout, subscriptions, invoicing, and webhooks — fully automated.',
            },
            features: [
                {
                    title: 'Checkout Integration',
                    description: 'Seamless payment experience with cards, iDEAL, Bancontact and more.',
                },
                {
                    title: 'Subscriptions',
                    description: 'Recurring billing with prorations, upgrades, and downgrades.',
                },
                {
                    title: 'Automatic Invoicing',
                    description: 'Invoices are automatically generated and sent.',
                },
                {
                    title: 'Webhook Handling',
                    description: 'Reliable processing of payment events. Never miss a payment again.',
                },
            ],
            cta: {
                headline: 'Ready to automate payments?',
                label: 'Start a project',
                link: '/en/contact',
            },
            accent: 'green',
        },

        'api-integrations': {
            id: 'api-integrations',
            title: 'API Integrations',
            tagline: 'Connect all your systems together.',
            demoUrl: null,
            demoLabel: null,
            problem: {
                headline: "Your systems don't talk to each other",
                description: 'Manually transferring data between tools. Errors from double entry. No single source of truth. Frustration for your team.',
            },
            solution: {
                headline: 'Systems that work together',
                description: 'I build API integrations that connect your systems. REST APIs, webhooks, and synchronizations — so data flows automatically where it needs to be.',
            },
            features: [
                {
                    title: 'REST APIs',
                    description: 'Robust API integrations with external services and platforms.',
                },
                {
                    title: 'Webhooks',
                    description: 'Real-time events that trigger actions in your systems instantly.',
                },
                {
                    title: 'Data Synchronization',
                    description: 'Automatic sync between CRM, ERP, e-commerce, and more.',
                },
                {
                    title: 'Error Handling',
                    description: 'Retry mechanisms and logging so nothing gets lost.',
                },
            ],
            cta: {
                headline: 'Ready to connect your systems?',
                label: 'Start a project',
                link: '/en/contact',
            },
            accent: 'blue',
        },
    },
}

/**
 * Get service content by ID and locale
 */
export function getServiceContent(serviceId, locale = 'nl') {
    const localeData = servicesData[locale] || servicesData.nl
    return localeData[serviceId] || null
}

/**
 * Get all services for a locale
 */
export function getAllServices(locale = 'nl') {
    return servicesData[locale] || servicesData.nl
}
