<?php

namespace App\Domain\Washing\Infrastructure\Repository;

use App\Domain\Washing\Entity\Washing;

interface WashingRepositoryInterface
{
    public function getAllWashing(int $establishmentId): array;
    public function getByIdTryFrom(int $id): Washing;
    public function listWashingByEstablishmentId(int $establishmentId, ?string $name, ?string $active): array;
}
