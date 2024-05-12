<?php

use BradieTilley\Number\Number;

test('Number can check if it is odd', function (string $input, bool $expect) {
    $result = Number::of($input)->isOdd();

    expect($result)->toBe($expect);
})->with([
    ['-3', true],
    ['-2', false],
    ['-1', true],
    ['0', false],
    ['1', true],
    ['2', false],
    ['3', true],
    ['3.0', true],
    ['3.1', false],
]);
