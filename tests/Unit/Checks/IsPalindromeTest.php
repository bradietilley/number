<?php

use BradieTilley\Number\Number;

test('Number can check if it is a palindrome', function (string $input, bool $expect) {
    $result = Number::of($input)->isPalindrome();

    expect($result)->toBe($expect);
})->with([
    ['1', true],
    ['66', true],
    ['121', true],
    ['1661', true],
    ['34543', true],
    ['34.543', true],
    ['3455.43', true],
    ['345943', false],
    ['3453423', false],
    ['345.3423', false],
]);
