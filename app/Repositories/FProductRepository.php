<?php

namespace App\Repositories;

use App\Contracts\IFProductRepository;
use App\Models\Front\FProduct;
use Illuminate\Support\Collection;


class FProductRepository implements IFProductRepository
{

    protected FProduct $productModel;

    public function __construct(FProduct $product)
    {

        $this->productModel = $product;
    }

    public function all(): Collection
    {
        return $this->productModel->orderBy('rank', 'asc')->get();
    }

    public function find($id): ?FProduct
    {
        return $this->productModel->findOrFail($id);
    }

    public function getModel(): FProduct
    {
        return $this->productModel;
    }

    public function create(array $attributes): FProduct
    {
        return $this->productModel->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        $product = $this->productModel->findOrFail($id);
        return $product->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->productModel->destroy($id);
    }


}
