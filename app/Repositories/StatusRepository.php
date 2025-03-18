<?php

namespace App\Repositories;

use App\Contracts\IStatusRepository;
use Illuminate\Database\Eloquent\Model;

class StatusRepository  implements  IStatusRepository
{

    public function isActive(int $isActive, int $id, Model $model): void
    {
        $model->where('id', $id)->update(['isActive' => $isActive]);
    }
    public function isReadable(int $isReadable, int $id, Model $model): void
    {
        $model->where('id', $id)->update(['isReadable' => $isReadable]);
    }
}
