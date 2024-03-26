<?php

namespace App\Domain\Enum;

enum Active: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;
}
