<?php

namespace App\Repositories;

use App\Contracts\IProductImageRepository;
use App\Models\Front\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductImageRepository implements IProductImageRepository
{


    private ProductImage $productImage;

    public function __construct(ProductImage $productImage)
    {
        $this->productImage = $productImage;
    }

    public function all(array $where, array $order): Collection
    {

        return $this->productImage->orderBy('rank', 'asc')->get();
    }

    public function find($id): ?Model
    {
        return $this->productImage->findOrFail($id);
    }

    public function getModel(): Model
    {
        return $this->productImage;
    }

    public function create(array $attributes): Model
    {
        return $this->productImage->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        $product = $this->productImage->findOrFail($id);
        return $product->update($id, $attributes);
    }

    public function delete($id): bool
    {
        return $this->productImage->destroy($id);
    }
}
