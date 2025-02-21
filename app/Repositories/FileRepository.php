<?php

namespace App\Repositories;

use App\Contracts\IFileRepository;
use App\Models\Front\File;
use App\Models\Front\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FileRepository implements IFileRepository
{
    private File $model;

    public function __construct(File $file)
    {
        $this->model = $file;
    }

    public function all(array $where, array $order): Collection
    {
        return $this->model->where($where)->orderBy($order[0], $order[1])->get();
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
        $file = $this->model->findOrFail($id);
        return $file->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }
}
