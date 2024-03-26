<?php

namespace App\Domain\Employee\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use JsonSerializable;

class Employee implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private ?Id $userId,
        private Id $establishmentId,
        private string $registration,
        private string $name,
        private ?string $email,
        private Active $active,
        private Active $admin,
        private ?string $emailVerifiedAt,
        private ?string $password,
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

    public function getEstablishmentId(): Id
    {
        return $this->establishmentId;
    }

    public function getRegistration(): string
    {
        return $this->registration;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getActive(): Active
    {
        return $this->active;
    }

    public function getAdmin(): Active
    {
        return $this->admin;
    }

    public function getEmailVerifiedAt(): ?string
    {
        return $this->emailVerifiedAt;
    }

    public function getPassword(): ?string
    {
        return $this->password;
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
            'userId' => $this->getUserId()?->get(),
            'establishmentId' => $this->getEstablishmentId()->get(),
            'registration' => $this->getRegistration(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'active' => $this->getActive()->value,
            'admin' => $this->getAdmin()->value,
            'emailVerifiedAt' => $this->getEmailVerifiedAt(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
