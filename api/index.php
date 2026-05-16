<?php

define('LARAVEL_START', microtime(true));

/*
 * Vercel's filesystem is read-only except /tmp.
 * Create the storage structure there so Laravel can write
 * compiled views, framework cache, and logs at runtime.
 */
$storagePath = '/tmp/storage';
@mkdir($storagePath . '/framework/cache/data', 0755, true);
@mkdir($storagePath . '/framework/sessions',   0755, true);
@mkdir($storagePath . '/framework/views',      0755, true);
@mkdir($storagePath . '/logs',                 0755, true);
putenv('APP_STORAGE_PATH=' . $storagePath);

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
