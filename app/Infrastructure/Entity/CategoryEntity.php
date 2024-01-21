<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Category\Entity\Category;
use App\Domain\Category\Infrastructure\Entity\CategoryEntityInterface;
use Exception;

class CategoryEntity implements CategoryEntityInterface
{
    public function __construct(
        private $db
    ) {
    }

    public function create(Category $category): Category
    {
        $row = $this->db::create([
            'establishment_id' => $category->getEstablishmentId()->get(),
            'name' => $category->getName(),
            'number_icon' => $category->getNumberIcon(),
            'active' => $category->getActive()->value,
            'created_at' => $category->getCreatedAt(),
            'updated_at' => $category->getUpdatedAt(),
            'deleted_at' => $category->getDeletedAt(),
        ]);

        return new Category(
            id: new Id($row->id),
            establishmentId: $category->getEstablishmentId(),
            name: $category->getName(),
            numberIcon: $category->getNumberIcon(),
            active: $category->getActive(),
            createdAt: $category->getCreatedAt(),
            updatedAt: $category->getUpdatedAt(),
            deletedAt: $category->getDeletedAt()
        );
    }

    public function update(Category $category): Category
    {
        $row = $this->db::where('id', $category->getId()?->get())->first();

        if (!$row) {
            throw new Exception('Categoria não encontrada');
        }

        $row->name = $category->getName();
        $row->name = $category->getNumberIcon();

        return new Category(
            id: new Id($row->id),
            establishmentId: $category->getEstablishmentId(),
            name: $category->getName(),
            numberIcon: $category->getNumberIcon(),
            active: $category->getActive(),
            createdAt: $category->getCreatedAt(),
            updatedAt: $category->getUpdatedAt(),
            deletedAt: $category->getDeletedAt()
        );
    }
}
