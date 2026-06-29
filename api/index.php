<?php

// 1. Paksa PHP menampilkan error ke log Vercel jika terjadi crash backend
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 2. Arahkan autoload & bootstrap secara tepat dari subfolder api/ ke root folder
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Tangani request menggunakan instance internal kernel Laravel
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);