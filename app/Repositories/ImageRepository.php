<?php

namespace App\Repositories;

use App\Contracts\IImageRepository;
use App\Models\Front\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ImageRepository implements  IImageRepository
{

    private Image $model;

    public function __construct(Image $imageModel)
    {
        $this->model = $imageModel;
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

    public function update($id, array $attributes): bool
    {
        $image = $this->model->findOrFail($id);
        return $image->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }
}
