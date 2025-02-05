<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IProductImageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ProductImageServices
{

    private IProductImageRepository $productImageRepository;
    private IAlert $alert;

    public function __construct(IProductImageRepository $productImageRepository, IAlert $alert)
    {
        $this->productImageRepository = $productImageRepository;
        $this->alert = $alert;
    }


    public function getAllProducts(array $where): Collection
    {
        return $this->productImageRepository->all($where);

    }

    public function getProductById(int $id): Model
    {
        return $this->productImageRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->productImageRepository->getModel();
    }

    public function saveProduct(array $data): Model
    {
        return $this->productImageRepository->create($data);
    }

    public function updateProduct(int $id, array $data): bool
    {
        return $this->productImageRepository->update($id, $data);
    }

    public function deleteProduct(int $id): bool
    {
        try {
            $delete = $this->productImageRepository->delete($id);
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
