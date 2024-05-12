<?php

namespace BradieTilley\Number;

/**
 * @mixin Number
 */
trait HasCleaning
{
    /**
     * Remove trailing zero decimals down to the given min scale
     */
    public function clean(int $minScale): static
    {
        return static::of(
            static::removeSuperfluousPrecision($this->value, $minScale)
        );
    }

    /**
     * Remove trailing zero decimals
     */
    public function truncate(): static
    {
        return $this->clean(0);
    }
}
