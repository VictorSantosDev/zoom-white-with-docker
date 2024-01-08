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
}
