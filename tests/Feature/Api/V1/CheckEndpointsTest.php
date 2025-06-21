<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;

class CheckEndpointsTest extends TestCase
{
    public function test_health_check()
    {
        $response = $this->get(route('check.health'));

        $response->assertOk()
                 ->assertJson(['status' => 'ok']);
    }

    public function test_version_check()
    {
        $response = $this->get(route('check.version'));

        $response->assertOk()
                 ->assertJson(['version' => '1.0.0']);
    }
}
