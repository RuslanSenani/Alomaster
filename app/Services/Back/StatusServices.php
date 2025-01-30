<?php

namespace App\Services\Back;

use App\Contracts\IStatusRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class StatusServices
{
    private IStatusRepository $statusRepository;

    public function __construct(IStatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function setStatus(Request $request, Model $model, int $id): void
    {
        if ($id) {
            $isActive = ($request->post('data') === 'true') ? 1 : 0;
            $this->statusRepository->isActive($isActive, $id, $model);
        }
    }

}
