<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\Infrastructure\Entity\UserEntityInterface;
use App\Domain\Admin\ValueObjects\Id;
use App\Models\User as EntityUser;

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
            emailVerifiedAt: $user->getEmailVerifiedAt(),
            createdAt: $user->getCreatedAt(),
            updatedAt: $user->getUpdatedAt(),
            deletedAt: $user->getDeletedAt(),
        );
    }

    public function delete(?int $id): bool
    {
        $this->db::where('id', $id)->delete();
        return true;
    }
}
