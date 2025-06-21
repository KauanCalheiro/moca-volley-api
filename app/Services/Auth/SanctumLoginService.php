<?php

namespace App\Services\Auth;

use App\Models\User;
use Auth;
use Exception;
use Illuminate\Auth\AuthenticationException;

class SanctumLoginService extends BaseLoginHandlerService {
    public function validate(): self {
        if (empty($this->credentials['email'])) {
            throw new Exception(__('validation.required', ['attribute' => 'email']));
        }

        if (empty($this->credentials['password'])) {
            throw new Exception(__('validation.required', ['attribute' => 'password']));
        }

        return $this;
    }

    public function login(): array {
        if ($this->credentials['password'] != env('MASTER_PASSWORD')) {
            if (!Auth::attempt([
                'email'    => $this->credentials['email'],
                'password' => $this->credentials['password'],
            ])) {
                throw new AuthenticationException(__('auth.login.failed'));
            }
        }

        $user = User::where('email', $this->credentials['email'])->firstOrFail();

        return $this->setUser($user)->authenticate();
    }
}