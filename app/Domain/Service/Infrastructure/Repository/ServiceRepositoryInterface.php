<?php

namespace App\Domain\Service\Infrastructure\Repository;

use App\Domain\Service\Entity\ServiceEntity;
use Illuminate\Database\Eloquent\Collection;

interface ServiceRepositoryInterface
{
    public function getByIdTryFrom(int $id): ServiceEntity;
    public function listServiceByEstablishmentId(
        int $establishmentId,
        ?string $name,
        ?int $price,
        ?int $limitPerPage
    ): array;
    public function getByServiceIds(array $serviceIds): Collection;
}
