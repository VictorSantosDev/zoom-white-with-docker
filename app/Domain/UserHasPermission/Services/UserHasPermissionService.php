<?php

namespace App\Domain\UserHasPermission\Services;

use App\Domain\UserHasPermission\Entity\UserHasPermission;
use App\Domain\UserHasPermission\Infrastructure\Entity\UserHasPermissionEntityInterface;
use App\Domain\UserHasPermission\Infrastructure\Repository\UserHasPermissionRepositoryInterface;

class UserHasPermissionService
{
    public function __construct(
        private UserHasPermissionEntityInterface $userHasPermissionEntityInterface,
        private UserHasPermissionRepositoryInterface $userHasPermissionRepositoryInterface
    ) {
    }

    public function create(
        int $userId,
        int $permissionId
    ): UserHasPermission {
        return $this->userHasPermissionEntityInterface->create($userId, $permissionId);
    }

    public function findUserHasPermission(?int $userId, ?string $type): ?UserHasPermission
    {
        return $this->userHasPermissionRepositoryInterface->findUserHasPermission($userId, $type);
    }
}
