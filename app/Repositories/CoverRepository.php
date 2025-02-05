<?php

namespace App\Repositories;

use App\Contracts\ICoverRepository;
use Illuminate\Database\Eloquent\Model;

class CoverRepository implements ICoverRepository
{

    public function isCover(array $value, array $where, int $id, int $parent_id, Model $model): void
    {
        $model->where($where)->update($value);

    }
}
