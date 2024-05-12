<?php

namespace BradieTilley\Number;

use BCMath\Number as BCNumber;

/**
 * @mixin Number
 */
trait HasStatistics
{
    public static function sum(Number|BCNumber|string|int ...$numbers): static
    {
        /** @var static $total */
        $total = array_reduce(
            $numbers,
            fn (Number $total, Number|BCNumber|string|int $num) => $total->add($num),
            static::zero()
        );

        return $total;
    }

    public static function maxScale(Number|BCNumber|string|int ...$numbers): int
    {
        /** @var int $max */
        $max = array_reduce(
            $numbers,
            fn (int $max, Number|BCNumber|string|int $num) => (int) max($max, static::of($num)->scale), /** @phpstan-ignore-line */
            0,
        );

        return $max;
    }

    public static function minScale(Number|BCNumber|string|int ...$numbers): int
    {
        /** @var ?int $min */
        $min = array_reduce(
            $numbers,
            fn (?int $min, Number|BCNumber|string|int $num) => (int) min($min ?? INF, static::of($num)->scale), /** @phpstan-ignore-line */
            null,
        );

        return $min === null ? 0 : $min;
    }

    public static function mean(Number|BCNumber|string|int ...$numbers): static
    {
        $scale = static::maxScale(...$numbers);

        $count = count($numbers);
        $sum = static::sum(...$numbers);

        return $sum->div($count)->clean($scale);
    }

    public static function median(Number|BCNumber|string|int ...$numbers): static
    {
        /** Standardise */
        $numbers = array_map(
            fn (Number|BCNumber|string|int $num) => static::of($num)->value,
            $numbers,
        );

        /** Sort natural order */
        natsort($numbers);
        $numbers = array_values($numbers);

        /**
         * Find middle
         */
        $count = count($numbers);
        $middle = floor($count / 2);

        if ($count % 2 === 1) {
            return static::of($numbers[$middle]);
        }

        return static::of($numbers[$middle - 1])->add($numbers[$middle])->div(2);
    }

    public static function minimum(Number|BCNumber|string|int ...$numbers): static
    {
        $last = array_pop($numbers);
        $start = static::of($last);

        $min = array_reduce(
            $numbers,
            fn (Number $min, Number|BCNumber|string|int $num) => $min->min($num),
            $start,
        );

        return $min;
    }

    public static function maximum(Number|BCNumber|string|int ...$numbers): static
    {
        $first = static::of(array_pop($numbers));

        $min = array_reduce(
            $numbers,
            fn (Number $min, Number|BCNumber|string|int $num) => $min->max($num),
            $first,
        );

        return $min;
    }

    public function min(Number|BCNumber|string|int $num): static
    {
        return $this->lt($num) ? $this : static::of($num);
    }

    public function max(Number|BCNumber|string|int $num): static
    {
        return $this->gt($num) ? $this : static::of($num);
    }
}
