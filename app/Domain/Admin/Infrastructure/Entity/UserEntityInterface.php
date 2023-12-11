<?php

namespace App\Domain\Admin\Infrastructure\Entity;

use App\Domain\Admin\Entity\User;

interface UserEntityInterface
{
    public function create(User $user): User;
}
