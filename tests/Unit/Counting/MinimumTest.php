<?php

use BradieTilley\Number\Number;

test('Number can determine the minimum number', function (array $input, string $expect) {
    $result = Number::minimum(...$input);

    expect($result->value)->toBe($expect);
})->with([
    [['123','40','234'], '40'],
    [['-34','-50','-8'], '-50'],
    [['0.000001','0.0000001','0.00000001'], '0.00000001'],
]);
