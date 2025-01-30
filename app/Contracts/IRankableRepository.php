<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;


interface IRankableRepository
{
    public function setRank(int $id, int $rank, Model $model):void;
}
