<?php

it('gets a full list of product and asserts correct response structure', function () {
    $response = $this->get('/products')
        ->assertOk()
        ->assertJsonCount(5);

    $response->assertJsonStructure([
        '*' => [
            'sku',
            'name',
            'category',
            'price' => [
                'discount_percentage',
                'original',
                'final',
                'currency'
            ]
        ]
    ]);
});

it('filters products by given category', function ($category, $expectedCount) {
    $this->get('/products?category=' . $category)
    ->assertStatus(200)
        ->assertJsonCount($expectedCount);
})->with([
    ['boots', 3],
    ['sandals', 1],
    ['sneakers', 1],
]);
