<?php

namespace App\Http\Requests\Auth;

use App\Services\AuthService;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest {
    public function authorize(): bool {
        return true;
    }

    public function prepareForValidation(): void {
        $this->merge([
            'driver' => $this->input('driver', 'sanctum'),
        ]);
    }

    public function rules(): array {
        $driver = $this->input('driver', 'sanctum');

        return $driver == 'google'
            ? $this->googleRules()
            : $this->sanctumRules();
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate() {
        $this->ensureIsNotRateLimited();

        $token = AuthService::make($this->validated())->handleLogin();

        RateLimiter::clear($this->throttleKey());

        return $token;
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }

    private function googleRules() {
        return [
            'token'  => ['required', 'string'],
            'driver' => ['in:sanctum,google'],
        ];
    }

    private function sanctumRules() {
        return [
            'email'       => ['required', 'string'],
            'password'    => ['required', 'string'],
            'remember_me' => ['boolean'],
            'driver'      => ['in:sanctum,google'],
        ];
    }
}
