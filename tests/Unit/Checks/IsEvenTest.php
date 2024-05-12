<?php

use BradieTilley\Number\Number;

test('Number can check if it is even', function (string $input, bool $expect) {
    $result = Number::of($input)->isEven();

    expect($result)->toBe($expect);
})->with([
    ['-3', false],
    ['-2', true],
    ['-1', false],
    ['0', true],
    ['1', false],
    ['2', true],
    ['3', false],
    ['4', true],
    ['4.0', true],
    ['4.1', false],
]);
