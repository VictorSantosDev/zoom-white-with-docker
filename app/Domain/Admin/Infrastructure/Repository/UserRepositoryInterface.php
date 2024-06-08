<?php

namespace App\Domain\Admin\Infrastructure\Repository;

use App\Domain\Admin\Entity\User;

interface UserRepositoryInterface
{
    public function cpfExist(?string $cpf): ?User;
    public function emailExist(?string $email): ?User;
    public function phoneExist(?string $phone): ?User;
    public function listWithFilter(
        ?string $name,
        ?string $email,
        ?string $phone,
        ?string $cpf,
        ?string $active,
    ): array;
    public function getByIdTryFrom(?int $id): User;
    public function cpfOrEmailOrPhoneExistDuplicate(
        ?int $id,
        ?string $cpf,
        ?string $email,
        ?string $phone
    ): void;
    public function findByEmailTryFrom(string $email): User;
    public function findUserByHash(string $hash): User;
}
