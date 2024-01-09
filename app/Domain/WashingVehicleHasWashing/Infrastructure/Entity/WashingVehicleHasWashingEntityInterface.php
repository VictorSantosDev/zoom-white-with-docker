<?php

namespace App\Domain\WashingVehicleHasWashing\Infrastructure\Entity;

use App\Domain\WashingVehicleHasWashing\Entity\WashingVehicleHasWashing;

interface WashingVehicleHasWashingEntityInterface
{
    public function create(WashingVehicleHasWashing $washingVehicleHasWashing): WashingVehicleHasWashing;
    public function deleteAllByWashingVehicleId(int $washingVehicleId): bool;
    public function deleteByWashingIds(array $washingIds): bool;
}
