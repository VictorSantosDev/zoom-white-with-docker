<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Service\Entity\ServiceEntity;
use App\Domain\Service\Infrastructure\Repository\ServiceRepositoryInterface;
use App\Models\Service as ModelService;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ServiceRepository implements ServiceRepositoryInterface
{
    public function __construct(
        private ModelService $db
    ) {
    }

    public function getByIdTryFrom(int $id): ServiceEntity
    {
        $row = $this->db::where('id', $id)->first();

        if (!$row) {
            throw new Exception('Serviço não encontrado');
        }

        return new ServiceEntity(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            categoryId: new Id($row->category_id),
            name: $row->name,
            price: $row->price,
            active: Active::tryFrom($row->active),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function listServiceByEstablishmentId(
        int $establishmentId,
        ?int $categoryId,
        ?string $name,
        ?int $price,
        ?int $limitPerPage = 10
    ): array {
        $row = DB::table('service as s')
            ->select([
                's.id',
                's.establishment_id',
                's.category_id',
                's.name',
                'c.name as nameCategory',
                's.price',
                's.active',
                's.created_at',
                's.updated_at',
                's.deleted_at',
            ])
            ->join('category as c', 'c.id', '=', 's.category_id')
            ->where('s.establishment_id', $establishmentId)
            ->whereNull('s.deleted_at');

        if ($categoryId) {
            $row = $row->where('s.category_id', $categoryId);
        }

        if ($name) {
            $row = $row->where('s.name', 'LIKE', "$name%");
        }

        if ($price) {
            $row = $row->where('s.price', 'LIKE', "$price%");
        }

        return $row->orderBy('id', 'desc')->paginate($limitPerPage)->toArray();
    }

    public function getByServiceIds(array $serviceIds): Collection
    {
        return $this->db::whereIn('id', $serviceIds)->get();
    }
}
