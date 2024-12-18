<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    protected $perPage = 5;

    /**
     * @var Collection
     */
    protected mixed $products;

    public function getProducts(): Collection
    {
        $products = $this->getAll()
            ->applyFilters()
            ->chunk($this->perPage);

        if (! request()->has('page')) {
            $page = 1;
        } else {
            $page = request()->page;
        }

        return $products[$page - 1]->values();
    }

    private function getAll(): Product
    {
        $cache_key = 'all_products';
        if (Cache::has($cache_key)) {
            $this->products = Cache::get($cache_key);
            return $this;
        }

        $file = file_get_contents(database_path('data.json'));
        $this->products =  collect(json_decode($file, true)['products']);

        Cache::forever($cache_key, $this->products);

        return $this;
    }

    private function applyFilters(): Collection
    {
        if (request()->has('category')) {
            $this->products = $this->products->where('category', request()->category);
        }

        if (request()->has('priceLessThan')) {
            $this->products = $this->products->where('price', '<', Money::toCents(request()->priceLessThan));
        }

        return $this->products;
    }
}
