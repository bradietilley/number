<?php

use BradieTilley\Number\Number;

test('Number can determine the mean value', function (array $input, string $expect) {
    $result = Number::mean(...$input);

    expect($result->value)->toBe($expect);
})->with([
    [['1', '2', '6'], '3'],
    [['1.0000000002', '2.0000000007', '6.0000000009'], '3.0000000006'],
    [['1.000000000249357938475937543', '2.0000000007', '6.0000000009'], '3.0000000006164526461586458476666666667'],
]);
