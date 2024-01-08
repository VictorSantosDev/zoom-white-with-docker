<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\WashingVehicleHasWashing\Entity\WashingVehicleHasWashing;
use App\Domain\WashingVehicleHasWashing\Infrastructure\Entity\WashingVehicleHasWashingEntityInterface;
use App\Models\WashingVehicleHasWashing as ModelsWashingVehicleHasWashing;

class WashingVehicleHasWashingEntity implements WashingVehicleHasWashingEntityInterface
{
    public function __construct(
        private ModelsWashingVehicleHasWashing $db
    ) {
    }

    public function create(WashingVehicleHasWashing $washingVehicleHasWashing): WashingVehicleHasWashing
    {
        $row = $this->db::create([
            'washing_vehicle_id' => $washingVehicleHasWashing->getWashingVehicleId()->get(),
            'washing_id' => $washingVehicleHasWashing->getWashingId()->get(),
            'created_at' => $washingVehicleHasWashing->getCreatedAt(),
            'updated_at' => $washingVehicleHasWashing->getUpdatedAt(),
            'deleted_at' => $washingVehicleHasWashing->getDeletedAt(),
        ]);

        return new WashingVehicleHasWashing(
            id: new Id($row->id),
            washingVehicleId: $washingVehicleHasWashing->getWashingVehicleId(),
            washingId: $washingVehicleHasWashing->getWashingId(),
            createdAt: $washingVehicleHasWashing->getCreatedAt(),
            updatedAt: $washingVehicleHasWashing->getUpdatedAt(),
            deletedAt: $washingVehicleHasWashing->getDeletedAt()
        );
    }
}
