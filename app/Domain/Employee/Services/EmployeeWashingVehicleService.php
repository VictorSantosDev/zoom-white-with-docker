<?php

namespace App\Domain\Employee\Services;

use App\Domain\WashingVehicle\Services\WashingVehicleService;

class EmployeeWashingVehicleService
{
    public function __construct(
        private WashingVehicleService $washingVehicleService
    ) {
    }

    public function create(
        int $estableshimentId,
        array $washingIds,
        string $plate,
        string $model,
        string $color
    ) {
        $this->washingVehicleService->create(
            $estableshimentId,
            $washingIds,
            $plate,
            $model,
            $color
        );
    }
}
