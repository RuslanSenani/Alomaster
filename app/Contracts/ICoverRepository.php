<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface ICoverRepository
{
    public function isCover(array $value, array $where, int $id, int $parent_id, Model $model): void;
}
