<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class ApiResponseHandler {
    public function handle(Request $request, Closure $next): Response {
        if ($request->is('api/*')) {
            $request->headers->set('Accept', 'application/json');
        }

        $response = $next($request);

        if ($request->is('api/*') && $response instanceof JsonResponse) {
            $data = $response->getData(true);
            $data = array_merge(['success' => true], $data);
            $response->setData($data);
        }

        return $response;
    }
}
