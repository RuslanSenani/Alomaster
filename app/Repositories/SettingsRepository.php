<?php

namespace App\Repositories;

use App\Contracts\ISettingsRepository;
use App\Models\Front\Setting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SettingsRepository implements ISettingsRepository
{
    private Setting $model;

    public function __construct(Setting $settingModel)
    {
        $this->model = $settingModel;
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
