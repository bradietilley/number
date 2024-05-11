<?php

use BradieTilley\Number\Number;

test('Number wraps BCMath\Number', function () {
    $num = new Number(89753976423);

    expect($num->toString())->toBe('89753976423');
});
