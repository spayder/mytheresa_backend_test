<?php

it('gets a full list of product', function () {
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

it('filters products by given category', function () {
    $this->get('/products?category=boots')
    ->assertStatus(200)
        ->assertJsonCount(3);
});
