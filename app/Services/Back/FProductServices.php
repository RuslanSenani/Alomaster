<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IFProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FProductServices
{
    protected IFproductRepository $productRepository;
    protected IAlert $alert;

    public function __construct(IFproductRepository $productRepository, IAlert $alert)
    {
        $this->productRepository = $productRepository;
        $this->alert = $alert;
    }


    public function getAllProducts(): Collection
    {
        return $this->productRepository->all();

    }

    public function getProductById(int $id): Model
    {
        return $this->productRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->productRepository->getModel();
    }

    public function saveProduct(array $data): Model
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct(int $id, array $data): bool
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id): void
    {
        try {
            $delete = $this->productRepository->delete($id);
            if ($delete) {
                $this->alert->success("Uğurlu", "Silinmə Uğurlu Oldu");

            } else {
                $this->alert->error("Xəta", "Silinmə Zamanı Xəta Baş Verdi");

            }
        } catch (\Exception $exception) {
            $this->alert->error("Xəta", "Gözlənilməz Xəta Baş Verdi Kod: " . $exception->getCode());

        }


    }


}
