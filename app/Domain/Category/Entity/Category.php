<?php

namespace App\Domain\Category\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use JsonSerializable;

class Category implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private Id $establishmentId,
        private string $name,
        private int $numberIcon,
        private Active $active,
        private ?string $createdAt,
        private ?string $updatedAt,
        private ?string $deletedAt
    ) {
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function getEstablishmentId(): Id
    {
        return $this->establishmentId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNumberIcon(): int
    {
        return $this->numberIcon;
    }

    public function getActive(): Active
    {
        return $this->active;
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId()?->get(),
            'establishmentId' => $this->getEstablishmentId()?->get(),
            'name' => $this->getName(),
            'numberIcon' => $this->getNumberIcon(),
            'active' => $this->getActive()->value,
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
