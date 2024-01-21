<?php

namespace App\Domain\User\Services;

use App\Domain\Category\Entity\Category;
use App\Domain\Category\Services\CategoryService;

class UserCategoryService
{
    public function __construct(
        private CategoryService $categoryService
    ) {
    }

    public function create(Category $category): Category
    {
        return $this->categoryService->create($category);
    }

    public function update(Category $category): Category
    {
        return $this->categoryService->update($category);
    }

    public function show(int $id): Category
    {
        return $this->categoryService->show($id);
    }
}
