<?php

namespace App\Domain\Employee\Services;

use App\Domain\Admin\Entity\User;
use App\Domain\Employee\Entity\Employee;
use App\Mail\SendEmailEmployeeCreated;
use Illuminate\Support\Facades\Mail;

class EmployeeSendingEmailService
{
    public function sendEmailEmployeeCreated(
        Employee $employee,
        string $email,
        string $password
    ): void {
        Mail::send(
            new SendEmailEmployeeCreated(
                registration: $employee->getRegistration(),
                email: $email,
                name: $employee->getName(),
                password: $password
            )
        );
    }
}
