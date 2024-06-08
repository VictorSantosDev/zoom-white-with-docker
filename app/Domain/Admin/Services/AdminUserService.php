<?php

namespace App\Domain\Admin\Services;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\Infrastructure\Entity\UserEntityInterface;
use App\Domain\Admin\Infrastructure\Repository\UserRepositoryInterface;
use App\Domain\Enum\TypeUser;
use Exception;

class AdminUserService
{
    public function __construct(
        private UserEntityInterface $userEntityInterface,
        private UserRepositoryInterface $userRepositoryInterface,
        private AdminSendingEmailService $adminSendingEmailService,
        private PermissionsToUserService $permissionsToUserService
    ) {
    }

    public function create(User $user): User
    {
        $this->existUser($user);
        $userCreated = $this->userEntityInterface->create($user);
        $this->permissionsToUserService->setPermission($userCreated->getEmail(), $userCreated->getTypeUser());
        $this->adminSendingEmailService->sendEmailUserCreated($user);
        return $userCreated;
    }

    public function update(User $user): User
    {
        $this->existUserForUpdate($user);
        $userCurrent = $this->userRepositoryInterface->getByIdTryFrom($user->getId()->get());
        $userUpdated = $this->userEntityInterface->update($user);

        $this->permissionsToUserService->setPermission($userUpdated->getEmail(), $userUpdated->getTypeUser());
        if ($userUpdated->getEmail() !== $userCurrent->getEmail()) {
            $userUpdated = $this->userEntityInterface->updatePassword(
                $userUpdated->getId()?->get(),
                $user->getPassword()
            );
            $this->adminSendingEmailService->sendEmailUserCreated($userUpdated);
        }

        return $userUpdated;
    }

    public function list(
        ?string $name,
        ?string $email,
        ?string $phone,
        ?string $cpf,
        ?string $active
    ): array {
        return $this->userRepositoryInterface->listWithFilter(
            name: $name,
            email: $email,
            phone: $phone,
            cpf: $cpf,
            active: $active
        );
    }

    public function show(?int $id): User
    {
        return $this->userRepositoryInterface->getByIdTryFrom($id);
    }

    public function findUserByEmail(string $email): User
    {
        return $this->userRepositoryInterface->findByEmailTryFrom($email);
    }

    public function findUserByHash(string $hash): User
    {
        return $this->userRepositoryInterface->findUserByHash($hash);
    }

    public function delete(?int $id): bool
    {
        return $this->userEntityInterface->delete($id);
    }

    public function findUserById(?int $id): User
    {
        return $this->userRepositoryInterface->getByIdTryFrom($id);
    }

    public function updateTypeUser(?int $id, TypeUser $typeUser): User
    {
        return $this->userEntityInterface->updateTypeUser($id, $typeUser);
    }

    public function updateHashPasswordReset(int $id, string $hash): bool
    {
        return $this->userEntityInterface->updateHashPasswordReset($id, $hash);
    }

    public function updatePassword(?int $id, string $password): User
    {
        return $this->userEntityInterface->updatePassword($id, $password);
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

    private function existUserForUpdate(User $user): void
    {
        $this->userRepositoryInterface->cpfOrEmailOrPhoneExistDuplicate(
            $user->getId()->get(),
            $user->getCpf(),
            $user->getEmail(),
            $user->getPhone(),
        );
    }
}
