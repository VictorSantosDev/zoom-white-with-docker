<?php

namespace App\Domain\Enum;

enum DaysOfTheWeek: string
{
    use MethodsExtends;

    case MONDAY = 'MONDAY';
    case THIRD = 'THIRD';
    case WEDNESDAY = 'WEDNESDAY';
    case THURSDAY = 'THURSDAY';
    case FRIDAY = 'FRIDAY';
    case SATURDAY = 'SATURDAY';
    case SUNDAY = 'SUNDAY';
}
