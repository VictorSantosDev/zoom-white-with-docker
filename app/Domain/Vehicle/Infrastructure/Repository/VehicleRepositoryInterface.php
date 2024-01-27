<?php

namespace App\Domain\Vehicle\Infrastructure\Repository;

use App\Domain\Vehicle\Entity\Vehicle;

interface VehicleRepositoryInterface
{
    public function getByIdTryFrom(int $id): Vehicle;
    public function list(
        int $establishmentId,
        ?int $companyId,
        ?int $employeeId,
        ?string $plate,
        ?string $model,
        ?string $color,
        ?int $price,
        int $limitPerPage
    ): array;
}
