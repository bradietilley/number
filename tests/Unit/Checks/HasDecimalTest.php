<?php

use BradieTilley\Number\Number;

test('Number can check if it has decimals', function (string $input, bool $expect) {
    $result = Number::of($input)->hasDecimal();

    expect($result)->toBe($expect);
})->with([
    ['12', false],
    ['12.0', true],
    ['-324', false],
    ['-43534.0', true],
    ['-43534.32479', true],
]);
