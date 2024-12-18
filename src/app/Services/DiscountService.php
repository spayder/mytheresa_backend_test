<?php
declare(strict_types=1);

namespace App\Services;

use App\DTOs\Money;
use Illuminate\Support\Collection;

class DiscountService
{
    private function currentDiscounts(): array
    {
        return [
            'category' => [
                'boots' => 30
            ],
            'sku' => [
                '000003' => 15
            ]
        ];
    }

    public function applyFor(collection $products): Collection
    {
        return $products->map(function($product) {
            $discount = $this->getDiscountFor($product);
            $original = $product['price'];
            $product['price'] = [
                'discount_percentage' => $discount,
                'original' => $original,
                'final' => Money::calculatePriceWithDiscount($original, $discount),
                'currency' => Money::CURRENCY
            ];

            return $product;
        });
    }

    private function getDiscountFor(array $product)
    {
        $discounts = [];
        foreach ($this->currentDiscounts() as $type => $discount) {
            if (isset($discount[$product[$type]])) {
                $discounts[] = $discount[$product[$type]];
            }
        }

        return empty($discounts) ? null : max($discounts);
    }
}
