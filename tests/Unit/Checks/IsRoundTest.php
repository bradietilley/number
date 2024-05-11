<?php

use BradieTilley\Number\Number;

test('Number can check if it is round', function (string $input, bool $expect) {
    $result = Number::of($input)->isRound();

    expect($result)->toBe($expect);
})->with([
    ['123.45', false],
    ['-25.94', false],
    ['3', true],
    ['6.0', true],
    ['4.00000000000', true],
    ['9.00000000001', false],
]);
