<?php

namespace App\Domain\ParkingPrice\Infrastructure\Repository;

use App\Domain\ParkingPrice\Entity\ParkingPrice;

interface ParkingPriceRepositoryInterface
{
    public function getByEstablishmentId(?int $establishmentId): ?ParkingPrice;
    public function getByEstablishmentIdTryFrom(?int $establishmentId): ParkingPrice;
}
