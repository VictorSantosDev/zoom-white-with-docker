<?php

namespace App\Domain\WashingVehicle\Infrastructure\Repository;

use App\Domain\WashingVehicle\Entity\WashingVehicle;

interface WashingVehicleRepositoryInterface
{
    public function getByIdTryFrom(int $washingVehicleId): WashingVehicle;
    public function listWashingVehicleByEstablishmentId(
        int $establishmentId,
        ?int $employeeId,
        ?string $plate,
        ?string $model,
        ?string $color,
        ?int $price,
        int $limitPerPage
    ): array;
}
