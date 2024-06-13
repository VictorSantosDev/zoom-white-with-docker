<?php

namespace Tests\Feature\Admin\AdminServices;

use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Feature\Admin\Authenticator;
use Tests\TestCase;

class AdminUserServiceTest extends TestCase
{
    use Authenticator;

    #[DataProvider('createUserWithSuccess')]
    public function testCreateUser(array $data): void
    {
        $response = $this->post('/api/v1/admin/user/create', $data);

        $response->assertSuccessful();
        $this->assertEquals($response->json('data')['typeUser'] ?? null, $data['typeUser']);
    }

    public static function createUserWithSuccess(): array
    {
        return [
            'shouldCreateUserWithTypeUserUser' => [
                'data' => [
                    'name' => 'Teste User',
                    'email' => 'teste_user@test.com',
                    'phone' => '11945448789',
                    'cpf' => '66540465017',
                    'birthDate' => '1999-08-19',
                    'typeUser' => 'USER',
                ],
            ]
        ];
    }
}
