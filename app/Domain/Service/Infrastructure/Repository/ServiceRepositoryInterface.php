<?php

namespace App\Domain\Service\Infrastructure\Repository;

use App\Domain\Service\Entity\ServiceEntity;

interface ServiceRepositoryInterface
{
    public function getByIdTryFrom(int $id): ServiceEntity;
    public function listServiceByEstablishmentId(
        int $establishmentId,
        ?string $name,
        ?int $price,
        ?int $limitPerPage
    ): array;
}
