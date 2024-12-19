<?php

use Illuminate\Testing\Fluent\AssertableJson;

it('gets a full list of product and asserts correct response structure', function () {
    $this->get('/products')
        ->assertOk()
        ->assertJsonCount(5)
        ->assertJson(fn (AssertableJson $json) => $json->each(
            fn (AssertableJson $json) => $json->has('sku')
            ->has('name')
                ->has('category')
                ->has('price')
                ->has('price.discount_percentage')
                ->has('price.original')
                ->has('price.final')
                ->has('price.currency')
        ));
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
