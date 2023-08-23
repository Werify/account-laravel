<?php

namespace Werify\Account\Laravel\Enums\V1;

trait Enums
{
    public static function getValues(): array
    {
        return array_values(static::toArray());
    }

    public static function getKeys(): array
    {
        return array_keys(static::toArray());
    }

    public static function getLabels(): array
    {
        $items = static::toArray();
        foreach ($items as $key => $val) {
            $items[$val] = ucwords(str_replace('_', ' ', strtolower($key)));
            unset($items[$key]);
        }
        $items[null] = 'None';

        return $items;
    }

    public static function getImplodedValues($separator = ','): string
    {
        return implode($separator, self::getValues());
    }

    public static function toArray(): array
    {
        return array_map(function ($value) {
            return is_object($value) ? $value->value : $value;
        }, (new \ReflectionClass(static::class))->getConstants());
    }

    public static function toSelectArray(): array
    {
        return array_map(function ($value) {
            return is_object($value) ? $value->value : $value;
        }, (new \ReflectionClass(static::class))->getConstants());
    }

    public static function toSelectArrayWithKeys(): array
    {
        return array_map(function ($value) {
            return is_object($value) ? $value->value : $value;
        }, (new \ReflectionClass(static::class))->getConstants());
    }

    public static function toFlippedSelectArrayWithKeys(): array
    {
        return array_flip(self::toSelectArrayWithKeys());
    }
}
