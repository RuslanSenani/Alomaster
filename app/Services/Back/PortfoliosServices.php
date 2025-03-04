<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IPortfoliosRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PortfoliosServices
{

    private IPortfoliosRepository $portfolioRepository;
    private IAlert $alert;

    public function __construct(IPortfoliosRepository $portfolioRepository, IAlert $alert)
    {
        $this->portfolioRepository = $portfolioRepository;
        $this->alert = $alert;
    }


    public function getAllData(array $where = [], array $order = ['id', 'asc']): Collection
    {
        return $this->portfolioRepository->all($where, $order);
    }

    public function getDataById(int $id): Model
    {
        return $this->portfolioRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->portfolioRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->portfolioRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->portfolioRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $delete = $this->portfolioRepository->delete($id);

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
