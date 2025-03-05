<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IFileRepository;
use App\Contracts\ISlidersRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class SlidersServices
{
    private ISlidersRepository $slidersRepository;
    private FileUploadService $uploadService;
    private IAlert $alert;

    public function __construct(ISlidersRepository $slidersRepository, FileUploadService $uploadService, IAlert $alert)
    {
        $this->slidersRepository = $slidersRepository;
        $this->uploadService = $uploadService;
        $this->alert = $alert;
    }


    public function getAllData(array $where = [], array $order = ['rank','asc']): Collection
    {
        return $this->slidersRepository->all($where, $order);
    }

    public function getDataById(int $id): Model
    {
        return $this->slidersRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->slidersRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->slidersRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->slidersRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->slidersRepository->find($id);
            $delete = $this->slidersRepository->delete($id);

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
