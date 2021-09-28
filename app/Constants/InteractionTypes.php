<?php

namespace App\Constants;

use ReflectionClass;

class InteractionTypes
{
    public const LIKE = 'like';

    static function getValues(): array
    {
        $class = new ReflectionClass(get_called_class());
        return array_values($class->getConstants());
    }
}
