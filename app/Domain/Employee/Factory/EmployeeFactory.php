<?php

namespace App\Domain\Employee\Factory;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Employee\Entity\Employee;
use App\Domain\Enum\Active;

class EmployeeFactory
{
    static function createEmployeeWithDataUser(
        User $user,
        Id $establishmentId,
        string $registration,
        string $password
    ): Employee {
        return new Employee(
            id: null,
            userId: $user->getId(),
            establishmentId: $establishmentId,
            registration: $registration,
            name: $user->getName(),
            email: $user->getEmail(),
            active: Active::ACTIVE,
            admin: Active::ACTIVE,
            emailVerifiedAt: null,
            password: $password,
            createdAt: now(),
            updatedAt: now(),
            deletedAt: null,
        );
    }
}
