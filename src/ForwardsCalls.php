<?php

namespace BradieTilley\Number;

use BCMath\Number as BCNumber;

/**
 * @mixin Number
 */
trait ForwardsCalls
{
    public function add(Number|BCNumber|string|int $num, ?int $scale = null, int $roundingMode = PHP_ROUND_HALF_UP): static
    {
        return static::of($this->number->add($num, $scale, $roundingMode));
    }

    public function sub(Number|BCNumber|string|int $num, ?int $scale = null, int $roundingMode = PHP_ROUND_HALF_UP): static
    {
        return static::of($this->number->sub($num, $scale, $roundingMode));
    }

    public function mul(Number|BCNumber|string|int $num, ?int $scale = null, int $roundingMode = PHP_ROUND_HALF_UP): static
    {
        return static::of($this->number->mul($num, $scale, $roundingMode));
    }

    public function div(Number|BCNumber|string|int $num, ?int $scale = null, int $roundingMode = PHP_ROUND_HALF_UP): static
    {
        return static::of($this->number->div($num, $scale, $roundingMode));
    }

    public function mod(Number|BCNumber|string|int $num, ?int $scale = null, int $roundingMode = PHP_ROUND_HALF_UP): static
    {
        return static::of($this->number->mod($num, $scale, $roundingMode));
    }

    public function powmod(Number|BCNumber|string|int $exponent, Number|BCNumber|string|int $modulus): static
    {
        return static::of($this->number->powmod($exponent, $modulus));
    }

    public function pow(Number|BCNumber|string|int $exponent, int $minScale, ?int $scale = null, int $roundingMode = PHP_ROUND_HALF_UP): static
    {
        return static::of($this->number->pow($exponent, $minScale, $scale, $roundingMode));
    }

    public function sqrt(?int $scale = null, int $roundingMode = PHP_ROUND_HALF_UP): static
    {
        return static::of($this->number->sqrt($scale, $roundingMode));
    }

    public function floor(): static
    {
        return static::of($this->number->floor());
    }

    public function ceil(): static
    {
        return static::of($this->number->ceil());
    }

    public function round(int $precision = 0, int $mode = PHP_ROUND_HALF_UP): static
    {
        return static::of($this->number->round($precision, $mode));
    }

    public function comp(Number|BCNumber|string|int $num, ?int $scale = null): int
    {
        return $this->number->comp($num, $scale);
    }

    public function eq(Number|BCNumber|string|int $num, ?int $scale = null): bool
    {
        return $this->number->eq($num, $scale);
    }

    public function gt(Number|BCNumber|string|int $num, ?int $scale = null): bool
    {
        return $this->number->gt($num, $scale);
    }

    public function gte(Number|BCNumber|string|int $num, ?int $scale = null): bool
    {
        return $this->number->gte($num, $scale);
    }

    public function lt(Number|BCNumber|string|int $num, ?int $scale = null): bool
    {
        return $this->number->lt($num, $scale);
    }

    public function lte(Number|BCNumber|string|int $num, ?int $scale = null): bool
    {
        return $this->number->lte($num, $scale);
    }

    public function format(?int $scale = null, int $roundingMode = PHP_ROUND_HALF_UP, string $decimalSeparator = Number::DECIMAL_SEPARATOR, string $thousandsSeparator = Number::THOUSANDS_SEPARATOR): string
    {
        return $this->format($scale, $roundingMode, $decimalSeparator, $thousandsSeparator);
    }

    public function __toString(): string
    {
        return (string) $this->number;
    }
}
