<?php

namespace App\Domain\Enum;

enum TypeUser: string
{
    use MethodsExtends;

    case ADMIN = 'ADMIN';
    case USER = 'USER';
    case EMPLOYEE = 'EMPLOYEE';
}
