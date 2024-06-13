<?php

namespace Tests\Feature\Admin\AdminServices;

use Database\Seeders\Admin\AdminSeeder;
use Database\Seeders\Permissions\PermissionsSeeder;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->seed([
            AdminSeeder::class,
            PermissionsSeeder::class,
        ]);
    }

    public function testShouldAuthAdminSuccess(): void
    {

        $response = $this->postJson('/api/v1/admin/auth/login', [
            'email' => 'example@example.com',
            'password' => 'password',
        ]);

        $jwtTTL = env('JWT_TTL', null);

        $response->assertSuccessful();
        $response->assertJson($response->json());
        $response->assertExactJson([
            'data' => $response->json('data')
        ]);

        $this->assertIsString($response->json('data')['access_token'] ?? null);
        $this->assertEquals('bearer', $response->json('data')['token_type'] ?? null);
        $this->assertEquals($jwtTTL * $jwtTTL, $response->json('data')['expires_in'] ?? 0);
    }

    #[DataProvider('invalidAuth')]
    public function testInvalidAuthAdmin(array $data, array $expectedResultJson): void
    {
        $response = $this->postJson('/api/v1/admin/auth/login', $data);
        $response->assertExactJson($expectedResultJson);
    }

    public static function invalidAuth(): array
    {
        return [
            'shouldNotBeAuthenticatedIfEmailIsEmpty' => [
                'data' => [
                    'email' => '',
                    'password' => 'password'
                ],
                'expectedResultJson' => [
                    "message" => "O campo é obrigatório.",
                        "errors" => [
                            "email" => [
                                "O campo é obrigatório.",
                            ]
                    ]
                ],
            ],
            'shouldNotBeAuthenticatedIfPasswordIsEmpty' => [
                'data' => [
                    'email' => 'test@test.com',
                    'password' => ''
                ],
                'expectedResultJson' => [
                    "message" => "O campo é obrigatório.",
                        "errors" => [
                            "password" => [
                                "O campo é obrigatório.",
                            ]
                    ]
                ],
            ],
            'shouldNotBeAuthenticatedIfEmailAndPasswordIsEmpty' => [
                'data' => [
                    'email' => '',
                    'password' => ''
                ],
                'expectedResultJson' => [
                    "message" => "O campo é obrigatório. (and 1 more error)",
                        "errors" => [
                            "email" => [
                                "O campo é obrigatório.",
                            ],
                            "password" => [
                                "O campo é obrigatório.",
                            ]
                    ]
                ],
            ],
            'shouldNotBeAuthenticatedIfEmailNotExist' => [
                'data' => [
                    'email' => 'test@test.com.br',
                    'password' => 'password'
                ],
                'expectedResultJson' => [
                    "error" => "Não autorizado"
                ],
            ],
            'shouldNotBeAuthenticatedIfPasswordIsInvalid' => [
                'data' => [
                    'email' => 'example@example.com',
                    'password' => 'Test@12345'
                ],
                'expectedResultJson' => [
                    "error" => "Não autorizado"
                ],
            ]
        ];
    }
}
