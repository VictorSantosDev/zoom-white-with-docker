<?php

namespace App\Domain\Permissions\Services;

use App\Domain\Permissions\Entity\Permissions;
use App\Domain\Permissions\Infrastructure\Repository\PermissionsRepositoryInterface;

class PermissionsService
{
    public function __construct(
        private PermissionsRepositoryInterface $permissionsRepositoryInterface
    ) {
    }

    public function findPermissionByType(string $type): ?Permissions
    {
        return $this->permissionsRepositoryInterface->findByType($type);
    }
}
