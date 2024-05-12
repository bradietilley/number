<?php

use BradieTilley\Number\Number;

test('Number can determine the median value', function (array $input, string $expect) {
    $result = Number::median(...$input);

    expect($result->value)->toBe($expect);
})->with([
    [['1', '2', '6'], '2'],
    [['1.0000000002', '2.0000000007', '6.0000000009'], '2.0000000007'],
    [['1.000000000249357938475937543', '2.0000000007', '6.0000000009'], '2.0000000007'],
    [['1','16','8','34','23','77','88','7','5.5','30','22','43','19'], '22'],
    [['-5', '99', '0'], '0'],
]);
