<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', fn() => ['status' => 'ok']);
Route::get('/version', fn() => ['version' => '1.0.0']);