<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IServicesRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ServiceServices
{


    private IServicesRepository $servicesRepository;
    private FileUploadService $uploadService;
    private IAlert $alert;

    public function __construct(IServicesRepository $servicesRepository, FileUploadService $uploadService, IAlert $alert)
    {
        $this->servicesRepository = $servicesRepository;
        $this->uploadService = $uploadService;
        $this->alert = $alert;
    }


    public function getAllData(array $where = [], array $order = ['rank','asc']): Collection
    {
        return $this->servicesRepository->all($where, $order);
    }

    public function getDataById(int $id): Model
    {
        return $this->servicesRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->servicesRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->servicesRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->servicesRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->servicesRepository->find($id);
            $delete = $this->servicesRepository->delete($id);

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
