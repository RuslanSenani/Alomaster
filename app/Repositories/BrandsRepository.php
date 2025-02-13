<?php

namespace App\Repositories;

use App\Contracts\IBrandsRepository;
use App\Models\Front\Brand;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BrandsRepository implements IBrandsRepository
{

    private Brand $brandModel;

    public function __construct(Brand $brandModel)
    {
        $this->brandModel = $brandModel;
    }

    public function all(): Collection
    {
        return $this->brandModel->orderBy('rank', 'asc')->get();
    }

    public function find($id): ?Model
    {
        return $this->brandModel->findOrFail($id);
    }

    public function getModel(): Model
    {
        return $this->brandModel;
    }

    public function create(array $attributes): Model
    {
        return $this->brandModel->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        $brand = $this->brandModel->findOrFail($id);
        return $brand->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->brandModel->destroy($id);
    }
}
