<?php

namespace App\Http\Controllers;

use App\Support\ServiceCatalog;
use App\Support\SitePage;
use Illuminate\View\View;

/**
 * The site's own pages: home, contact, privacy and the service detail
 * pages. All view data comes from SitePage. The /en routes pass
 * `locale` through ->defaults() in routes/web.php.
 */
class PageController extends Controller
{
    public function home(string $locale = 'nl'): View
    {
        return view('v2.home', SitePage::data($locale, 'home'));
    }

    public function contact(string $locale = 'nl'): View
    {
        return view('v2.contact', SitePage::data($locale, 'contact'));
    }

    public function privacy(): View
    {
        return view('v2.privacy', SitePage::data('nl', 'privacy'));
    }

    /** /diensten/{service} and /en/services/{service} (slugs constrained in routes/web.php). */
    public function service(string $service, string $locale = 'nl'): View
    {
        $key = ServiceCatalog::keyForSlug($locale, $service) ?? abort(404);

        return view('v2.service', SitePage::service($locale, $key));
    }
}
