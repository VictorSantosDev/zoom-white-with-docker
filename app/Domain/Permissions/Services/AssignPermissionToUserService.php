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
        OutputStyle $output = null
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

    private function create(int $userId, Collection $collectionPermissions, ?OutputStyle $output): void
    {
        if ($output) {
            $progress = $output->createProgressBar(count($collectionPermissions->toArray()));
            $progress->start();
        }

        $this->userHasPermissionService->deleteAll($userId);

        foreach ($collectionPermissions->toArray() as $typePermission) {
            if ($this->checkUserHasPermission($userId, $typePermission)) {
                if ($output) {
                    $progress->advance();
                    continue;
                }
            }

            $permission = $this->permissionsService->findPermissionByType($typePermission);

            if (!$permission) {
                throw new Exception("Permissão '$typePermission' não encontrada, registre essa permissão em 'permissions'");
            }

            $this->userHasPermissionService->create($userId, $permission->getId()->get());

            if ($output) {
                $progress->advance();
            }
        }

        if ($output) {
            $progress->finish();
        }
    }

    private function checkUserHasPermission(int $userId, string $type): bool
    {
        return $this->userHasPermissionService->findUserHasPermission($userId, $type) instanceof UserHasPermission;
    }

    private function validateTypeUser(string $typeUser): TypeUser
    {

        if (!(TypeUser::tryFromByName(strtoupper($typeUser)) instanceof TypeUser)) {
            throw new Exception('O tipo de usuário só pode ser ' . implode(', ', TypeUser::getEnum()));
        }
        return TypeUser::tryFromByName($typeUser);
    }
}
