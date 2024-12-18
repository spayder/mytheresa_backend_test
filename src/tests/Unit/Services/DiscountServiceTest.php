<?php

use App\Services\DiscountService;

it('applies discount for a product by category', function () {
    $products = collect([[
        'sku' => '000001',
        'name' => 'BV Lean leather ankle boots',
        'category' => 'boots',
        'price' => 89000,
    ],
        [
            "sku" => "000005",
            "name" => "Nathane leather sneakers",
            "category" => "sneakers",
            "price" => 59000,
        ]]);

    $discountService = app(DiscountService::class);
    $productsWithDiscount = $discountService->applyFor($products);

    expect($productsWithDiscount[0]['price']['discount_percentage'])->toBe(30)
        ->and($productsWithDiscount[1]['price']['discount_percentage'])->toBeNull();
});
