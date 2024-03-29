<?php

namespace App\Domain\WashingVehicle\Infrastructure\Entity;

use App\Domain\WashingVehicle\Entity\WashingVehicle;

interface WashingVehicleEntityInterface
{
    public function create(WashingVehicle $washingVehicle): WashingVehicle;
    public function update(int $washingVehicleId, WashingVehicle $washingVehicle): WashingVehicle;
    public function delete(int $washingVehicleId): bool;
}
