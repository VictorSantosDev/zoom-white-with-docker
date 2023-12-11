<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\Infrastructure\Repository\UserRepositoryInterface;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Models\User as EntityUser;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private EntityUser $db
    ) {
    }

    public function cpfExist(?string $cpf): ?User
    {
        $row = $this->db::where('cpf', $cpf)->first();

        if (!$row) {
            return null;
        }

        return new User(
            id: new Id($row->id),
            name: $row->name,
            email: $row->email,
            phone: $row->phone,
            active: Active::tryFrom($row->active),
            cpf: $row->cpf,
            birthDate: $row->birthDate,
            password: $row->password,
            emailVerifiedAt: $row->emailVerifiedAt,
            createdAt: $row->createdAt,
            updatedAt: $row->updatedAt,
            deletedAt: $row->deletedAt,
        );
    }

    public function emailExist(?string $email): ?User
    {
        $row = $this->db::where('email', $email)->first();

        if (!$row) {
            return null;
        }

        return new User(
            id: new Id($row->id),
            name: $row->name,
            email: $row->email,
            phone: $row->phone,
            active: Active::tryFrom($row->active),
            cpf: $row->cpf,
            birthDate: $row->birthDate,
            password: $row->password,
            emailVerifiedAt: $row->emailVerifiedAt,
            createdAt: $row->createdAt,
            updatedAt: $row->updatedAt,
            deletedAt: $row->deletedAt,
        );
    }

    public function phoneExist(?string $phone): ?User
    {
        $row = $this->db::where('phone', $phone)->first();

        if (!$row) {
            return null;
        }

        return new User(
            id: new Id($row->id),
            name: $row->name,
            email: $row->email,
            phone: $row->phone,
            active: Active::tryFrom($row->active),
            cpf: $row->cpf,
            birthDate: $row->birthDate,
            password: $row->password,
            emailVerifiedAt: $row->emailVerifiedAt,
            createdAt: $row->createdAt,
            updatedAt: $row->updatedAt,
            deletedAt: $row->deletedAt,
        );
    }
}
