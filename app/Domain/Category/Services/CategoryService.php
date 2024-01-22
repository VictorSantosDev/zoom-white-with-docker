<?php

namespace App\Domain\Category\Services;

use App\Domain\Category\Entity\Category;
use App\Domain\Category\Infrastructure\Entity\CategoryEntityInterface;
use App\Domain\Category\Infrastructure\Repository\CategoryRepositoryInterface;
use App\Domain\Establishment\Services\EstablishmentService;

class CategoryService
{
    public function __construct(
        private CategoryEntityInterface $categoryEntityInterface,
        private CategoryRepositoryInterface $categoryRepositoryInterface,
        private EstablishmentService $establishmentService
    ) {
    }

    public function create(Category $category): Category
    {
        $this->establishmentService->show($category->getEstablishmentId()->get());
        return $this->categoryEntityInterface->create($category);
    }

    public function update(Category $category): Category
    {
        return $this->categoryEntityInterface->update($category);
    }

    public function show(int $id): Category
    {
        return $this->categoryRepositoryInterface->getByIdTryFrom($id);
    }

    public function list(
        int $establishmentId,
        ?string $name
    ): array {
        return $this->categoryRepositoryInterface->listCategoryByEstablishmentId($establishmentId, $name);
    }

    public function delete(int $id): bool
    {
        return $this->categoryEntityInterface->delete($id);
    }
}
