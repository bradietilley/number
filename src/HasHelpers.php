<?php

namespace BradieTilley\Number;

/**
 * @mixin Number
 */
trait HasHelpers
{
    /**
     * Determine the scale of a number string by counting the number
     * of digits to the right of the period.
     *
     * This does not exist in the RFC and is therefore protected.
     */
    protected static function determineScale(Number|string|int $value): int
    {
        $value = (string) $value;
        $pos = strrchr($value, Number::DECIMAL_SEPARATOR);

        if ($pos === false) {
            return 0;
        }

        return strlen(substr($pos, 1));
    }

    /**
     * Round off the given number ($num) to the given $scale (or computed
     * scale) using the given rounding mode.
     *
     * The number is rounded off to the temporary scale (20) and is then
     * rounded off to the appropriate scale and returned in string form.
     *
     * This does not exist in the RFC and is therefore protected.
     *
     * @param int<1, 4> $roundingMode
     */
    protected static function roundTo(Number|string|int $num, ?int $scale, int $roundingMode): string
    {
        $num = (string) $num;
        $scale ??= self::determineScale($num);

        [$wholeNumber, $decimalNumber] = self::parseFragments($num);

        $decimalFixed = substr($decimalNumber, 0, $scale - 1);
        $decimalRounding = substr($decimalNumber, $scale - 1);

        if ($decimalRounding === '') {
            return bcdiv($num, Number::ONE, $scale);
        }

        $negative = str_starts_with($wholeNumber, Number::NEGATIVE_SYMBOL) ? Number::NEGATIVE_SYMBOL : '';
        $decimalRounding = $negative.substr($decimalRounding, 0, 1).Number::DECIMAL_SEPARATOR.substr($decimalRounding, 1);
        $decimalRounding = (float) $decimalRounding;

        $rounded = (string) round($decimalRounding, 0, $roundingMode);
        $rounded = ltrim($rounded, Number::NEGATIVE_SYMBOL);

        $rounded = $wholeNumber.Number::DECIMAL_SEPARATOR.$decimalFixed.$rounded;
        $rounded = bcdiv($rounded, Number::ONE, $scale);

        return $rounded;
    }

    /**
     * Round the given value to the provide scale or calculated scale.
     *
     * @param int<1, 4> $roundingMode
     */
    protected static function rounded(Number|string|int $num, ?int $scale, int $roundingMode): static
    {
        $rounded = self::roundTo($num, $scale, $roundingMode);

        return static::of($rounded);
    }

    /**
     * Format the given number with the given configuration
     */
    protected static function formatTo(Number|string|int $num, string $decimalSeparator = Number::DECIMAL_SEPARATOR, string $thousandsSeparator = Number::THOUSANDS_SEPARATOR): string
    {
        $num = (string) $num;

        [$wholeNumber, $decimalNumber] = static::parseFragments($num);

        $wholeNumber = strrev($wholeNumber);
        $pending = '';

        for ($i = 0; $i < strlen($wholeNumber); $i++) {
            $char = $wholeNumber[$i];

            if ($char === Number::NEGATIVE_SYMBOL) {
                $pending .= $char;

                break;
            }

            if ($i > 0 && $i % 3 === 0) {
                $pending .= $thousandsSeparator;
            }

            $pending .= $char;
        }

        $wholeNumber = strrev($pending);

        return $wholeNumber.$decimalSeparator.$decimalNumber;
    }

    /**
     * Parse the given number and extract the whole number and decimal number
     *
     * @return array<int, string>
     */
    protected static function parseFragments(Number|string|int $num): array
    {
        $num = (string) $num;
        $pos = strpos($num, Number::DECIMAL_SEPARATOR);
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

    /**
     * Certain mathematical equations are performed with a temp scale (20) to ensure no
     * decimal points are lost. However this adds a huge trailing decimal string of many
     * zeros. Because the precision of the equation's final output may be influenced by
     * whether or not the computed number needs a high precision, we will remove any of
     * the trailing decimal zeros down, to the minimum scale provided, to allow us to
     * later determine the true precision/scale of the number.
     *
     * E.g.
     *      "3.00"                  with scale 0             -> "3"
     *      "3.00"                  with scale 2             -> "3.00"
     *      "3.45"                  with scale 2             -> "3.45"
     *      "3.4500000000000"       with scale 2             -> "3.45"
     *      "3.4500000000000"       with scale 4             -> "3.4500"
     *      "3.4543789543987"       with scale 4             -> "3.454378954398753453"
     */
    protected static function removeSuperfluousPrecision(string $num, int $minScale): string
    {
        [$wholeNumber, $decimalNumber] = self::parseFragments($num);

        if ($decimalNumber === '') {
            return $wholeNumber;
        }

        $decimalKeep = substr($decimalNumber, 0, $minScale);

        $decimalTail = substr($decimalNumber, $minScale);
        $decimalTail = rtrim($decimalTail, Number::ZERO);

        if ($minScale === 0 && $decimalTail === '') {
            return $wholeNumber;
        }

        return $wholeNumber.Number::DECIMAL_SEPARATOR.$decimalKeep.$decimalTail;
    }
}
