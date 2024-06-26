<?php

namespace App\Domain\User\Services;

use App\Domain\Vehicle\Entity\Vehicle;
use App\Domain\Vehicle\Services\VehicleService;

class UserVehicleService
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

    public function show(int $id): Vehicle
    {
        return $this->vehicleService->show($id);
    }

    public function showFull(int $id): array
    {
        return $this->vehicleService->showFull($id);
    }

    public function list(
        int $establishmentId,
        ?int $companyId,
        ?int $userId,
        ?string $plate,
        ?string $model,
        ?string $color,
        ?int $price,
        int $limitPerPage
    ): array {
        return $this->vehicleService->list(
            $establishmentId,
            $companyId,
            $userId,
            $plate,
            $model,
            $color,
            $price,
            $limitPerPage
        );
    }

    public function delete(int $id): bool
    {
        return $this->vehicleService->delete($id);
    }
}
