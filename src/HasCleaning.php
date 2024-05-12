<?php

namespace BradieTilley\Number;

/**
 * @mixin Number
 */
trait HasCleaning
{
    public function clean(int $minScale): static
    {
        return static::of(
            static::removeSuperfluousPrecision($this->value, $minScale)
        );
    }

    public function truncate(): static
    {
        return $this->clean(0);
    }
}
