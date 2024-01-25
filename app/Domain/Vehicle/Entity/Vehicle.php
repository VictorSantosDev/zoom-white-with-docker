<?php

namespace App\Domain\Vehicle\Entity;

use App\Domain\Admin\ValueObjects\Id;
use JsonSerializable;

class Vehicle implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private Id $establishmentId,
        private Id $employeeId,
        private ?Id $companyId,
        private string $plate,
        private string $model,
        private string $color,
        private int $price,
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

    public function getEmployeeId(): Id
    {
        return $this->employeeId;
    }

    public function getCompanyId(): ?Id
    {
        return $this->companyId;
    }

    public function getPlate(): string
    {
        return $this->plate;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getPrice(): int
    {
        return $this->price;
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


    public function jsonSerialize(): array
    {
        return [
            'id' => $this->getId()?->get(),
            'establishmentId' => $this->getEstablishmentId()?->get(),
            'employeeId' => $this->getEmployeeId()?->get(),
            'companyId' => $this->getCompanyId()?->get(),
            'plate' => $this->getPlate(),
            'model' => $this->getModel(),
            'color' => $this->getColor(),
            'price' => $this->getPrice(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
