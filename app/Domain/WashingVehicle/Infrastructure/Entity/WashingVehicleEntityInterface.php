<?php

namespace App\Domain\WashingVehicle\Infrastructure\Entity;

use App\Domain\WashingVehicle\Entity\WashingVehicle;

interface WashingVehicleEntityInterface
{
    public function create(WashingVehicle $washingVehicle): WashingVehicle;
}
