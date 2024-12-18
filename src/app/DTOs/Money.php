<?php

namespace App\DTOs;

class Money
{
    const string CURRENCY = 'EUR';

    public static function toCents(int $price): int
    {
        return $price * 1000;
    }

    public static function calculatePriceWithDiscount($price, $discountPercentage): int
    {
        return $price - ($price * ($discountPercentage / 100));
    }
}
