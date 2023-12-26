<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\ParkingPrice\Entity\ParkingPrice;
use App\Domain\ParkingPrice\Infrastructure\Entity\ParkingPriceEntityInterface;
use App\Models\ParkingPrice as ModelsParkingPrice;

class ParkingPriceEntity implements ParkingPriceEntityInterface
{
    public function __construct(
        private ModelsParkingPrice $db
    ) {
    }

    public function create(ParkingPrice $parkingPrice): ParkingPrice
    {
        $row = $this->db::create([
            'establishment_id' => $parkingPrice->getEstablishmentId()->get(),
            'price_daily' => $parkingPrice->getPriceDaily(),
            'price_by_hour' => $parkingPrice->getPriceByHour(),
            'charge_every_hour' => $parkingPrice->getChargeEveryHour(),
            'price_per_hour' => $parkingPrice->getPricePerHour(),
            'has_other_night_price' => $parkingPrice->getHasOtherNightPrice(),
            'price_by_hour_night' => $parkingPrice->getPriceByHourNight(),
            'start_of_additional' => $parkingPrice->getStartOfAdditional(),
            'end_of_additional' => $parkingPrice->getEndOfAdditional(),
            'created_at' => $parkingPrice->getCreatedAt(),
            'updated_at' => $parkingPrice->getUpdatedAt(),
            'deleted_at' => $parkingPrice->getDeletedAt(),
        ]);

        return new ParkingPrice(
            id: new Id($row->id),
            establishmentId: $parkingPrice->getEstablishmentId(),
            priceDaily: $parkingPrice->getPriceDaily(),
            priceByHour: $parkingPrice->getPriceByHour(),
            chargeEveryHour: $parkingPrice->getChargeEveryHour(),
            pricePerHour: $parkingPrice->getPricePerHour(),
            hasOtherNightPrice: $parkingPrice->getHasOtherNightPrice(),
            priceByHourNight: $parkingPrice->getPriceByHourNight(),
            startOfAdditional: $parkingPrice->getStartOfAdditional(),
            endOfAdditional: $parkingPrice->getEndOfAdditional(),
            createdAt: $parkingPrice->getCreatedAt(),
            updatedAt: $parkingPrice->getUpdatedAt(),
            deletedAt: $parkingPrice->getDeletedAt(),
        );
    }

    public function update(ParkingPrice $parkingPrice): ParkingPrice
    {
        $row = $this->db::where('establishment_id', $parkingPrice->getEstablishmentId()->get())->first();

        $row->price_daily = $parkingPrice->getPriceDaily();
        $row->price_by_hour = $parkingPrice->getPriceByHour();
        $row->charge_every_hour = $parkingPrice->getChargeEveryHour();
        $row->price_per_hour = $parkingPrice->getPricePerHour();
        $row->has_other_night_price = $parkingPrice->getHasOtherNightPrice();
        $row->price_by_hour_night = $parkingPrice->getPriceByHourNight();
        $row->start_of_additional = $parkingPrice->getStartOfAdditional();
        $row->end_of_additional = $parkingPrice->getEndOfAdditional();
        $row->updated_at = $parkingPrice->getUpdatedAt();
        $row->save();

        return new ParkingPrice(
            id: new Id($row->id),
            establishmentId: $parkingPrice->getEstablishmentId(),
            priceDaily: $parkingPrice->getPriceDaily(),
            priceByHour: $parkingPrice->getPriceByHour(),
            chargeEveryHour: $parkingPrice->getChargeEveryHour(),
            pricePerHour: $parkingPrice->getPricePerHour(),
            hasOtherNightPrice: $parkingPrice->getHasOtherNightPrice(),
            priceByHourNight: $parkingPrice->getPriceByHourNight(),
            startOfAdditional: $parkingPrice->getStartOfAdditional(),
            endOfAdditional: $parkingPrice->getEndOfAdditional(),
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $parkingPrice->getUpdatedAt(),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
