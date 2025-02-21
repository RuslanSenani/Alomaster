<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IFileRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FileServices
{
    private IFileRepository $fileRepository;
    private FileUploadService $uploadService;
    private IAlert $alert;

    public function __construct(IFileRepository $fileRepository, FileUploadService $uploadService, IAlert $alert)
    {
        $this->fileRepository = $fileRepository;
        $this->uploadService = $uploadService;
        $this->alert = $alert;
    }


    public function getAllData(array $where = [], array $order = ['rank','asc']): Collection
    {
        return $this->fileRepository->all($where, $order);
    }

    public function getDataById(int $id): Model
    {
        return $this->fileRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->fileRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->fileRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->fileRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->fileRepository->find($id);
            $delete = $this->fileRepository->delete($id);

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
