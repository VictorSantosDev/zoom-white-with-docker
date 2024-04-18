<?php

namespace App\Domain\ServiceHasVehicle\Entity;

use App\Domain\Admin\ValueObjects\Id;

class ServiceHasVehicle
{
    public function __construct(
        private ?Id $id,
        private ?Id $serviceId,
        private ?Id $vehicleId,
        private ?string $createdAt,
        private ?string $updatedAt,
        private ?string $deletedAt
    ) {
    }


    public function getId(): ?Id
    {
        return $this->id;
    }

    public function getServiceId(): ?Id
    {
        return $this->serviceId;
    }

    public function getVehicleId(): ?Id
    {
        return $this->vehicleId;
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
            'serviceId' => $this->getServiceId()?->get(),
            'vehicleId' => $this->getVehicleId()?->get(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt()
        ];
    }
}
