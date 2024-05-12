<?php

namespace BradieTilley\Number;

use Exception;

/**
 * @mixin Number
 */
trait HasModifications
{
    public function abs(): static
    {
        return static::of($this->toAbsoluteString());
    }

    public function toScale(int $scale): static
    {
        [$whole, $decimal] = static::parseFragments($this->value);
        $decimal = str_pad($decimal, $scale, static::ZERO, STR_PAD_RIGHT);

        $number = $whole.static::DECIMAL_SEPARATOR.$decimal;

        return static::of($number);
    }

    public function raiseTenfold(Number|BCNumber|string|int $times = 1): static
    {
        $times = static::of($times);

        if ($times->hasDecimal()) {
            throw new Exception('Raise Tenfold does not accept decimal values');
        }

        $times = static::of(static::TEN)->pow($times, 0, 0);

        return $this->mul($times);
    }

    public function reduceTenfold(Number|BCNumber|string|int $times = 1, ?int $scale = null): static
    {
        $times = static::of($times);

        if ($times->hasDecimal()) {
            throw new Exception('Raise Tenfold does not accept decimal values');
        }

        $times = static::of(static::TEN)->pow($times, 0, 0);

        return $this->div($times, $scale);
    }
}
