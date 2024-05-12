<?php

use BradieTilley\Number\Number;

test('Number can determine the maximum number', function (array $input, string $expect) {
    $result = Number::maximum(...$input);

    expect($result->value)->toBe($expect);
})->with([
    [['123','40','234'], '234'],
    [['-84','-3','-50'], '-3'],
    [['0.000001','0.0000001','0.00000001'], '0.000001'],
]);
