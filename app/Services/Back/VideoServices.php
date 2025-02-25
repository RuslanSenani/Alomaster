<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IVideoRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class VideoServices
{
    private IVideoRepository $videoRepository;
    private FileUploadService $uploadService;
    private IAlert $alert;

    public function __construct(IVideoRepository $videoRepository, FileUploadService $uploadService, IAlert $alert)
    {
        $this->videoRepository = $videoRepository;
        $this->uploadService = $uploadService;
        $this->alert = $alert;
    }


    public function getAllData(array $where = [], array $order = ['rank', 'asc']): Collection
    {
        return $this->videoRepository->all($where, $order);
    }


    public function getDataById(int $id): Model
    {
        return $this->videoRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->videoRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->videoRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->videoRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->videoRepository->find($id);
            $delete = $this->videoRepository->delete($id);

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
