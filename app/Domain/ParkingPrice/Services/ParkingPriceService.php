<?php

namespace App\Domain\ParkingPrice\Services;

use App\Domain\ParkingPrice\Entity\ParkingPrice;
use App\Domain\ParkingPrice\Infrastructure\Entity\ParkingPriceEntityInterface;
use App\Domain\ParkingPrice\Infrastructure\Repository\ParkingPriceRepositoryInterface;
use Exception;

class ParkingPriceService
{
    public function __construct(
        private ParkingPriceEntityInterface $parkingPriceEntityInterface,
        private ParkingPriceRepositoryInterface $parkingPriceRepositoryInterface
    ) {
    }

    public function createParkingPrice(ParkingPrice $parkingPrice): ParkingPrice
    {
        $this->existParkingPrice($parkingPrice);
        return $this->parkingPriceEntityInterface->create($parkingPrice);
    }

    public function updateParkingPrice(ParkingPrice $parkingPrice): ParkingPrice
    {
        $this->parkingPriceRepositoryInterface->getByEstablishmentIdTryFrom(
            $parkingPrice->getEstablishmentId()->get()
        );

        return $this->parkingPriceEntityInterface->update($parkingPrice);
    }

    public function showParkingPrice(?int $establishmentId): ParkingPrice
    {
        return $this->parkingPriceRepositoryInterface->getByEstablishmentIdTryFrom(
            $establishmentId
        );
    }

    public function existParkingPrice(ParkingPrice $parkingPrice)
    {
        $parkingPrice = $this->parkingPriceRepositoryInterface->getByEstablishmentId(
            $parkingPrice->getEstablishmentId()->get()
        );

        if ($parkingPrice) {
            throw new Exception('Preço para estacionamento já definido e não é possível cria-lo novamente só é possível ateralo');
        }
    }
}
