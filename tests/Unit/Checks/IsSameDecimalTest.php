<?php

use BradieTilley\Number\Number;

test('Number can check if it has the same decimal fragment as another number', function (string $num, string $input, bool $expect) {
    $result = Number::of($num)->isSameDecimal($input);

    expect($result)->toBe($expect);
})->with([
    ['-11', '-1', true],
    ['10', '0', true],
    ['9', '1', true],
    ['2', '1.0', true],
    ['1', '1.01', false],
    ['1.01', '1.0100000', true],
    ['999.999', '999.99901', false],
    ['999.999', '999.99900', true],
]);
