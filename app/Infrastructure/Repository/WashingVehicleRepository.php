<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\WashingVehicle\Entity\WashingVehicle;
use App\Domain\WashingVehicle\Infrastructure\Repository\WashingVehicleRepositoryInterface;
use App\Models\WashingVehicle as ModelsWashingVehicle;
use Exception;

class WashingVehicleRepository implements WashingVehicleRepositoryInterface
{
    public function __construct(
        private ModelsWashingVehicle $db
    ) {
    }

    public function getByIdTryFrom(int $washingVehicleId): WashingVehicle
    {
        $row = $this->db::where('id', $washingVehicleId)->first();

        if (!$row) {
            throw new Exception('Lavagem do veículo não contrada.');
        }

        return new WashingVehicle(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            employeeId: new Id($row->employee_id),
            plate: $row->plate,
            model: $row->model,
            color: $row->color,
            price: $row->price,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
