<?php

namespace App\Domain\Admin\Infrastructure\Entity;

use App\Domain\Admin\Entity\User;

interface UserEntityInterface
{
    public function create(User $user): User;
    public function update(User $user): User;
    public function delete(int $id): bool;
}
