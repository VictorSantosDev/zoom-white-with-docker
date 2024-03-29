<?php

namespace App\Domain\ServiceHasVehicle\Infrastructure\Repository;

interface ServiceHasVehicleRepositoryInterface
{
    public function getAllByVehicleId(int $vehicleId): array;
}
