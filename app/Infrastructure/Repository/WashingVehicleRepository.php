<?php

namespace App\Infrastructure\Repository;

use App\Domain\WashingVehicle\Entity\WashingVehicle;
use App\Domain\WashingVehicle\Infrastructure\Repository\WashingVehicleRepositoryInterface;
use App\Models\WashingVehicle as ModelsWashingVehicle;

class WashingVehicleRepository implements WashingVehicleRepositoryInterface
{
    public function __construct(
        private ModelsWashingVehicle $db
    ) {
    }

    public function getByTryFrom(): WashingVehicle
    {
        dd('ook');
    }
}
