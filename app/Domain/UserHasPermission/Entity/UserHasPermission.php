<?php

namespace App\Domain\UserHasPermission\Entity;

use App\Domain\Admin\ValueObjects\Id;

class UserHasPermission
{
    public function __construct(
        private ?Id $id,
        private ?Id $userId,
        private ?Id $permissionId,
        private ?string $createdAt,
        private ?string $updatedAt,
        private ?string $deletedAt
    ) {
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function getUserId(): ?Id
    {
        return $this->userId;
    }

    public function getPermissionId(): ?Id
    {
        return $this->permissionId;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId()?->get(),
            'userId' => $this->getUserId()?->get(),
            'permissionId' => $this->getPermissionId()?->get(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt()
        ];
    }
}
