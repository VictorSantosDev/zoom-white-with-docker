<?php

namespace App\Domain\Coupons\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\DaysOfTheWeek;
use JsonSerializable;

class Coupons implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private Id $establishmentId,
        private string $nameByCompany,
        private string $openingHoursStart,
        private string $openingHoursEnd,
        private DaysOfTheWeek $daysOfTheWeekStart,
        private DaysOfTheWeek $daysOfTheWeekEnd,
        private ?string $info,
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

    public function getNameByCompany(): string
    {
        return $this->nameByCompany;
    }

    public function getOpeningHoursStart(): string
    {
        return $this->openingHoursStart;
    }

    public function getOpeningHoursEnd(): string
    {
        return $this->openingHoursEnd;
    }

    public function getDaysOfTheWeekStart(): DaysOfTheWeek
    {
        return $this->daysOfTheWeekStart;
    }

    public function getDaysOfTheWeekEnd(): DaysOfTheWeek
    {
        return $this->daysOfTheWeekEnd;
    }

    public function getInfo(): ?string
    {
        return $this->info;
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
            'nameByCompany' => $this->getNameByCompany(),
            'openingHoursStart' => $this->getOpeningHoursStart(),
            'openingHoursEnd' => $this->getOpeningHoursEnd(),
            'daysOfTheWeekStart' => $this->getDaysOfTheWeekStart()->value,
            'daysOfTheWeekEnd' => $this->getDaysOfTheWeekEnd()->value,
            'info' => $this->getInfo(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
