<?php

namespace App\Repositories;

use App\Contracts\IGalleryRepository;
use App\Models\Front\Gallery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class GalleryRepository implements IGalleryRepository
{
    private Gallery $model;

    public function __construct(Gallery $gallery)
    {
        $this->model = $gallery;
    }

    public function all(): Collection
    {
        return $this->model->orderBy('rank', 'asc')->get();
    }

    public function find($id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(array $where, array $attributes): bool
    {
        return $this->model->where($where)->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }

}
