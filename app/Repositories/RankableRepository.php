<?php

namespace App\Repositories;

use App\Contracts\IRankableRepository;
use Illuminate\Database\Eloquent\Model;

class RankableRepository implements IRankableRepository
{

    public function setRank(int $id, int $rank, Model $model): void
    {
        $model::where('id', $id)
            ->where('rank', '!=', $rank)
            ->update(['rank' => $rank]);
    }
}
