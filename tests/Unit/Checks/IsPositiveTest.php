<?php

use BradieTilley\Number\Number;

test('Number can check if it is positive', function (string $input, bool $expect) {
    $result = Number::of($input)->isPositive();

    expect($result)->toBe($expect);
})->with([
    ['-2343.03453', false],
    ['-324', false],
    ['-1', false],
    ['-0.000000000000001', false],
    ['0', true],
    ['0.000000000000001', true],
    ['1', true],
    ['324', true],
    ['2343.03453', true],
]);
