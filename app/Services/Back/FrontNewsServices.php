<?php

namespace App\Services\Back;


use App\Contracts\IAlert;
use App\Contracts\IFrontNewsRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class FrontNewsServices
{

    private IFrontNewsRepository $newsRepository;
    private IAlert $alert;
    private  FileUploadService  $uploadService;

    public function __construct(IFrontNewsRepository $newsRepository, IAlert $alert, FileUploadService $uploadService)
    {
        $this->newsRepository = $newsRepository;
        $this->alert = $alert;
        $this->uploadService = $uploadService;

    }


    public function getAllData(): Collection
    {
        return $this->newsRepository->all();

    }

    public function getDataById(int $id): Model
    {
        return $this->newsRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->newsRepository->getModel();
    }

    public function saveData(array $data): Model
    {
        return $this->newsRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->newsRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->newsRepository->find($id);
            $delete = $this->newsRepository->delete($id);

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
