<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IContactRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ContactServices
{
    private IContactRepository $contactRepository;
    private IAlert $alert;

    public function __construct(IContactRepository $contactRepository, IAlert $alert)
    {
        $this->contactRepository = $contactRepository;
        $this->alert = $alert;
    }

    public function getAllData(array $where = [], array $order = ['rank', 'asc']): Collection
    {
        return $this->contactRepository->all($where, $order);
    }

    public function getDataById(int $id): Model
    {
        return $this->contactRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->contactRepository->getModel();
    }

    public function saveData(array $data): Model
    {
        return $this->contactRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->contactRepository->update($id, $data);
    }
}
