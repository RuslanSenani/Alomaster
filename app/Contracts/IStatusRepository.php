<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;


interface IStatusRepository
{
    public function isActive(int $isActive,int $id, Model $model): void;
}
