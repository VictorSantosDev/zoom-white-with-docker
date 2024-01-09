<?php

namespace App\Domain\WashingVehicleHasWashing\Infrastructure\Repository;

interface WashingVehicleHasWashingRepositoryInterface
{
    public function getAllByWashingVehicleId(int $washingVehicleId): array;
}
