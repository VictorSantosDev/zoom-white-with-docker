<?php

namespace App\Domain\Category\Infrastructure\Entity;

use App\Domain\Category\Entity\Category;

interface CategoryEntityInterface
{
    public function create(Category $category): Category;
    public function update(Category $category): Category;
}
