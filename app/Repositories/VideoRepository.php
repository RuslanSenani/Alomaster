<?php

namespace App\Repositories;

use App\Contracts\IVideoRepository;
use App\Models\Front\Video;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class VideoRepository implements IVideoRepository
{

    private Video $model;

    public function __construct(Video $videoModel)
    {
        $this->model = $videoModel;
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
        $video = $this->model->findOrFail($id);
        return $video->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }
}
