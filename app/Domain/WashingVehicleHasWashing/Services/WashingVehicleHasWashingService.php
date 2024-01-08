<?php

namespace App\Domain\WashingVehicleHasWashing\Services;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\WashingVehicleHasWashing\Entity\WashingVehicleHasWashing;
use App\Domain\WashingVehicleHasWashing\Infrastructure\Entity\WashingVehicleHasWashingEntityInterface;

class WashingVehicleHasWashingService
{
    public function __construct(
        private WashingVehicleHasWashingEntityInterface $washingVehicleHasWashingEntity
    ) {
    }

    public function create(
        int $washingVehicleId,
        int $washingId
    ): WashingVehicleHasWashing {
        return $this->washingVehicleHasWashingEntity->create(
            new WashingVehicleHasWashing(
                id: null,
                washingVehicleId: new Id($washingVehicleId),
                washingId: new Id($washingId),
                createdAt: now(),
                updatedAt: now(),
                deletedAt: null
            )
        );
    }
}
