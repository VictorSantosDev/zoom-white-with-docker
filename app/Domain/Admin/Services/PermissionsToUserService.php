<?php

namespace App\Domain\Admin\Services;

use App\Domain\Enum\TypeUser;
use App\Domain\Permissions\Services\AssignPermissionToUserService;

class PermissionsToUserService
{
    public function setPermission(string $email, TypeUser $typeUser)
    {
        /** @var AssignPermissionToUserService $assignPermissionToUserService */
        $assignPermissionToUserService = resolve(AssignPermissionToUserService::class); 

        $assignPermissionToUserService->setPermissionForUser(
            $email,
            $typeUser->value
        );
    }
}
