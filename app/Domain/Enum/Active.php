<?php

namespace App\Domain\Enum;

enum Active: int
{
    use MethodsExtends;

    case ACTIVE = 1;
    case INACTIVE = 0;
}
