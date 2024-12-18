<?php

use App\DTOs\Money;

it('converts price to cents', function () {
    $price = 90;
    $expected = 90000;

    expect($expected)->toBe(Money::toCents($price));
});

it('calculates price with given discount', function () {
    $original = 100000;
    $discount = 25;

    expect(75000)->toBe(Money::calculatePriceWithDiscount($original, $discount));
});
