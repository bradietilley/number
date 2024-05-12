<?php

use BradieTilley\Number\Number;

test('Number can sum various numbers together', function (array $input, string $expect) {
    $result = Number::sum(...$input);

    expect($result->value)->toBe($expect);
})->with([
    [['1','2','3'], '6'],
    [['1.1', '2.2', '3.3'], '6.6'],
    [['1.294675', '4.3'], '5.594675'],
    [['9999999.999999999999999999999998', '0.000000000000000000000001'], '9999999.999999999999999999999999'],
    [['9999999.999999999999999999999998', '0.000000000000000000000002'], '10000000.000000000000000000000000'],
]);
