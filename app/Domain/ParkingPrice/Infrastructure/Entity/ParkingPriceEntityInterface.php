<?php

namespace App\Domain\ParkingPrice\Infrastructure\Entity;

use App\Domain\ParkingPrice\Entity\ParkingPrice;

interface ParkingPriceEntityInterface
{
    public function create(ParkingPrice $parkingPrice): ParkingPrice;
    public function update(ParkingPrice $parkingPrice): ParkingPrice;
}
