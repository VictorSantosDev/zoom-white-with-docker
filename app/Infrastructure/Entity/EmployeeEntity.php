<?php

namespace App\Infrastructure\Entity;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Employee\Entity\Employee;
use App\Domain\Employee\Infrastructure\Entity\EmployeeEntityInterface;
use App\Models\Employee as ModelsEmployee;

class EmployeeEntity implements EmployeeEntityInterface
{
    public function __construct(
        private ModelsEmployee $db
    ) {
    }

    public function create(Employee $employee): Employee
    {
        $row = $this->db::create([
            'user_id' => $employee->getUserId()?->get(),
            'establishment_id' => $employee->getEstablishmentId()?->get(),
            'registration' => $employee->getRegistration(),
            'name' => $employee->getName(),
            'email' => $employee->getEmail(),
            'active' => $employee->getActive()->value,
            'admin' => $employee->getAdmin()->value,
            'password' => $employee->getPassword(),
            'created_at' => $employee->getCreatedAt(),
            'updated_at' => $employee->getUpdatedAt(),
        ]);

        return new Employee(
            id: new Id($row->id),
            userId: $employee->getUserId(),
            establishmentId: $employee->getEstablishmentId(),
            registration: $employee->getRegistration(),
            name: $employee->getName(),
            email: $employee->getEmail(),
            active: $employee->getActive(),
            admin: $employee->getAdmin(),
            emailVerifiedAt: $employee->getEmailVerifiedAt(),
            password: $employee->getPassword(),
            createdAt: $employee->getCreatedAt(),
            updatedAt: $employee->getUpdatedAt(),
            deletedAt: null,
        );
    }
}
