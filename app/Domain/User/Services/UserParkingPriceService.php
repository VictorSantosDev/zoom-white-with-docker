<?php

namespace App\Domain\User\Services;

use App\Domain\ParkingPrice\Entity\ParkingPrice;
use App\Domain\ParkingPrice\Services\ParkingPriceService;

class UserParkingPriceService
{
    public function __construct(
        private ParkingPriceService $parkingPriceService
    ) {
    }

    public function createParkingPrice(ParkingPrice $parkingPrice): ParkingPrice
    {
        return $this->parkingPriceService->createParkingPrice($parkingPrice);
    }

    public function updateParkingPrice(ParkingPrice $parkingPrice): ParkingPrice
    {
        return $this->parkingPriceService->updateParkingPrice($parkingPrice);
    }

    public function showParkingPrice(?int $establishmentId): ParkingPrice
    {
        return $this->parkingPriceService->showParkingPrice($establishmentId);
    }
}
