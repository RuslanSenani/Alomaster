<?php

namespace App\Repositories;

use App\Contracts\IPortfolioCategoryRepository;
use App\Models\Front\PortfolioCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PortfoliosCategories implements IPortfolioCategoryRepository
{

    private PortfolioCategory $model;

    public function __construct(PortfolioCategory $portfolioModel)
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
