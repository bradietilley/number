<?php

namespace BradieTilley\Number;

/**
 * @mixin Number
 */
trait HasShortcuts
{
    public const PI = '3.1415926535897932384626433832795028841971693993751';

    public const E = '2.71828182845904523536028747135266249775724709369995';

    /**
     * Get zero as a number
     */
    public static function zero(): static
    {
        return static::of(0);
    }

    /**
     * Get 1 as a number
     */
    public static function one(): static
    {
        return static::of(1);
    }

    /**
     * Get pi constant
     */
    public static function pi(): static
    {
        return static::of(static::PI);
    }

    /**
     * Get Euler's constant
     */
    public static function e(): static
    {
        return static::of(static::E);
    }
}
