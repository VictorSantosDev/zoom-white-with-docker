<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\ParkingPrice\Entity\ParkingPrice;
use App\Domain\ParkingPrice\Infrastructure\Repository\ParkingPriceRepositoryInterface;
use App\Models\ParkingPrice as ModelsParkingPrice;
use Exception;

class ParkingPriceRepository implements ParkingPriceRepositoryInterface
{
    public function __construct(
        private ModelsParkingPrice $db
    ) {
    }

    public function getByEstablishmentId(?int $establishmentId): ?ParkingPrice
    {
        $row = $this->db::where('establishment_id', $establishmentId)->first();

        if (!$row) {
            return null;
        }

        return new ParkingPrice(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            priceDaily: $row->price_daily,
            priceByHour: $row->price_by_hour,
            chargeEveryHour: $row->charge_every_hour,
            pricePerHour: $row->price_per_hour,
            hasOtherNightPrice: $row->has_other_night_price,
            priceByHourNight: $row->price_by_hour_night,
            startOfAdditional: $row->start_of_additional,
            endOfAdditional: $row->end_of_additional,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function getByEstablishmentIdTryFrom(?int $establishmentId): ParkingPrice
    {
        $row = $this->db::where('establishment_id', $establishmentId)->first();

        if (!$row) {
            throw new Exception('Preço do estacionamento não encontrado');
        }

        return new ParkingPrice(
            id: new Id($row->id),
            establishmentId: new Id($row->establishment_id),
            priceDaily: $row->price_daily,
            priceByHour: $row->price_by_hour,
            chargeEveryHour: $row->charge_every_hour,
            pricePerHour: $row->price_per_hour,
            hasOtherNightPrice: $row->has_other_night_price,
            priceByHourNight: $row->price_by_hour_night,
            startOfAdditional: $row->start_of_additional,
            endOfAdditional: $row->end_of_additional,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
