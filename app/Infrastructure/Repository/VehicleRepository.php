<?php

namespace App\Infrastructure\Repository;

use App\Domain\Vehicle\Infrastructure\Repository\VehicleRepositoryInterface;
use App\Models\Vehicle as ModelVehicle;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function __construct(
        private ModelVehicle $db
    ) {
    }
}
