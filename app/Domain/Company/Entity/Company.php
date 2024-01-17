<?php

namespace App\Domain\Company\Entity;

use App\Domain\Admin\ValueObjects\Id;
use JsonSerializable;

class Company implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private Id $establishmentId,
        private ?string $companyName,
        private ?string $fantasyName,
        private ?string $document,
        private ?string $phone,
        private ?string $email,
        private ?string $closingDate,
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

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function getFantasyName(): ?string
    {
        return $this->fantasyName;
    }

    public function getDocument(): ?string
    {
        return $this->document;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getClosingDate(): ?string
    {
        return $this->closingDate;
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
            'companyName' => $this->getCompanyName(),
            'fantasyName' => $this->getFantasyName(),
            'document' => $this->getDocument(),
            'phone' => $this->getPhone(),
            'email' => $this->getEmail(),
            'closingDate' => $this->getClosingDate(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
