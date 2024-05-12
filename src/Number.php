<?php

namespace BradieTilley\Number;

use BCMath\Number as BCNumber;
use Exception;
use Stringable;

/**
 * @property-read string $value
 * @property-read int $scale
 */
class Number implements Stringable
{
    use ForwardsCalls;
    use HasOutputTo;
    use HasShortcuts;
    use HasStatistics;
    use HasChecks;
    use HasCleaning;
    use HasHelpers;
    use HasModifications;
    use HasRandom;

    public const NEGATIVE_SYMBOL = '-';

    public const DECIMAL_SEPARATOR = '.';

    public const THOUSANDS_SEPARATOR = '';

    public const ZERO = '0';

    public const ONE = '1';

    public const TEN = '10';

    public BCNumber $number;

    public function __construct(Number|BCNumber|string|int $num)
    {
        $this->number = new BCNumber((string) $num);
    }

    /**
     * @param string $name
     */
    public function __get($name): string|int
    {
        if ($name === 'value' || $name === 'scale') {
            return $this->number->{$name};
        }

        /** throw exception */
        return $this->{$name};
    }

    public static function of(Number|BCNumber|string|int|float $num): static
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

    /**
     * Parse the given number and extract the whole number and decimal number
     *
     * @return array<int, string>
     */
    public static function parseFragments(Number|BCNumber|string|int $num): array
    {
        $num = (string) $num;
        $pos = strpos($num, self::DECIMAL_SEPARATOR);
        $wholeNumber = $num;
        $decimalNumber = '';

        if ($pos !== false) {
            $wholeNumber = substr($num, 0, $pos);
            $decimalNumber = substr($num, $pos + 1);
        }

        return [
            $wholeNumber,
            $decimalNumber,
        ];
    }
}
