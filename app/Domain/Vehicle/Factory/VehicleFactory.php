<?php

namespace App\Domain\Vehicle\Factory;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Vehicle\Entity\Vehicle;

class VehicleFactory
{
    static function create(
        Vehicle $vehicle,
        int $price,
        int $userId
    ): Vehicle {
        return new Vehicle(
            id: $vehicle->getId(),
            establishmentId: $vehicle->getEstablishmentId(),
            userId: new Id($userId),
            companyId: $vehicle->getCompanyId(),
            plate: $vehicle->getPlate(),
            model: $vehicle->getModel(),
            color: $vehicle->getColor(),
            price: $price,
            createdAt: $vehicle->getCreatedAt(),
            updatedAt: $vehicle->getUpdatedAt(),
            deletedAt: $vehicle->getDeletedAt()
        );
    }
}
