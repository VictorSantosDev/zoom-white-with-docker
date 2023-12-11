<?php

namespace App\Domain\Admin\Infrastructure\Repository;

use App\Domain\Admin\Entity\User;

interface UserRepositoryInterface
{
    public function cpfExist(?string $cpf): ?User;
    public function emailExist(?string $email): ?User;
    public function phoneExist(?string $phone): ?User;
}
