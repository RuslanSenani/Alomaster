<?php

namespace App\Services\Back;

use App\Contracts\IAlert;
use App\Contracts\IGalleryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class GalleryServices
{
    private IGalleryRepository $galleryRepository;
    private FileUploadService $uploadService;
    private IAlert $alert;

    public function __construct(IGalleryRepository $galleryRepository, FileUploadService $uploadService, IAlert $alert)
    {
        $this->galleryRepository = $galleryRepository;
        $this->uploadService = $uploadService;
        $this->alert = $alert;
    }


    public function getAllData(): Collection
    {
        return $this->galleryRepository->all();
    }

    public function getDataById(int $id): Model
    {
        return $this->galleryRepository->find($id);
    }

    public function getModelInstance(): Model
    {
        return $this->galleryRepository->getModel();

    }

    public function saveData(array $data): Model
    {
        return $this->galleryRepository->create($data);
    }

    public function updateData(array $array, array $data): bool
    {
        return $this->galleryRepository->update($array, $data);
    }

    public function deleteData(int $id): bool
    {
        try {
            $getFilePath = $this->galleryRepository->find($id);
            $delete = $this->galleryRepository->delete($id);

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

    public function addGalleryAttributes(Collection $galleries): Collection
    {
        return $galleries->map(function ($gallery) {
            $gallery->icon = match ($gallery->gallery_type) {
                'image' => 'fa-image',
                'video' => 'fa-play-circle',
                'file' => 'fa-folder',
                default => 'fa-question',
            };

            $gallery->route = match ($gallery->gallery_type) {
                'image' => 'images.show',
                'video' => 'galleries.videos.index',
                'file' => 'files.show',
                default => 'galleries.index',
            };

            return $gallery;
        });
    }


}
