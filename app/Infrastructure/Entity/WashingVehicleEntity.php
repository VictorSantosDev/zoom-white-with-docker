<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\WashingVehicle\Entity\WashingVehicle;
use App\Domain\WashingVehicle\Infrastructure\Entity\WashingVehicleEntityInterface;
use App\Models\WashingVehicle as ModelsWashingVehicle;

class WashingVehicleEntity implements WashingVehicleEntityInterface
{
    public function __construct(
        private ModelsWashingVehicle $db
    ) {
    }

    public function create(WashingVehicle $washingVehicle): WashingVehicle
    {
        $row = $this->db::create([
            'establishment_id' => $washingVehicle->getEstablishmentId()->get(),
            'employee_id' => $washingVehicle->getEmployeeId()->get(),
            'plate' => $washingVehicle->getPlate(),
            'model' => $washingVehicle->getModel(),
            'color' => $washingVehicle->getColor(),
            'price' => $washingVehicle->getPrice(),
            'created_at' => $washingVehicle->getCreatedAt(),
            'updated_at' => $washingVehicle->getUpdatedAt(),
            'deleted_at' => $washingVehicle->getDeletedAt(),
        ]);

        return new WashingVehicle(
            id: new Id($row->id),
            establishmentId: $washingVehicle->getEstablishmentId(),
            employeeId: $washingVehicle->getEmployeeId(),
            plate: $washingVehicle->getPlate(),
            model: $washingVehicle->getModel(),
            color: $washingVehicle->getColor(),
            price: $washingVehicle->getPrice(),
            createdAt: $washingVehicle->getCreatedAt(),
            updatedAt: $washingVehicle->getUpdatedAt(),
            deletedAt: $washingVehicle->getDeletedAt(),
        );
    }

    public function update(int $washingVehicleId, WashingVehicle $washingVehicle): WashingVehicle
    {
        $row = $this->db::where('id', $washingVehicleId)->first();

        $row->plate = $washingVehicle->getPlate();
        $row->model = $washingVehicle->getModel();
        $row->color = $washingVehicle->getColor();
        $row->price = $washingVehicle->getPrice();
        $row->updated_at = $washingVehicle->getUpdatedAt();
        $row->save();

        return new WashingVehicle(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            employeeId: new Id($row->employee_id),
            plate: $washingVehicle->getPlate(),
            model: $washingVehicle->getModel(),
            color: $washingVehicle->getColor(),
            price: $washingVehicle->getPrice(),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
