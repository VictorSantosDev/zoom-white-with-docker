<?php

namespace App\Domain\Employee\Services;

use App\Domain\Admin\Entity\User;
use App\Domain\Admin\ValueObjects\Id;
use App\Domain\Employee\Entity\Employee;
use App\Domain\Employee\Factory\EmployeeFactory;
use App\Domain\Employee\Infrastructure\Entity\EmployeeEntityInterface;
use App\Domain\Employee\Infrastructure\Repository\EmployeeRepositoryInterface;
use Exception;
use Illuminate\Support\Str;

class EmployeeService
{
    public function __construct(
        private EmployeeEntityInterface $employeeEntity,
        private EmployeeRepositoryInterface $employeeRepository,
        private EmployeeSendingEmailService $employeeSendingEmailService
    ) {
    }

    public function createEmployeeAdmin(User $user, Id $establishmentId)
    {
        $registration = $this->generateEgistration();
        $symbol = ['@', '#', '$', '&'];
        $password = Str::random(4) . $symbol[rand(0, 3)] . Str::random(3);

        $employeeFactory = EmployeeFactory::createEmployeeWithDataUser(
            user: $user,
            establishmentId: $establishmentId,
            registration: $registration,
            password: password_hash($password, PASSWORD_DEFAULT),
        );

        $employeeCreated = $this->employeeEntity->create($employeeFactory);

        $this->employeeSendingEmailService->sendEmailEmployeeCreated(
            employee: $employeeCreated,
            email: $user->getEmail(),
            password: $password
        );
        dd('passou');
        return $employeeCreated;
    }

    private function generateEgistration(): string
    {
        $registration = (string) rand(0000000, 9999999);

        while ($this->employeeRepository->getByRegistration($registration) instanceof Employee) {
            $registration = (string) rand(0000000, 9999999);
        };

        return $registration;
    }
}
