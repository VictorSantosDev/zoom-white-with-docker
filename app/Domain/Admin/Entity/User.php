<?php

namespace App\Domain\Admin\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use JsonSerializable;

class User implements JsonSerializable
{
    public function __construct(
        private ?Id $id,
        private string $name,
        private string $email,
        private ?string $phone,
        private Active $active,
        private ?string $cpf,
        private ?string $birthDate,
        private ?string $password,
        private ?string $emailVerifiedAt,
        private ?string $createdAt,
        private ?string $updatedAt,
        private ?string $deletedAt
    ) {
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function getActive(): Active
    {
        return $this->active;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    private function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getEmailVerifiedAt(): ?string
    {
        return $this->emailVerifiedAt;
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
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'phone' => $this->getPhone(),
            'active' => $this->getActive(),
            'cpf' => $this->getCpf(),
            'birthDate' => $this->getBirthDate(),
            'password' => $this->getPassword(),
            'emailVerifiedAt' => $this->getEmailVerifiedAt(),
            'createdAt' => $this->getCreatedAt(),
            'updatedAt' => $this->getUpdatedAt(),
            'deletedAt' => $this->getDeletedAt(),
        ];
    }
}
