<?php

namespace BradieTilley\Number;

/**
 * @mixin Number
 */
trait HasModifications
{
    public function abs(): static
    {
        return static::of($this->toAbsoluteString());
    }
}
