<?php

use BradieTilley\Number\Number;

test('Number can check if it is a prime number', function (string $input, bool $expect) {
    $result = Number::of($input)->isPrime();

    expect($result)->toBe($expect);
})->with([
    ['-3', false],
    ['-2', false],
    ['-1', false],
    ['0', false],
    ['1', false],
    ['2', true],
    ['3', true],
    ['4', false],
    ['5', true],
    ['6', false],
    ['7', true],
    ['8', false],
    ['9', false],
    ['10', false],
    ['11', true],
    ['27', false],
    ['29', true],
    ['31', true],
    ['33', false],
    ['131', true],
    ['133', false],
    ['149', true],
]);
