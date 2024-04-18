<?php

namespace App\Domain\Enum;

enum TypeUser: string
{
    case ADMIN = 'ADMIN';
    case USER = 'USER';
    case EMPLOYEE = 'EMPLOYEE';

    static public function allTypeUser(): array
    {
        return [
            self::ADMIN->value,
            self::USER->value,
            self::EMPLOYEE->value,
        ];
    }
}
