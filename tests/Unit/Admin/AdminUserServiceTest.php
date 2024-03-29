<?php

namespace Tests\Unit\Admin;

use PHPUnit\Framework\TestCase;
use App\Domain\Admin\Entity\User;
use App\Domain\Admin\Services\AdminSendingEmailService;
use App\Domain\Admin\Services\AdminUserService;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Infrastructure\Entity\UserEntity;
use App\Infrastructure\Repository\UserRepository;
use Exception;
use PHPUnit\Framework\Attributes\DataProvider;

class AdminUserServiceTest extends TestCase
{
    public function testShouldCreateUserWithSuccess(): void
    {
        $id = 1;
        $user = $this->userEntity();
        $userEntity = $this->createMock(UserEntity::class);
        $userEntity->method('create')->willReturn($this->userEntity(id: new Id($id)));

        $adminUserService = new AdminUserService(
            $userEntity,
            $this->createMock(UserRepository::class),
            $this->createMock(AdminSendingEmailService::class)
        );

        $output = $adminUserService->create($user);

        $this->assertEquals($id, $output->getId()->get());
        $this->assertEquals('Name Test', $output->getName());
        $this->assertEquals('test@example.com', $output->getEmail());
        $this->assertEquals('11900000000', $output->getPhone());
        $this->assertEquals(Active::ACTIVE, $output->getActive());
        $this->assertEquals('49199169061', $output->getCpf());
        $this->assertEquals('1999-01-01', $output->getBirthDate());
        $this->assertEquals('Teste@12345', $output->getPassword());
    }

    #[DataProvider('testInvalidUserDataProvider')]
    public function testInvalidUser(User $userData, string $expectedResult)
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage($expectedResult);

        $userRepository = $this->createMock(UserRepository::class);
        $userRepository->method('cpfExist')->willReturn($userData);

        $adminUserService = new AdminUserService(
            $this->createMock(UserEntity::class),
            $userRepository,
            $this->createMock(AdminSendingEmailService::class)
        );

        $adminUserService->create($userData);
    }

    public static function testInvalidUserDataProvider(): array
    {
        return [
            'shouldNotCreateUserIfCpfExistWithOtherUser' => [
                'userData' => new User(
                    id: null,
                    name: 'Name Test',
                    email: 'test@example.com',
                    phone: '11900000000',
                    active: Active::ACTIVE,
                    cpf: '49199169061',
                    birthDate: '1999-01-01',
                    password: 'Teste@12345',
                    emailVerifiedAt: null,
                    createdAt: now(),
                    updatedAt: now(),
                    deletedAt: null
                ),
                'expectedResult' => 'Já existe um usuário cadastrado com esse CPF'
            ]
        ];
    }

    private function userEntity(
        ?Id $id = null,
        string $name = 'Name Test',
        string $email = 'test@example.com',
        string $phone = '11900000000',
        Active $active = Active::ACTIVE,
        string $cpf = '49199169061',
        string $birthDate = '1999-01-01',
        string $password = 'Teste@12345',
        string $emailVerifiedAt = null,
        string $createdAt = null,
        string $updatedAt = null,
        string $deletedAt = null
    ): User {
        return new User(
            id: $id,
            name: $name,
            email: $email,
            phone: $phone,
            active: $active,
            cpf: $cpf,
            birthDate: $birthDate,
            password: $password,
            emailVerifiedAt: $emailVerifiedAt,
            createdAt: $createdAt ?? now(),
            updatedAt: $updatedAt ?? now(),
            deletedAt: $deletedAt
        );
    }
}
