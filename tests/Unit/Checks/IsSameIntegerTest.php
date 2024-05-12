<?php

use BradieTilley\Number\Number;

test('Number can check if it represents the same integer as another number', function (string $num, string $input, bool $expect) {
    $result = Number::of($num)->isSameInteger($input);

    expect($result)->toBe($expect);
})->with([
    ['-1', '-1', true],
    ['0', '0', true],
    ['1', '1', true],
    ['1', '1.0', true],
    ['1', '1.01', true],
    ['7', '7.000000000000001', true],
    ['8', '8.999999999999999', true],
    ['8', '7', false],
    ['8', '7.99999999999999', false],
    ['8', '9.00000000000001', false],
]);
