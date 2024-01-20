<?php

namespace App\Domain\Address\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use JsonSerializable;

class Address implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private ?Id $userId,
        private ?Id $establishmentId,
        private ?Id $companyId,
        private ?string $postalCode,
        private ?string $street,
        private ?string $neighborhood,
        private ?string $state,
        private ?string $city,
        private ?string $number,
        private ?string $complement,
        private Active $active,
        private ?string $createdAt,
        private ?string $updatedAt,
        private ?string $deletedAt
    ) {
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function getUserId(): ?Id
    {
        return $this->userId;
    }

    public function getEstablishmentId(): ?Id
    {
        return $this->establishmentId;
    }

    public function getCompanyId(): ?Id
    {
        return $this->companyId;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function getNeighborhood(): ?string
    {
        return $this->neighborhood;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function getComplement(): ?string
    {
        return $this->complement;
    }

    public function getActive(): Active
    {
        return $this->active;
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
            'userId' => $this->getUserId()?->get(),
            'establishmentId' => $this->getEstablishmentId()?->get(),
            'companyId' => $this->getCompanyId()?->get(),
            'postalCode' => $this->getPostalCode(),
            'street' => $this->getStreet(),
            'neighborhood' => $this->getNeighborhood(),
            'state' => $this->getState(),
            'city' => $this->getCity(),
            'number' => $this->getNumber(),
            'complement' => $this->getComplement(),
            'active' => $this->getActive()->value,
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
