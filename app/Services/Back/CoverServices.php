<?php

namespace App\Services\Back;

use App\Contracts\ICoverRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class CoverServices
{

    private ICoverRepository $coverRepository;

    public function __construct(ICoverRepository $coverRepository)
    {
        $this->coverRepository = $coverRepository;
    }

    public function setCover(int $id, int $parent_id, Model $model, Request $request): void
    {
        if ($id && $parent_id) {
            $isCover = ($request->post('data') === 'true') ? 1 : 0;
            $this->coverRepository->isCover(
                ['isCover' => $isCover],
                [['id', '=', $id], ['product_id', '=', $parent_id]],
                $id,
                $parent_id,
                $model
            );

            $this->coverRepository->isCover(
                ['isCover' => 0],
                [
                    ['id', '!=', $id],
                    ['product_id', '=', $parent_id]
                ],
                $id,
                $parent_id,
                $model
            );
        }
    }
}
