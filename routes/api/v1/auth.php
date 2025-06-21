<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])
            ->name('auth.logout');

        Route::get('/user', [AuthenticatedSessionController::class, 'user'])
            ->name('auth.user');
    });

    Route::post('/login', [AuthenticatedSessionController::class, 'login'])
        ->name('auth.login');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('auth.register');

    // Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
    //     ->middleware(['auth', 'signed', 'throttle:6,1'])
    //     ->name('verification.verify');

    // Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    //     ->name('password.email');

    // Route::post('/reset-password', [NewPasswordController::class, 'store'])
    //     ->name('password.store');

    // Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    //     ->middleware(['auth', 'throttle:6,1'])
    //     ->name('verification.send');
});
