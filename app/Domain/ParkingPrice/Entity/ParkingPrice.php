<?php

namespace App\Domain\ParkingPrice\Entity;

use App\Domain\Admin\ValueObjects\Id;
use JsonSerializable;

class ParkingPrice implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private Id $establishmentId,
        private int $priceDaily,
        private int $priceByHour,
        private int $chargeEveryHour,
        private int $pricePerHour,
        private int $hasOtherNightPrice,
        private ?int $priceByHourNight,
        private ?string $startOfAdditional,
        private ?string $endOfAdditional,
        private ?string $createdAt,
        private ?string $updatedAt,
        private ?string $deletedAt
    ) {
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function getEstablishmentId(): Id
    {
        return $this->establishmentId;
    }

    public function getPriceDaily(): int
    {
        return $this->priceDaily;
    }

    public function getPriceByHour(): int
    {
        return $this->priceByHour;
    }

    public function getChargeEveryHour(): int
    {
        return $this->chargeEveryHour;
    }

    public function getPricePerHour(): int
    {
        return $this->pricePerHour;
    }

    public function getHasOtherNightPrice(): int
    {
        return $this->hasOtherNightPrice;
    }

    public function getPriceByHourNight(): ?int
    {
        return $this->priceByHourNight;
    }

    public function getStartOfAdditional(): ?string
    {
        return $this->startOfAdditional;
    }

    public function getEndOfAdditional(): ?string
    {
        return $this->endOfAdditional;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->getId()?->get(),
            'establishmentId' => $this->getEstablishmentId()->get(),
            'priceDaily' => $this->getPriceDaily(),
            'priceByHour' => $this->getPriceByHour(),
            'chargeEveryHour' => $this->getChargeEveryHour(),
            'pricePerHour' => $this->getPricePerHour(),
            'hasOtherNightPrice' => $this->getHasOtherNightPrice(),
            'priceByHourNight' => $this->getPriceByHourNight(),
            'startOfAdditional' => $this->getStartOfAdditional(),
            'endOfAdditional' => $this->getEndOfAdditional(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
