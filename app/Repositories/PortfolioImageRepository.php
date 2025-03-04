<?php

namespace App\Repositories;

use App\Contracts\IPortfolioImageRepository;
use App\Models\Front\PortfolioImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PortfolioImageRepository implements IPortfolioImageRepository
{
    private PortfolioImage $model;

    public function __construct(PortfolioImage $portfolioModel)
    {
        $this->model = $portfolioModel;
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
        return $this->model->where([['id', '=', $id]])->update($attributes);
    }

    public function delete($id): bool
    {
        return $this->model->destroy($id);
    }
}
