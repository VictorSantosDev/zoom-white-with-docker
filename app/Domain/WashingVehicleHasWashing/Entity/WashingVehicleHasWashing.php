<?php

namespace App\Domain\WashingVehicleHasWashing\Entity;

use App\Domain\Admin\ValueObjects\Id;

class WashingVehicleHasWashing
{
    public function __construct(
        private ?Id $id,
        private Id $washingVehicleId,
        private Id $washingId,
        private ?string $createdAt,
        private ?string $updatedAt,
        private ?string $deletedAt
    ) {
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getWashingVehicleId(): Id
    {
        return $this->washingVehicleId;
    }

    public function getWashingId(): Id
    {
        return $this->washingId;
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
            'washingVehicleId' => $this->getWashingVehicleId()?->get(),
            'washingId' => $this->getWashingId()?->get(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
