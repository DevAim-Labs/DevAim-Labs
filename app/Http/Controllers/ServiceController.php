<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Service slug mapping for Dutch routes
     */
    protected array $servicesNl = [
        'websites' => [
            'id' => 'websites',
            'title' => "Websites & Portfolio's | DevAim Labs",
            'description' => "Snelle, SEO-vriendelijke websites en portfolio's die converteren. Direct contact met de developer die bouwt.",
            'keywords' => 'website ontwikkeling, portfolio website, SEO website, responsive design, Laravel website',
        ],
        'adminpanelen' => [
            'id' => 'admin-panels',
            'title' => 'Adminpanelen | DevAim Labs',
            'description' => 'Vervang spreadsheets door echte tooling met rollen en rechten. Custom adminpanelen op maat.',
            'keywords' => 'adminpaneel, dashboard, RBAC, interne tools, admin systeem',
        ],
        'dashboards' => [
            'id' => 'dashboards',
            'title' => 'KPI-dashboards | DevAim Labs',
            'description' => 'Realtime inzicht in je bedrijfsdata met live cijfers, grafieken en alerts.',
            'keywords' => 'KPI dashboard, data visualisatie, business intelligence, realtime metrics',
        ],
        'betalingen' => [
            'id' => 'payments',
            'title' => 'Betaalintegraties | DevAim Labs',
            'description' => 'Stripe en Mollie integraties voor checkout, abonnementen en automatische facturatie.',
            'keywords' => 'Stripe integratie, Mollie, betalingen, checkout, subscriptions',
        ],
        'api-integraties' => [
            'id' => 'api-integrations',
            'title' => 'API-koppelingen | DevAim Labs',
            'description' => "REST API's, webhooks en synchronisaties tussen je systemen. Koppel alles aan elkaar.",
            'keywords' => 'API integratie, REST API, webhooks, systeem koppeling, data sync',
        ],
    ];

    /**
     * Service slug mapping for English routes
     */
    protected array $servicesEn = [
        'websites' => [
            'id' => 'websites',
            'title' => 'Websites & Portfolios | DevAim Labs',
            'description' => 'Fast, SEO-friendly websites and portfolios that convert. Direct contact with the developer who builds.',
            'keywords' => 'website development, portfolio website, SEO website, responsive design, Laravel website',
        ],
        'admin-panels' => [
            'id' => 'admin-panels',
            'title' => 'Admin Panels | DevAim Labs',
            'description' => 'Replace spreadsheets with real tooling with roles and permissions. Custom admin panels tailored to you.',
            'keywords' => 'admin panel, dashboard, RBAC, internal tools, admin system',
        ],
        'dashboards' => [
            'id' => 'dashboards',
            'title' => 'KPI Dashboards | DevAim Labs',
            'description' => 'Real-time insight into your business data with live metrics, charts and alerts.',
            'keywords' => 'KPI dashboard, data visualization, business intelligence, realtime metrics',
        ],
        'payments' => [
            'id' => 'payments',
            'title' => 'Payment Integrations | DevAim Labs',
            'description' => 'Stripe and Mollie integrations for checkout, subscriptions and automatic invoicing.',
            'keywords' => 'Stripe integration, Mollie, payments, checkout, subscriptions',
        ],
        'api-integrations' => [
            'id' => 'api-integrations',
            'title' => 'API Integrations | DevAim Labs',
            'description' => 'REST APIs, webhooks and synchronizations between your systems. Connect everything.',
            'keywords' => 'API integration, REST API, webhooks, system connection, data sync',
        ],
    ];

    /**
     * Mapping from NL slugs to EN slugs for alternate URLs
     */
    protected array $slugMappingNlToEn = [
        'websites' => 'websites',
        'adminpanelen' => 'admin-panels',
        'dashboards' => 'dashboards',
        'betalingen' => 'payments',
        'api-integraties' => 'api-integrations',
    ];

    /**
     * Mapping from EN slugs to NL slugs for alternate URLs
     */
    protected array $slugMappingEnToNl = [
        'websites' => 'websites',
        'admin-panels' => 'adminpanelen',
        'dashboards' => 'dashboards',
        'payments' => 'betalingen',
        'api-integrations' => 'api-integraties',
    ];

    /**
     * Show Dutch service page
     */
    public function show(string $service): View
    {
        if (! isset($this->servicesNl[$service])) {
            abort(404);
        }

        return $this->renderServicePage($service, 'nl');
    }

    /**
     * Show English service page
     */
    public function showEn(string $service): View
    {
        if (! isset($this->servicesEn[$service])) {
            abort(404);
        }

        return $this->renderServicePage($service, 'en');
    }

    /**
     * Render the service page with proper SEO data
     */
    protected function renderServicePage(string $slug, string $locale): View
    {
        $services = $locale === 'en' ? $this->servicesEn : $this->servicesNl;
        $service = $services[$slug];

        $homePath = $locale === 'en' ? '/en' : '/';
        $servicesPath = $locale === 'en' ? '/en/services' : '/diensten';
        $currentPath = $locale === 'en' ? "/en/services/{$slug}" : "/diensten/{$slug}";

        // Breadcrumb labels
        $breadcrumbLabels = $locale === 'en'
            ? ['services' => 'Services', 'home' => 'Home']
            : ['services' => 'Diensten', 'home' => 'Home'];

        // Service-specific breadcrumb name (strip " | DevAim Labs")
        $serviceName = str_replace(' | DevAim Labs', '', $service['title']);

        $breadcrumbs = [
            ['name' => $breadcrumbLabels['home'], 'path' => $homePath],
            ['name' => $breadcrumbLabels['services'], 'path' => $servicesPath],
            ['name' => $serviceName, 'path' => $currentPath],
        ];

        // Alternate language URLs
        $alternateUrls = [];
        if ($locale === 'nl') {
            $enSlug = $this->slugMappingNlToEn[$slug] ?? $slug;
            $alternateUrls['nl'] = url($currentPath);
            $alternateUrls['en'] = url("/en/services/{$enSlug}");
        } else {
            $nlSlug = $this->slugMappingEnToNl[$slug] ?? $slug;
            $alternateUrls['en'] = url($currentPath);
            $alternateUrls['nl'] = url("/diensten/{$nlSlug}");
        }

        return view('service-page', [
            'service' => $service['id'],
            'serviceSlug' => $slug,
            'pageTitle' => $service['title'],
            'pageDescription' => $service['description'],
            'ogTitle' => $service['title'],
            'ogDescription' => $service['description'],
            'ogLocale' => $locale === 'en' ? 'en_US' : 'nl_NL',
            'canonicalUrl' => url($currentPath),
            'breadcrumbs' => $breadcrumbs,
            'locale' => $locale,
            'alternateUrls' => $alternateUrls,
        ]);
    }
}
