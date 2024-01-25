<?php

namespace App\Domain\Employee\Services;

use App\Domain\Vehicle\Entity\Vehicle;
use App\Domain\Vehicle\Services\VehicleService;

class EmployeeVehicleService
{
    public function __construct(
        private VehicleService $vehicleService
    ) {
    }

    public function create(Vehicle $vehicle, array $serviceIds): Vehicle
    {
        return $this->vehicleService->create($vehicle, $serviceIds);
    }

    public function update(Vehicle $vehicle, array $serviceIds): Vehicle
    {
        return $this->vehicleService->update($vehicle, $serviceIds);
    }
}
