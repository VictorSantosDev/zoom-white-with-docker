<?php

namespace App\Domain\Washing\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use JsonSerializable;

class Washing implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private Id $establishmentId,
        private string $name,
        private int $price,
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

    public function getPrice(): int
    {
        return $this->price;
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

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId()?->get(),
            'establishmentId' => $this->getEstablishmentId()?->get(),
            'name' => $this->getName(),
            'price' => $this->getPrice(),
            'active' => $this->getActive()->value,
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
