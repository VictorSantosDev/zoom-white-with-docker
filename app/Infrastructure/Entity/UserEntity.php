<?php

declare(strict_types=1);

namespace App\Infrastructure\Entity;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\Infrastructure\Entity\UserEntityInterface;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Enum\Active;
use App\Domain\Enum\TypeUser;
use App\Models\User as EntityUser;
use Exception;

class UserEntity implements UserEntityInterface
{
    public function __construct(
        private EntityUser $db
    ) {
    }

    public function create(User $user): User
    {
        $row = $this->db::create([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
            'phone' => $user->getPhone(),
            'active' => $user->getActive()->value,
            'cpf' => $user->getCpf(),
            'birthDate' => $user->getBirthDate(),
            'password' => password_hash($user->getPassword(), PASSWORD_DEFAULT),
            'type_user' => $user->getTypeUser()->value,
            'emailVerifiedAt' => $user->getEmailVerifiedAt(),
            'created_at' => $user->getCreatedAt(),
            'updated_at' => $user->getUpdatedAt(),
            'deleted_at' => $user->getDeletedAt(),
        ]);

        return new User(
            id: new Id($row->id),
            name: $user->getName(),
            email: $user->getEmail(),
            phone: $user->getPhone(),
            active: $user->getActive(),
            cpf: $user->getCpf(),
            birthDate: $user->getBirthDate(),
            password: $user->getPassword(),
            typeUser: $user->getTypeUser(),
            emailVerifiedAt: $user->getEmailVerifiedAt(),
            createdAt: $user->getCreatedAt(),
            updatedAt: $user->getUpdatedAt(),
            deletedAt: $user->getDeletedAt(),
        );
    }

    public function update(User $user): User
    {
        $row = $this->db::where('id', $user->getId()->get())->where('active', 1)->first();

        $row->name = $user->getName();
        $row->email = $user->getEmail();
        $row->phone = $user->getPhone();
        $row->active = $user->getActive()->value;
        $row->cpf = $user->getCpf();
        $row->birthDate = $user->getBirthDate();
        $row->type_user = $user->getTypeUser()->value;
        $row->updated_at = $user->getUpdatedAt();
        $row->save();

        return new User(
            id: new Id($row->id),
            name: $user->getName(),
            email: $user->getEmail(),
            phone: $user->getPhone(),
            active: $user->getActive(),
            cpf: $user->getCpf(),
            birthDate: $user->getBirthDate(),
            password: $user->getPassword(),
            typeUser: $user->getTypeUser(),
            emailVerifiedAt: $user->getEmailVerifiedAt(),
            createdAt: $user->getCreatedAt(),
            updatedAt: $user->getUpdatedAt(),
            deletedAt: $user->getDeletedAt(),
        );
    }

    public function delete(int $id): bool
    {
        $delete = $this->db::where('id', $id)->delete();

        if ($delete === 0) {
            throw new Exception('Não foi possível excluir esse usuário');
        }

        return true;
    }

    public function updateTypeUser(int $id, TypeUser $typeUser): User
    {
        $row = $this->db::where('id', $id)->first();

        if (!$row) {
            throw new Exception('Usuário não encontrado');
        }

        $row->type_user = $typeUser->value;
        $row->save();

        return new User(
            id: new Id($row->id),
            name: $row->name,
            email: $row->email,
            phone: $row->phone,
            active: Active::tryFrom($row->active),
            cpf: $row->cpf,
            birthDate: $row->birthDate,
            password: $row->password,
            typeUser: TypeUser::tryFrom($row->type_user),
            emailVerifiedAt: $row->email_verified_at,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
