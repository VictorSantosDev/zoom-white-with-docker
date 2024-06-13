<?php

namespace Tests\Feature\Admin;

use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Permissions\PermissionsSeeder;

trait Authenticator
{
    public $token = '';

    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            AdminSeeder::class,
            PermissionsSeeder::class,
        ]);

        $response = $this->postJson('/api/v1/admin/auth/login', [
            'email' => 'example@example.com',
            'password' => 'password',
        ]);

        $accessToken = $response->json('data')['access_token'] ?? null;

        $this->token = $accessToken;
    }
}
