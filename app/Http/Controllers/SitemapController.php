<?php

namespace App\Http\Controllers;

use App\Support\PageRegistry;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Every Page in the PageRegistry, one <url> per locale with its
     * hreflang set. Only URLs that answer 200 are Pages: the old section
     * URLs 301 to anchors on the home page (see App\Support\LegacyRedirects).
     */
    public function __invoke(): Response
    {
        $xml = view('sitemap', ['urls' => PageRegistry::sitemap()])->render();

        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
