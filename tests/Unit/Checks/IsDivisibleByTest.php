<?php

use BradieTilley\Number\Number;

test('Number can check if it is divisible by another number', function (string $number, string $num, bool $expect) {
    $result = Number::of($number)->isDivisibleBy($num);

    expect($result)->toBe($expect);
})->with([
    ['32', '8', true],   // 4
    ['32', '7', false],  // 4.5714285714
    ['33', '8', false],  // 4.125
    ['35', '5', true],   // 7
    ['35', '2.5', true], // 14
    ['35', '14', false], // 2.5
]);
