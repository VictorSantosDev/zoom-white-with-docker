<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Category\Entity\Category;
use App\Domain\Category\Infrastructure\Repository\CategoryRepositoryInterface;
use App\Domain\Enum\Active;
use Exception;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private $db
    ) {
    }

    public function getByIdTryFrom(int $id): Category
    {
        $row = $this->db::where('id', $id)->first();

        if (!$row) {
            throw new Exception('Categoria não encontrada');
        }

        return new Category(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            name: $row->name,
            numberIcon: $row->number_icon,
            active: Active::tryFrom($row->active),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
