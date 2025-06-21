<?php

use Illuminate\Support\Facades\Route;

Route::get('/health', fn () => ['status' => 'ok'])->name('check.health');
Route::get('/version', fn () => ['version' => '1.0.0'])->name('check.version');
