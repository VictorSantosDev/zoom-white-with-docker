<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Permissions\Entity\Permissions;
use App\Domain\Permissions\Infrastructure\Repository\PermissionsRepositoryInterface;
use App\Models\Permissions as PermissionsModel;

class PermissionsRepository implements PermissionsRepositoryInterface
{
    public function __construct(
        private PermissionsModel $db
    ) {
    }

    public function findByType(string $type): ?Permissions
    {
        $row = $this->db::where('type', $type)->first();

        if (!$row) {
            return null;
        }

        return new Permissions(
            id: new Id($row->id),
            type: $row->type,
            description: $row->description,
            active: Active::tryFrom($row->active),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s')
        );
    }
}
