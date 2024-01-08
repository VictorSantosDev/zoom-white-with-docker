<?php

namespace App\Infrastructure\Repository;

use App\Domain\WashingVehicleHasWashing\Infrastructure\Repository\WashingVehicleHasWashingRepositoryInterface;
use App\Models\WashingVehicleHasWashing as ModelsWashingVehicleHasWashing;

class WashingVehicleHasWashingRepository implements WashingVehicleHasWashingRepositoryInterface
{
    public function __construct(
        private ModelsWashingVehicleHasWashing $db
    ) {
    }
}
