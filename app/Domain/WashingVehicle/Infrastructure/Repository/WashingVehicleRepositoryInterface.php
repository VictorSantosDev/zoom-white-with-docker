<?php

namespace App\Domain\WashingVehicle\Infrastructure\Repository;

use App\Domain\WashingVehicle\Entity\WashingVehicle;

interface WashingVehicleRepositoryInterface
{
    public function getByIdTryFrom(int $washingVehicleId): WashingVehicle;
}
