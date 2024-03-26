<?php

namespace App\Domain\WashingVehicle\Factory;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\WashingVehicle\Entity\WashingVehicle;

class WashingVehicleFactory
{
    static public function createWashingVehicle(
        int $establishmentId,
        int $employeeId,
        string $plate,
        string $model,
        string $color,
        int $price
    ): WashingVehicle {
        return new WashingVehicle(
            id: null,
            establishmentId: new Id($establishmentId),
            employeeId: new Id($employeeId),
            plate: $plate,
            model: $model,
            color: $color,
            price: $price,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null,
        );
    }
}
