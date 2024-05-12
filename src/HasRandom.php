<?php

namespace BradieTilley\Number;

use BCMath\Number as BCNumber;

/**
 * @mixin Number
 */
trait HasRandom
{
    public const RANDOM_NUMBER_SCALE = 100;

    public static function random(Number|BCNumber|string|int|float $min = PHP_INT_MIN, Number|BCNumber|string|int|float $max = PHP_INT_MAX): static
    {
        $min = static::of($min)->round();
        $max = static::of($max)->round();

        if ($min->gt($max)) {
            $oldMax = $max;
            $max = $min;
            $min = $oldMax;
        }

        if ($min->isIntegerSafe() && $max->isIntegerSafe()) {
            $min = $min->toInteger();
            $max = $max->toInteger();

            return static::of(random_int($min, $max));
        }

        $range = $max->sub($min)->raiseTenfold();
        $random = '0.';

        foreach (range(1, static::RANDOM_NUMBER_SCALE) as $i) {
            $random .= random_int(0, 9);
        }

        $offset = $range->mul($random, static::RANDOM_NUMBER_SCALE)->reduceTenfold();
        $random = $min->add($offset, 0);

        return $random;
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

        $random = static::random($min, $max);
        $decimal = $random->reduceTenfold($scale, $scale);

        return $decimal;
    }
}
