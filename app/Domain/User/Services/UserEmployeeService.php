<?php

namespace App\Domain\User\Services;

use App\Domain\Employee\Entity\Employee;
use App\Domain\Employee\Services\EmployeeService;

class UserEmployeeService
{
    public function __construct(
        private EmployeeService $employeeService
    ) {
    }

    public function createEmployee(
        Employee $employee,
        string $password
    ) {
        $this->employeeService->createEmployee($employee, $password);
    }
}
