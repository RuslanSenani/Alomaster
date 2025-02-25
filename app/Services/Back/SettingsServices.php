<?php

namespace App\Services\Back;

use App\Contracts\ISettingsRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SettingsServices
{
    private ISettingsRepository $settingsRepository;


    public function __construct(ISettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;

    }


    public function getAllData(array $where = [], array $order = ['id', 'asc']): Collection
    {
        return $this->settingsRepository->all($where, $order);
    }


    public function getDataById(int $id): Model
    {
        return $this->settingsRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->settingsRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->settingsRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->settingsRepository->update($id, $data);
    }
}
