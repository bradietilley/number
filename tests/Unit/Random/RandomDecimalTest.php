<?php

use BradieTilley\Number\Number;

test('Number can generate a random number between two decimals', function (string $min, string $max) {
    $random = Number::randomDecimal($min, $max);

    $result = $random->gte($min) && $random->lte($max);
    expect($result)->toBe(true);
})->with([
    ['1.001', '1.004'],
    ['1.003', '1.0040000000000009'],
    ['1.0000000000000000000000000000000010', '1.0000000000000000000000000000000020'],
    ['1.0000000000000000000000000000000010', '9.9999999999999999999999999999999999'],
]);
