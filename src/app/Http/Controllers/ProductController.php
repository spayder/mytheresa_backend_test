<?php

namespace App\Http\Controllers;

use App\Services\DiscountService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(
        protected ProductService $productService,
        protected DiscountService $discountService,
    ) {}

    public function index(Request $request)
    {
        return $this->discountService->applyFor(
            $this->productService->getProducts()
        );
    }
}
