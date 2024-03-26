<?php

namespace App\Domain\Enum;

enum TypeEstablishment: string
{
    case CAR_WASH = 'CAR_WASH';
    case PARKING = 'PARKING';
    case CAR_WASH_AND_PARKING = 'CAR_WASH_AND_PARKING';
}
