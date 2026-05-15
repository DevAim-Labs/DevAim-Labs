<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home', [
        'services' => [
            ['icon' => '◈', 'title' => 'Custom Websites', 'description' => 'Marketing sites, landing pages, and portfolios built for performance.'],
            ['icon' => '⬡', 'title' => 'Web Applications', 'description' => 'Full-stack apps with authentication, roles, business logic, and clean APIs.'],
            ['icon' => '▦', 'title' => 'Dashboards & Systems', 'description' => 'Admin panels, reporting tools, and internal tooling your team actually wants to use.'],
            ['icon' => '◎', 'title' => 'Integrations', 'description' => 'Third-party APIs, webhooks, and service integrations that extend what your application can do.'],
            ['icon' => '◈', 'title' => 'Payment Systems', 'description' => 'Stripe subscriptions, webhooks, invoicing, and checkout flows — end-to-end.'],
            ['icon' => '⬡', 'title' => 'API Development', 'description' => 'REST APIs and backend services that other systems can rely on at scale.'],
        ],
    ]);
});

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1');
