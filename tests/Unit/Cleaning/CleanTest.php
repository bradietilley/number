<?php

use BradieTilley\Number\Number;

test('Number can clean superfluous precision', function (string $input, int $scale, string $expect) {
    $result = Number::of($input)->clean($scale);

    expect($result->value)->toBe($expect);
})->with([
    ['1.0', 0, '1'],
    ['1.0', 1, '1.0'],
    ['1.0000', 0, '1'],
    ['1.0000', 1, '1.0'],
    ['1.0000', 2, '1.00'],
    ['1.0000', 10, '1.0000'],
    ['1.1', 0, '1.1'],
    ['1.1', 1, '1.1'],
    ['1.1', 2, '1.1'],
    ['1.000000001', 0, '1.000000001'],
    ['-1.000000001', 0, '-1.000000001'],
    ['-1.000000001', 5, '-1.000000001'],
    ['-1.000000000', 0, '-1'],
    ['-1.000000000', 5, '-1.00000'],
]);
