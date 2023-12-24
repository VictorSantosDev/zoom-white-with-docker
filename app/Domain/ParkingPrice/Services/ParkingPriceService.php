<?php

namespace App\Domain\ParkingPrice\Services;

use App\Domain\ParkingPrice\Entity\ParkingPrice;

class ParkingPriceService
{
    public function createParkingPrice(ParkingPrice $parkingPrice): ParkingPrice
    {
        dd($parkingPrice);
    }
}
