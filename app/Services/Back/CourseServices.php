<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\ICoursesRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class CourseServices
{

    private ICoursesRepository $courseRepository;
    private FileUploadService $fileUploadService;
    private IAlert $alert;

    public function __construct(ICoursesRepository $courseRepository, FileUploadService $fileUploadService, IAlert $alert)
    {
        $this->courseRepository = $courseRepository;
        $this->fileUploadService = $fileUploadService;
        $this->alert = $alert;
    }


    public function getAllData(): Collection
    {
        return $this->courseRepository->all();
    }

    public function getDataById(int $id): Model
    {
        return $this->courseRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->courseRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->courseRepository->create($data);
    }

    public function updateData(int $id, array $data): bool
    {
        return $this->courseRepository->update($id, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->courseRepository->find($id);
            $delete = $this->courseRepository->delete($id);

            if ($delete) {
                $this->fileUploadService->fileDelete($getFilePath->img_url);
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
