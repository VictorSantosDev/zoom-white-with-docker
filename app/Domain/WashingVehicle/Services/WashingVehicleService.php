<?php

namespace App\Domain\WashingVehicle\Services;

use App\Domain\Establishment\Services\EstablishmentService;
use App\Domain\Washing\Services\WashingService;
use App\Domain\WashingVehicle\Factory\WashingVehicleFactory;
use Exception;

class WashingVehicleService
{
    public function __construct(
        private EstablishmentService $establishmentService,
        private WashingService $washingService
    ) {
    }

    public function create(
        int $estableshimentId,
        array $washingIds,
        string $plate,
        string $model,
        string $color
    ) {
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

        dd($washingVehicle);
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
