<?php

namespace App\Domain\Employee\Infrastructure\Repository;

use App\Domain\Employee\Entity\Employee;

interface EmployeeRepositoryInterface
{
    public function getByRegistration(string $registration): ?Employee;
}
