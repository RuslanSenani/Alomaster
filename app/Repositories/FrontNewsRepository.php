<?php

namespace App\Repositories;

use App\Contracts\IFrontNewsRepository;
use App\Models\Front\News;
use Illuminate\Support\Collection;

class FrontNewsRepository implements IFrontNewsRepository
{

    private News $newsModel;

    public function __construct(News $newsModel)
    {
        $this->newsModel = $newsModel;
    }

    public function all(): Collection
    {
        return $this->newsModel->orderBy('rank', 'asc')->get();
    }

    public function find($id): ?News
    {
        return $this->newsModel->findOrFail($id);
    }

    public function getModel(): News
    {
        return $this->newsModel;
    }

    public function create(array $attributes): News
    {
        return $this->newsModel->create($attributes);
    }

    public function update($id, array $attributes): bool
    {
        $news =  $this->newsModel->findOrFail($id);
        return  $this->newsModel->update($news);
    }

    public function delete($id): bool
    {
        return $this->newsModel->destroy($id);
    }
}
