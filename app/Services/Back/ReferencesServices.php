<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IReferencesRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class ReferencesServices
{

    private IReferencesRepository $referencesRepository;
    private FileUploadService $uploadService;
    private IAlert $alert;

    public function __construct(IReferencesRepository $referencesRepository, FileUploadService $uploadService, IAlert $alert)
    {
        $this->referencesRepository = $referencesRepository;
        $this->uploadService = $uploadService;
        $this->alert = $alert;
    }


    public function getAllData(): Collection
    {
        return $this->referencesRepository->all();
    }

    public function getDataById(int $id): Model
    {
        return $this->referencesRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->referencesRepository->getModel();
    }

    public function saveData(array $data): Model
    {
        return $this->referencesRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->referencesRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->referencesRepository->find($id);
            $delete = $this->referencesRepository->delete($id);

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
