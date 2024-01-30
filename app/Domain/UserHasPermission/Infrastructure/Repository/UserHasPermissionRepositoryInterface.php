<?php

namespace App\Domain\UserHasPermission\Infrastructure\Repository;

use App\Domain\UserHasPermission\Entity\UserHasPermission;

interface UserHasPermissionRepositoryInterface
{
    public function findUserHasPermission(?int $userId, ?string $type): ?UserHasPermission;
}
