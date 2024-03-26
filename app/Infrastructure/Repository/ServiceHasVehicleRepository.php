<?php

namespace App\Infrastructure\Repository;

use App\Domain\ServiceHasVehicle\Infrastructure\Repository\ServiceHasVehicleRepositoryInterface;
use App\Models\ServiceHasVehicle as ModelServiceHasVehicle;

class ServiceHasVehicleRepository implements ServiceHasVehicleRepositoryInterface
{
    public function __construct(
        private ?ModelServiceHasVehicle $db
    ) {
    }

    public function getAllByVehicleId(int $vehicleId): array
    {
        $rows = $this->db::where('vehicle_id', $vehicleId)->get()->toArray();
        return $rows;
    }
}
