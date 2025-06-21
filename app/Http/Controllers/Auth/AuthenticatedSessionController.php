<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class AuthenticatedSessionController extends Controller {
    public function login(LoginRequest $request) {
        return $request->authenticate();
    }

    public function logout(Request $request) {
        $request->user()->tokens()->delete();
        return ['message' => __('auth.logout.success')];
    }

    public function user(Request $request) {
        $user = $request->user();

        return [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email,
        ];
    }
}
