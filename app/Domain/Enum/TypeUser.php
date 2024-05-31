<?php

namespace App\Domain\Enum;

use ReflectionEnum;

enum TypeUser: string
{
    case ADMIN = 'ADMIN';
    case USER = 'USER';
    case EMPLOYEE = 'EMPLOYEE';

    static public function getEnum(): array
    {
        return array_values(array_map(fn ($value) => $value->value,(new ReflectionEnum(get_class()))->getConstants()));
    }

    static public function getEnumName(): array
    {
        return array_values(array_map(fn ($value) => $value->name,(new ReflectionEnum(get_class()))->getConstants()));
    }

    static public function tryFromByName(?string $enum): ?self
    {
        if (!$enum) {
            return null;
        }

        $enum = array_filter(self::getEnumName(), fn ($value, $key) => $value === $enum , ARRAY_FILTER_USE_BOTH);

        if (empty($enum)) {
            return null;
        }

        return (new ReflectionEnum(get_class()))->getConstant(reset($enum));
    }
}
