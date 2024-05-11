<?php

namespace BradieTilley\Number;

use BCMath\Number as BCNumber;
use Stringable;

class Number implements Stringable
{
    use ForwardsCalls;
    use HasOutputTo;
    use HasShortcuts;
    use HasCounting;
    use HasChecks;

    public const NEGATIVE_SYMBOL = '-';

    public const DECIMAL_SEPARATOR = '.';

    public const ZERO = 0;

    public const ONE = 1;

    public BCNumber $number;

    public function __construct(Number|BCNumber|string|int $num)
    {
        $this->number = new BCNumber((string) $num);
    }

    public static function of(Number|BCNumber|string|int $num): static
    {
        if ($num instanceof static) {
            return $num;
        }

        $num = ($num instanceof self) ? $num->number : $num;

        /** @phpstan-ignore-next-line */
        return new static((string) $num);
    }

    public function __toString(): string
    {
        return (string) $this->number;
    }
}
