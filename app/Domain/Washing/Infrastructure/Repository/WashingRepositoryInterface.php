<?php

namespace App\Domain\Washing\Infrastructure\Repository;

use App\Domain\Washing\Entity\Washing;
use Illuminate\Database\Eloquent\Collection;

interface WashingRepositoryInterface
{
    public function getAllWashing(int $establishmentId): array;
    public function getByIdTryFrom(int $id): Washing;
    public function listWashingByEstablishmentId(int $establishmentId, ?string $name, ?string $active): array;
    public function getAllWashingByIds(array $washingIds): Collection;
}
