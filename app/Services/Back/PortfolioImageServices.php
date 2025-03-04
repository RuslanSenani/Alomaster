<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IPortfolioImageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class PortfolioImageServices
{
    private  IPortfolioImageRepository $portfolioImageRepository;
    private  IAlert $alert;
    public function __construct(IPortfolioImageRepository $portfolioImageRepository, IAlert $alert){
        $this->portfolioImageRepository = $portfolioImageRepository;
        $this->alert = $alert;
    }


    public function getAllData(array $where = [], array $order = ['id', 'asc']): Collection
    {
        return $this->portfolioImageRepository->all($where, $order);
    }

    public function getDataById(int $id): Model
    {
        return $this->portfolioImageRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->portfolioImageRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->portfolioImageRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->portfolioImageRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $delete = $this->portfolioImageRepository->delete($id);

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
