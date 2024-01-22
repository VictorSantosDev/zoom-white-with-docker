<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Category\Entity\Category;
use App\Domain\Category\Infrastructure\Repository\CategoryRepositoryInterface;
use App\Domain\Enum\Active;
use App\Models\Category as ModelsCategory;
use Exception;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function __construct(
        private ModelsCategory $db
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

    public function listCategoryByEstablishmentId(int $establishmentId, ?string $name): array
    {
        $row = $this->db::where('establishment_id', $establishmentId);

        if ($name) {
            $row = $row->where('name', 'LIKE', "$name%");
        }

        return $row->paginate(10)->toArray();
    }
}
