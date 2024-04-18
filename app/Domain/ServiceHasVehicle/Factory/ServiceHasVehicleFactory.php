<?php

namespace App\Domain\ServiceHasVehicle\Factory;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\ServiceHasVehicle\Entity\ServiceHasVehicle;

class ServiceHasVehicleFactory
{
    static function create(
        ?int $serviceId,
        ?int $vehicleId
    ): ServiceHasVehicle {
        return new ServiceHasVehicle(
            id: null,
            serviceId: new Id($serviceId),
            vehicleId: new Id($vehicleId),
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null
        );
    }
}
