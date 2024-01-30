<?php

namespace App\Domain\UserHasPermission\Services;

use App\Domain\UserHasPermission\Entity\UserHasPermission;
use App\Domain\UserHasPermission\Infrastructure\Repository\UserHasPermissionRepositoryInterface;

class UserHasPermissionService
{
    public function __construct(
        private UserHasPermissionRepositoryInterface $userHasPermissionRepositoryInterface
    ) {
    }

    public function findUserHasPermission(?int $userId, ?string $type): ?UserHasPermission
    {
        return $this->userHasPermissionRepositoryInterface->findUserHasPermission($userId, $type);
    }
}
