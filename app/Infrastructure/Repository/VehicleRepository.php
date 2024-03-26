<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Vehicle\Entity\Vehicle;
use App\Domain\Vehicle\Infrastructure\Repository\VehicleRepositoryInterface;
use App\Models\Vehicle as ModelVehicle;
use Exception;

class VehicleRepository implements VehicleRepositoryInterface
{
    public function __construct(
        private ModelVehicle $db
    ) {
    }

    public function getByIdTryFrom(int $id): Vehicle
    {
        $row = $this->db::where('id', $id)->first();

        if (!$row) {
            throw new Exception('Veículo não encontrado');
        }

        return new Vehicle(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            userId: new Id($row->user_id),
            companyId: new Id($row->company_id),
            plate: $row->plate,
            model: $row->model,
            color: $row->color,
            price: $row->price,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function list(
        int $establishmentId,
        ?int $companyId,
        ?int $userId,
        ?string $plate,
        ?string $model,
        ?string $color,
        ?int $price,
        int $limitPerPage
    ): array {
        $row = $this->db::where('establishment_id', $establishmentId);

        if ($companyId) {
            $row = $row->where('company_id', $companyId);
        }

        if ($userId) {
            $row = $row->where('user_id', $userId);
        }

        if ($plate) {
            $row = $row->where('plate', 'LIKE', "$plate%");
        }

        if ($model) {
            $row = $row->where('model', 'LIKE', "$model%");
        }

        if ($color) {
            $row = $row->where('color', 'LIKE', "$color%");
        }

        if ($price) {
            $row = $row->where('price', 'LIKE', "$price%");
        }

        return $row->paginate($limitPerPage)->toArray();
    }
}
