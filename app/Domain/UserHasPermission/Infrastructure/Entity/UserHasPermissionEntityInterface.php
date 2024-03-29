<?php

namespace App\Domain\UserHasPermission\Infrastructure\Entity;

use App\Domain\UserHasPermission\Entity\UserHasPermission;

interface UserHasPermissionEntityInterface
{
    public function create(int $userId, int $permissionId): UserHasPermission;
}
