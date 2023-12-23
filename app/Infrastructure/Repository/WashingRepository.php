<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Washing\Entity\Washing;
use App\Domain\Washing\Infrastructure\Repository\WashingRepositoryInterface;
use App\Models\Washing as ModelWashing;
use Exception;

class WashingRepository implements WashingRepositoryInterface
{
    public function __construct(
        private ModelWashing $db
    ) {
    }

    public function getAllWashing(int $establishmentId): array
    {
        $rows = $this->db::where('establishment_id', $establishmentId)->get()->toArray();
        return $rows;
    }

    public function getByIdTryFrom(int $id): Washing
    {
        $row = $this->db::where('id', $id)->first();

        if (!$row) {
            throw new Exception('Lavagem não encontrado');
        }

        return new Washing(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            name: $row->name,
            price: $row->price,
            active: Active::tryFrom($row->active),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function listWashingByEstablishmentId(int $establishmentId, ?string $name, ?string $active): array
    {
        $row = $this->db::where('establishment_id', $establishmentId);

        if ($name) {
            $row = $row->where('name', 'LIKE', "%$name");
        }

        if ($active) {
            $row = $row->where('name', $active);
        }

        return $row->paginate(10)->toArray();
    }
}
