<?php

namespace App\Domain\Vehicle\Factory;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Vehicle\Entity\Vehicle;

class VehicleFactory
{
    static function create(
        Vehicle $vehicle,
        int $price,
        int $employeeId
    ): Vehicle {
        return new Vehicle(
            id: $vehicle->getId(),
            establishmentId: $vehicle->getEstablishmentId(),
            employeeId: new Id($employeeId),
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
