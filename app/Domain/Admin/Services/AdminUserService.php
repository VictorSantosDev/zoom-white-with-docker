<?php

namespace App\Domain\Admin\Services;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\Infrastructure\Entity\UserEntityInterface;
use App\Domain\Admin\Infrastructure\Repository\UserRepositoryInterface;
use Exception;

class AdminUserService
{
    public function __construct(
        private UserEntityInterface $userEntityInterface,
        private UserRepositoryInterface $userRepositoryInterface,
        private AdminSendingEmail $adminSendingEmail
    ) {
    }

    public function create(User $user): User
    {
        $this->existUser($user);
        $userCreated = $this->userEntityInterface->create($user);
        $this->adminSendingEmail->sendEmailUserCreated($user);
        return $userCreated;
    }

    private function existUser(User $user): void
    {
        $existCpf = $this->userRepositoryInterface->cpfExist($user->getCpf());
        $existEmail = $this->userRepositoryInterface->emailExist($user->getEmail());
        $existPhone = $this->userRepositoryInterface->phoneExist($user->getPhone());

        if ($existCpf instanceof User) {
            throw new Exception('Já existe um usuário cadastrado com esse CPF');
        }

        if ($existEmail instanceof User) {
            throw new Exception('Já existe um usuário cadastrado com esse e-mail');
        }

        if ($existPhone instanceof User) {
            throw new Exception('Já existe um usuário cadastrado com esse número de telefone');
        }
    }
}
