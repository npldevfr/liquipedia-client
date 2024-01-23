<?php

namespace Npldevfr\Liquipedia\Traits;

trait HasConstants
{
    /**
     * Get all the endpoints.
     *
     * @return array<string, mixed>
     */
    public static function all(): array
    {
        return (new \ReflectionClass(self::class))->getConstants();
    }

    /**
     * Check if the value is valid.
     */
    public static function fromValue(string $value): bool
    {
        return in_array($value, self::all());
    }
}
