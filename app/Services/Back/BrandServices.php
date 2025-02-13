<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IBrandsRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BrandServices
{

    private IBrandsRepository $brandRepository;
    private  FileUploadService  $uploadService;
    private IAlert $alert;

    public function __construct(IBrandsRepository $brandRepository,FileUploadService $fileUploadService, IAlert $alert)
    {
        $this->brandRepository = $brandRepository;
        $this->alert = $alert;
        $this->uploadService = $fileUploadService;
    }


    public function getAllData(): Collection
    {
        return $this->brandRepository->all();
    }

    public function getDataById(int $id): Model
    {
        return $this->brandRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->brandRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->brandRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->brandRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->brandRepository->find($id);
            $delete = $this->brandRepository->delete($id);

            if ($delete) {
                $this->uploadService->fileDelete($getFilePath->img_url);
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
