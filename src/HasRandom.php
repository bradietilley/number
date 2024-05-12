<?php

namespace BradieTilley\Number;

use BCMath\Number as BCNumber;

/**
 * @mixin Number
 */
trait HasRandom
{
    public static function random(int $min = PHP_INT_MIN, int $max = PHP_INT_MAX): static
    {
        if ($min > $max) {
            $oldMax = $max;
            $max = $min;
            $min = $oldMax;
        }

        $random = random_int($min, $max);

        return static::of($random);
    }

    public static function randomDecimal(Number|BCNumber|string|int|float $min = PHP_INT_MIN, Number|BCNumber|string|int|float $max = PHP_INT_MAX): static
    {
        $min = static::of($min);
        $max = static::of($max);

        if ($max->lt($min)) {
            $oldMax = $max;
            $max = $min;
            $min = $oldMax;
        }

        $scale = static::maxScale($min, $max);

        $min = $min->toScale($scale)->raiseTenfold($scale)->truncate();
        $max = $max->toScale($scale)->raiseTenfold($scale)->truncate();

        $random = static::random($min->toInteger(), $max->toInteger());
        $decimal = $random->reduceTenfold($scale);

        return $decimal;
    }
}
