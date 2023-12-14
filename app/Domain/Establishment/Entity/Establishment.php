<?php

declare(strict_types=1);

namespace App\Domain\Establishment\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Enum\TypeEstablishment;
use JsonSerializable;

class Establishment implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private string $nameByCompany,
        private string $document,
        private TypeEstablishment $type,
        private string $corSystem,
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

    public function getNameByCompany(): string
    {
        return $this->nameByCompany;
    }

    public function getDocument(): string
    {
        return $this->document;
    }

    public function getType(): TypeEstablishment
    {
        return $this->type;
    }

    public function getCorSystem(): string
    {
        return $this->corSystem;
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
            'id' => $this->getId()->get(),
            'nameByCompany' => $this->getNameByCompany(),
            'document' => $this->getDocument(),
            'type' => $this->getType()->value,
            'corSystem' => $this->getCorSystem(),
            'active' => $this->getActive()->value,
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
