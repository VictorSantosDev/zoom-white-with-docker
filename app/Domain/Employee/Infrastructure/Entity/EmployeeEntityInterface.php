<?php

namespace App\Domain\Employee\Infrastructure\Entity;

use App\Domain\Employee\Entity\Employee;

interface EmployeeEntityInterface
{
    public function create(Employee $employee): Employee;
}
