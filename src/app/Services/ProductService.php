<?php
declare(strict_types=1);

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Collection;

class ProductService
{
    public function __construct(
        protected ProductRepository $productRepository,
    ) {}

    public function getProducts(): Collection
    {
        return $this->productRepository->all();
    }
}
