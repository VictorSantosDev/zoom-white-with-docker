<?php

namespace App\Domain\Employee\Services;

use App\Domain\WashingVehicle\Entity\WashingVehicle;
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
    ): WashingVehicle {
        return $this->washingVehicleService->create(
            $estableshimentId,
            $washingIds,
            $plate,
            $model,
            $color
        );
    }

    public function update(
        int $washingVehicleId,
        array $washingIds,
        string $plate,
        string $model,
        string $color
    ): WashingVehicle {
        return $this->washingVehicleService->update(
            $washingVehicleId,
            $washingIds,
            $plate,
            $model,
            $color
        );
    }

    public function show(int $washingVehicleId): WashingVehicle
    {
        return $this->washingVehicleService->show($washingVehicleId);
    }

    public function listAction(
        int $establishmentId,
        ?int $employeeId,
        ?string $plate,
        ?string $model,
        ?string $color,
        ?int $price,
        int $limitPerPage
    ) {
        return $this->washingVehicleService->listAction(
            $establishmentId,
            $employeeId,
            $plate,
            $model,
            $color,
            $price,
            $limitPerPage
        );
    }

    public function delete(int $washingVehicleId): bool
    {
        return $this->washingVehicleService->delete($washingVehicleId);
    }
}
