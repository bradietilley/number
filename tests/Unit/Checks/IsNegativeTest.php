<?php

use BradieTilley\Number\Number;

test('Number can check if it is negative', function (string $input, bool $expect) {
    $result = Number::of($input)->isNegative();

    expect($result)->toBe($expect);
})->with([
    ['-2343.03453', true],
    ['-324', true],
    ['-1', true],
    ['-0.000000000000001', true],
    ['0', false],
    ['0.000000000000001', false],
    ['1', false],
    ['324', false],
    ['2343.03453', false],
]);
