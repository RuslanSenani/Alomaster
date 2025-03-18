<?php

namespace App\Services\Back;

use App\Contracts\IStatusRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use mysql_xdevapi\Exception;

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

    public function setIsReadable(Model $model, int $id): JsonResponse
    {
        try {
            if ($id) {
                $this->statusRepository->isReadable(1, $id, $model);
            }
            return response()->json(['success' => true]);
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }

}
