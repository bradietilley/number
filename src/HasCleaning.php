<?php

namespace BradieTilley\Number;

/**
 * @mixin Number
 */
trait HasCleaning
{
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

    public function clean(int $minScale): static
    {
        return static::of(
            static::removeSuperfluousPrecision($this->value, $minScale)
        );
    }
}
