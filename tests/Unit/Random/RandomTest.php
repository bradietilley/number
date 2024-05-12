<?php

use BradieTilley\Number\Number;

test('Number can randomly generate a random integer', function (string $min, string $max, array $expect) {
    $random = Number::random($min, $max);
    $min = Number::of($min);
    $max = Number::of($max);

    $result = $random->gte($min) && $random->lte($max);
    expect($result)->toBe(true);

    $result = $random->in(...$expect);
    expect($result)->toBe(true);
})->with([
    ['1', '4', [1, 2, 3, 4]],
    ['-5', '-2', [-5, -4, -3, -2, -1, 0, 1, 2, 3, 4, 5]],
]);

test('Number can reverse order of arguments', function () {
    $random = Number::random(5, 3);

    $result = $random->in(3, 4, 5);
    expect($result)->toBe(true);
});
