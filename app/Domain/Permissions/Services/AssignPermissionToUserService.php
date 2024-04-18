<?php

declare(strict_types=1);

namespace App\Domain\Permissions\Services;

use App\Domain\Admin\Services\AdminUserService;
use App\Domain\Enum\TypeUser;
use App\Domain\UserHasPermission\Entity\UserHasPermission;
use App\Domain\UserHasPermission\Services\UserHasPermissionService;
use App\Utils\Permissions\CheckPermission;
use App\Utils\Permissions\CollectionPermissionsForUser;
use Exception;
use Illuminate\Console\OutputStyle;
use Illuminate\Support\Collection;

class AssignPermissionToUserService
{
    public function __construct(
        private PermissionsService $permissionsService,
        private UserHasPermissionService $userHasPermissionService,
        private AdminUserService $adminUserService
    ) {
    }

    public function setPermissionForUser(
        string $email,
        string $typeUser,
        OutputStyle $output
    ): void {
        $user = $this->adminUserService->findUserByEmail($email);
        $typeUser = $this->validateTypeUser($typeUser);

        match ($typeUser->value) {
            TypeUser::ADMIN->value => $this->create($user->getId()->get(), CollectionPermissionsForUser::ADMIN(), $output),
            TypeUser::USER->value => $this->create($user->getId()->get(), CollectionPermissionsForUser::USER(), $output),
            TypeUser::EMPLOYEE->value => $this->create($user->getId()->get(), CollectionPermissionsForUser::EMPLOYEE(), $output),
            default => ''
        };
    }

    private function create(int $userId, Collection $collectionPermissions, OutputStyle $output): void
    {
        $progress = $output->createProgressBar(count($collectionPermissions->toArray()));
        $progress->start();

        foreach ($collectionPermissions->toArray() as $typePermission) {
            if ($this->checkUserHasPermission($userId, $typePermission)) {
                $progress->advance();
                continue;
            }

            $permission = $this->permissionsService->findPermissionByType($typePermission);

            $this->userHasPermissionService->create($userId, $permission->getId()->get());

            $progress->advance();
        }

        $progress->finish();
    }

    private function checkUserHasPermission(int $userId, string $type): bool
    {
        return $this->userHasPermissionService->findUserHasPermission($userId, $type) instanceof UserHasPermission;
    }

    private function validateTypeUser(string $typeUser): TypeUser
    {

        if (!(TypeUser::tryFrom(strtoupper($typeUser)) instanceof TypeUser)) {
            throw new Exception('O tipo de usuário só pode ser ' . implode(', ', TypeUser::allTypeUser()));
        }
        return TypeUser::tryFrom($typeUser);
    }
}
