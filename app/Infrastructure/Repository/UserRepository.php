<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\Infrastructure\Repository\UserRepositoryInterface;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Models\User as EntityUser;
use Exception;

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
            createdAt: $row->created_at,
            updatedAt: $row->updated_at,
            deletedAt: $row->deleted_at,
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
            createdAt: $row->created_at,
            updatedAt: $row->updated_at,
            deletedAt: $row->deleted_at,
        );
    }

    public function listWithFilter(
        ?string $name,
        ?string $email,
        ?string $phone,
        ?string $cpf,
        ?string $active,
    ): array {

        $row = $this->db;

        if ($name) {
            $row = $row->where('name', 'LIKE', "%$name");
        }

        if ($email) {
            $row = $row->where('email', 'LIKE', "%$email");
        }

        if ($phone) {
            $row = $row->where('phone', 'LIKE', "%$phone");
        }

        if ($cpf) {
            $row = $row->where('cpf', 'LIKE', "%$cpf");
        }

        if ($active) {
            $row = $row->where('active', (int) $active);
        }

        return $row->paginate(10)->toArray();
    }

    public function getByIdTryFrom(?int $id): User
    {
        $row = $this->db::where('id', $id)
            ->where('active', Active::ACTIVE->value)
            ->first();

        if (!$row) {
            throw new Exception('Usuário não encontrado');
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
            createdAt: $row->created_at,
            updatedAt: $row->updated_at,
            deletedAt: $row->deleted_at,
        );
    }
}
