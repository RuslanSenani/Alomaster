<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IImageRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ImageServices
{

    private  IImageRepository $imageRepository;
    private FileUploadService $uploadService;
    private IAlert $alert;

    public function __construct(IImageRepository $imageRepository, FileUploadService  $uploadService, IAlert $alert){
        $this->imageRepository = $imageRepository;
        $this->uploadService = $uploadService;
        $this->alert = $alert;
    }



    public function getAllData(): Collection
    {
        return $this->imageRepository->all();
    }

    public function getDataById(int $id): Model
    {
        return $this->imageRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->imageRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->imageRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->imageRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->imageRepository->find($id);
            $delete = $this->imageRepository->delete($id);

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
