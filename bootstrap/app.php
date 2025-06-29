<?php

use App\Exceptions\ApiExceptionHandler;
use App\Exceptions\TelescopeUnauthenticatedHandler;
use App\Http\Middleware\ApiResponseHandler;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->api([
            ApiResponseHandler::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $throwable) {
            return match (true) {
                request()->is('api/*') => (new ApiExceptionHandler(app()))->render(request(), $throwable),

                request()->is('telescope', 'telescope/*') => (new TelescopeUnauthenticatedHandler())->handler(request(), $throwable),

                default => null,
            };
        });
    })
    ->create();
