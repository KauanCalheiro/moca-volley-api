<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase {
    use RefreshDatabase;

    public function test_user_can_authenticate(): void {
        $user = User::create([
            'email'    => 'teste@example.com',
            'name'     => 'Test User',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post(route('auth.login'), [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $response->assertJsonStructure(['token']);
        $response->assertJson(['success' => true]);
    }

    public function test_users_can_not_authenticate_with_invalid_password(): void {
        $user = User::factory()->create();

        $response = $this->post(route('auth.login'), [
            'email'    => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false,
                'error'   => __('auth.login.failed'),
            ]);
    }

    public function test_users_can_logout(): void {
        $user = User::create([
            'email'    => 'teste@example.com',
            'name'     => 'Test User',
            'password' => bcrypt('password'),
        ]);

        $token = $this->post(route('auth.login'), [
            'email'    => $user->email,
            'password' => 'password',
        ])->json('token');

        $response = $this->post(route('auth.logout'), [], [
            'Authorization' => "Bearer $token",
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'message' => __('auth.logout.success'),
            ]);
    }
}
