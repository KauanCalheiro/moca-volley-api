<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__ . '/api/v1/check.php';
    require __DIR__ . '/api/v1/auth.php';
    require __DIR__ . '/api/v1/protected.php';
    require __DIR__ . '/api/v1/guest.php';
});
