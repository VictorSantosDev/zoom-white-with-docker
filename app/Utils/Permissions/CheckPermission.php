<?php

namespace App\Utils\Permissions;

use App\Domain\UserHasPermission\Entity\UserHasPermission;
use App\Domain\UserHasPermission\Services\UserHasPermissionService;

class CheckPermission
{
    static function checkPermission(string $type): bool
    {
        $user = auth('users')->user();

        /** @var UserHasPermissionService $userHasPermissionService */
        $userHasPermissionService = resolve(UserHasPermissionService::class);

        return $userHasPermissionService->findUserHasPermission($user->id, $type) instanceof UserHasPermission;
    }
}
