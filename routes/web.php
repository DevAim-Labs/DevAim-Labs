<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('home');
});

Route::post('/contact', [ContactController::class, 'store'])
    ->middleware('throttle:5,1');
