<?php

namespace App\Domain\WashingVehicleHasWashing\Services;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\WashingVehicleHasWashing\Entity\WashingVehicleHasWashing;
use App\Domain\WashingVehicleHasWashing\Infrastructure\Entity\WashingVehicleHasWashingEntityInterface;
use App\Domain\WashingVehicleHasWashing\Infrastructure\Repository\WashingVehicleHasWashingRepositoryInterface;

class WashingVehicleHasWashingService
{
    public function __construct(
        private WashingVehicleHasWashingEntityInterface $washingVehicleHasWashingEntity,
        private WashingVehicleHasWashingRepositoryInterface $washingVehicleHasWashingRepository
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

    public function updateByWashingVehicle(int $washingVehicleId, array $washingCollect): bool
    {
        $allWashingVehicleHasWashings = $this->washingVehicleHasWashingRepository->getAllByWashingVehicleId($washingVehicleId);
        $diff = $this->getDiff(
            $allWashingVehicleHasWashings,
            $washingCollect
        );

        $this->washingVehicleHasWashingEntity->deleteByWashingIds($diff['remove']);
        $this->saveCollect($washingVehicleId, $diff['add']);

        return true;
    }

    private function saveCollect(int $washingVehicleId, array $addWashingsIds): void
    {
        foreach ($addWashingsIds as $washingsId) {
            $this->create($washingVehicleId, $washingsId);
        }
    }

    private function getDiff(array $allWashingVehicleHasWashings, $washingCollect): array
    {
        $washingIdsCurrent = [];
        $washingIdsNew = [];

        foreach ($allWashingVehicleHasWashings as $washingVehicleHasWashing) {
            $washingIdsCurrent[] = $washingVehicleHasWashing['washing_id'];
        }

        foreach ($washingCollect as $washing) {
            $washingIdsNew[] = $washing['id'];
        }

        return [
            'add' => array_diff($washingIdsNew, $washingIdsCurrent),
            'remove' => array_diff($washingIdsCurrent, $washingIdsNew)
        ];
    }
}
