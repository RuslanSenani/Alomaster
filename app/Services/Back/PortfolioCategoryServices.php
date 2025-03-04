<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IPortfolioCategoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PortfolioCategoryServices
{
    private IPortfolioCategoryRepository $portfolioCategoryRepository;
    private IAlert $alert;

    public function __construct(IPortfolioCategoryRepository $portfolioCategoryRepository,IAlert $alert)
    {
        $this->portfolioCategoryRepository = $portfolioCategoryRepository;
        $this->alert = $alert;
    }


    public function getAllData(array $where = [], array $order = ['id','asc']): Collection
    {
        return $this->portfolioCategoryRepository->all($where, $order);
    }

    public function getDataById(int $id): Model
    {
        return $this->portfolioCategoryRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->portfolioCategoryRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->portfolioCategoryRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->portfolioCategoryRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $delete = $this->portfolioCategoryRepository->delete($id);

            if ($delete) {
                $this->alert->success("Uğurlu", "Silinmə Uğurlu Oldu");
                return true;
            } else {
                $this->alert->error("Xəta", "Silinmə Zamanı Xəta Baş Verdi");
                return false;
            }
        } catch (\Exception $exception) {
            $this->alert->error("Xəta", "Gözlənilməz Xəta Baş Verdi Kod: " . $exception->getCode());
            return false;
        }
    }
}
