<?php

use BradieTilley\Number\Number;

test('Number can create numbers using shortcuts', function (string $method, string $expect) {
    $result = Number::{$method}();

    expect($result->value)->toBe($expect);
})->with([
    ['pi', Number::PI],
    ['e', Number::E],
    ['zero', (string) Number::ZERO],
    ['one', (string) Number::ONE],
]);
