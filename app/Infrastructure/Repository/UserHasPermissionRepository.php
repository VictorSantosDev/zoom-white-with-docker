<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\UserHasPermission\Infrastructure\Repository\UserHasPermissionRepositoryInterface;
use App\Domain\UserHasPermission\Entity\UserHasPermission;
use App\Models\UserHasPermission as ModelUserHasPermission;

class UserHasPermissionRepository implements UserHasPermissionRepositoryInterface
{
    public function __construct(
        private ModelUserHasPermission $db
    ) {
    }

    public function findUserHasPermission(?int $userId, ?string $type): ?UserHasPermission
    {
        $row = $this->db::where('user_id', $userId)
            ->join('permissions', 'user_has_permission.permission_id', '=', 'permissions.id')
            ->where('permissions.type', $type)
            ->first();

        if (!$row) {
            return null;
        }

        return new UserHasPermission(
            id: new Id($row->id),
            userId: new Id($row->user_id),
            permissionId: new Id($row->permission_id),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
