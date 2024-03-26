<?php

namespace App\Domain\Category\Infrastructure\Repository;

use App\Domain\Category\Entity\Category;

interface CategoryRepositoryInterface
{
    public function getByIdTryFrom(int $id): Category;
    public function listCategoryByEstablishmentId(int $establishmentId, ?string $name): array;
}
