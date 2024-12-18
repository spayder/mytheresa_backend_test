<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface
{
    protected ?Product $model = null;

    public function __construct()
    {
        $this->model = new Product();
    }

    public function all(): Collection
    {
        return $this->model->getProducts();
    }
}
