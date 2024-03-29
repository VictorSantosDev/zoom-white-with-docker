<?php

namespace App\Domain\Permissions\Infrastructure\Repository;

use App\Domain\Permissions\Entity\Permissions;

interface PermissionsRepositoryInterface
{
    public function findByType(string $type): ?Permissions;
}
