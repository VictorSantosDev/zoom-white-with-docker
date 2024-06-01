<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\Infrastructure\Repository\UserRepositoryInterface;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Enum\TypeUser;
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
            typeUser: TypeUser::tryFromByName($row->type_user),
            emailVerifiedAt: $row->email_verified_at,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
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
            typeUser: TypeUser::tryFromByName($row->type_user),
            emailVerifiedAt: $row->email_verified_at,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
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
            typeUser: TypeUser::tryFromByName($row->type_user),
            emailVerifiedAt: $row->email_verified_at,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
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
            $row = $row->where('name', 'LIKE', "$name%");
        }

        if ($email) {
            $row = $row->where('email', 'LIKE', "$email%");
        }

        if ($phone) {
            $row = $row->where('phone', 'LIKE', "$phone%");
        }

        if ($cpf) {
            $row = $row->where('cpf', 'LIKE', "$cpf%");
        }

        if ($active) {
            $row = $row->where('active', (int) $active);
        }

        return $row->orderBy('updated_at', 'desc')->paginate(10)->toArray();
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
            typeUser: TypeUser::tryFromByName($row->type_user),
            emailVerifiedAt: $row->email_verified_at,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }

    public function cpfOrEmailOrPhoneExistDuplicate(
        ?int $id,
        ?string $cpf,
        ?string $email,
        ?string $phone
    ): void {
        if (
            $this->db::where('active', Active::ACTIVE->value)
            ->where('id', '<>', $id)
            ->where('cpf', $cpf)
            ->withTrashed()
            ->first()
        ) {
            throw new Exception('Documento já cadastrado');
        }

        if (
            $this->db::where('active', Active::ACTIVE->value)
            ->where('id', '<>', $id)
            ->where('email', $email)
            ->withTrashed()
            ->first()
        ) {
            throw new Exception('E-mail já cadastrado');
        }

        if (
            $this->db::where('active', Active::ACTIVE->value)
            ->where('id', '<>', $id)
            ->where('phone', $phone)
            ->withTrashed()
            ->first()
        ) {
            throw new Exception('Número de telefone já cadastrado');
        }
    }

    public function findByEmailTryFrom(string $email): User
    {
        $row = $this->db::where('email', $email)->first();

        if (!$row) {
            throw new Exception('E-mail não encontrado');
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
            typeUser: TypeUser::tryFromByName($row->type_user),
            emailVerifiedAt: $row->email_verified_at,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
