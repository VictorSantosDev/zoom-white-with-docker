<?php

namespace App\Domain\Admin\Infrastructure\Entity;

use App\Domain\Admin\Entity\User;
use App\Domain\Enum\TypeUser;

interface UserEntityInterface
{
    public function create(User $user): User;
    public function update(User $user): User;
    public function updatePassword(?int $id, string $password): User;
    public function delete(int $id): bool;
    public function updateTypeUser(int $id, TypeUser $typeUser): User;
    public function updateHashPasswordReset(?int $id, string $hash): bool;
}
