<?php

namespace App\Infrastructure\Repository;

use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Employee\Entity\Employee;
use App\Domain\Employee\Infrastructure\Repository\EmployeeRepositoryInterface;
use App\Domain\Enum\Active;
use App\Models\Employee as ModelsEmployee;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(
        private ModelsEmployee $db
    ) {
    }

    public function getByRegistration(string $registration): ?Employee
    {
        $row = $this->db::where('registration', $registration)->first();

        if (!$row) {
            return null;
        }

        return new Employee(
            id: new Id($row->id),
            userId: new Id($row->user_id),
            establishmentId: new Id($row->establishment_d),
            registration: $row->registration,
            name: $row->name,
            email: $row->email,
            active: Active::tryFrom($row->active),
            admin: Active::tryFrom($row->admin),
            emailVerifiedAt: $row->email_verified_at,
            password: $row->password,
            createdAt: $row->created_at?->format('Y-m-d H:m:s'),
            updatedAt: $row->updated_at?->format('Y-m-d H:m:s'),
            deletedAt: $row->deleted_at?->format('Y-m-d H:m:s'),
        );
    }
}
