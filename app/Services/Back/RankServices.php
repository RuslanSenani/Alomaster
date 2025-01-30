<?php

namespace App\Services\Back;

use App\Contracts\IRankableRepository;
use App\Repositories\RankableRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RankServices
{
    private IRankableRepository $iRankableRepository;

    public function __construct(IRankableRepository $rankableRepository)
    {
        $this->iRankableRepository = $rankableRepository;
    }
    public function setRankStatus(Request $request, Model $model): void
    {
        $data = $request->post('data');
        parse_str($data,$order);
        $items = $order['ord'];
        foreach ($items as $rank=>$id) {
            $this->iRankableRepository->setRank($id,$rank,$model);
        }

    }
}
