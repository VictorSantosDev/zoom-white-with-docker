<?php

namespace App\Domain\WashingVehicleHasWashing\Infrastructure\Entity;

use App\Domain\WashingVehicleHasWashing\Entity\WashingVehicleHasWashing;

interface WashingVehicleHasWashingEntityInterface
{
    public function create(WashingVehicleHasWashing $washingVehicleHasWashing): WashingVehicleHasWashing;
}
