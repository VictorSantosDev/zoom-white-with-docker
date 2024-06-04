<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\UserHasPermission\Entity\UserHasPermission;
use App\Domain\UserHasPermission\Infrastructure\Entity\UserHasPermissionEntityInterface;
use App\Models\UserHasPermission as UserHasPermissionModel;

class UserHasPermissionEntity implements UserHasPermissionEntityInterface
{
    public function __construct(
        private UserHasPermissionModel $db
    ) {
    }

    public function create(int $userId, int $permissionId): UserHasPermission
    {
        $row = $this->db::create([
            'user_id' => $userId,
            'permission_id' => $permissionId,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return new UserHasPermission(
            id: new Id($row->id),
            userId: new Id($row->user_id),
            permissionId: new Id($row->permission_id),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function deleteAllTryFrom(int $userId): bool
    {
        $delete = $this->db::where('user_id', $userId)->delete();

        if ($delete === 0) {
            return false;
        }

        return true;
    }
}
