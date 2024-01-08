<?php

namespace App\Domain\WashingVehicle\Services;

use App\Domain\Establishment\Services\EstablishmentService;
use App\Domain\Washing\Services\WashingService;
use App\Domain\WashingVehicle\Entity\WashingVehicle;
use App\Domain\WashingVehicle\Factory\WashingVehicleFactory;
use App\Domain\WashingVehicle\Infrastructure\Entity\WashingVehicleEntityInterface;
use App\Domain\WashingVehicleHasWashing\Services\WashingVehicleHasWashingService;
use Exception;
use Illuminate\Database\Eloquent\Collection;

class WashingVehicleService
{
    public function __construct(
        private EstablishmentService $establishmentService,
        private WashingService $washingService,
        private WashingVehicleHasWashingService $washingVehicleHasWashingService,
        private WashingVehicleEntityInterface $washingVehicleEntity
    ) {
    }

    public function create(
        int $estableshimentId,
        array $washingIds,
        string $plate,
        string $model,
        string $color
    ): WashingVehicle {
        $employee = auth('employee')->user();
        $estableshiment = $this->establishmentService->show($estableshimentId);
        $washingCollect = $this->washingService->findAllWashingIds($washingIds);
        $pricesByWashigs = $this->sumPriceWashing($washingCollect->toArray());

        $washingVehicle = WashingVehicleFactory::createWashingVehicle(
            establishmentId: $estableshiment['establishment']->getId()->get(),
            employeeId: $employee->id,
            plate: $plate,
            model: $model,
            color: $color,
            price: $pricesByWashigs
        );

        $washingVehicle = $this->washingVehicleEntity->create($washingVehicle);

        $this->saveWashingVehicleHasWashing(
            $washingVehicle->getId()->get(),
            $washingCollect->toArray()
        );

        return $washingVehicle;
    }

    private function saveWashingVehicleHasWashing(
        int $washingVehicleId,
        array $washingCollect
    ): void {
        foreach ($washingCollect as $washing) {
            $this->washingVehicleHasWashingService->create(
                washingVehicleId: $washingVehicleId,
                washingId: $washing['id']
            );
        }
    }

    private function sumPriceWashing(array $washings): int
    {
        if (empty($washings)) {
            throw new Exception('Não foi possível encontrar as lavagens');
        }

        $price = 0;

        foreach ($washings as $washing) {
            $price += $washing['price'];
        }

        return $price;
    }
}
