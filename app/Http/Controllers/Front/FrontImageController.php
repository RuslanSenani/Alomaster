<?php

namespace App\Http\Controllers\Front;

use App\Services\Back\FileUploadService;
use App\Services\Back\GalleryServices;
use App\Services\Back\ImageServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class FrontImageController
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;
    private string $directoryPath;


    private GalleryServices $galleryServices;
    private ImageServices $imageServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private FileUploadService $fileUploadService;


    public function __construct(GalleryServices $galleryServices, ImageServices $imageServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService)
    {
        $this->viewFolder = 'Front/Images_v';
        $this->directoryPath = "uploads/Front/Galleries_v";
        $this->galleryServices = $galleryServices;
        $this->imageServices = $imageServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $gallery = $this->galleryServices->getDataById($request->gallery_id);

        $validationData = $request->validate([
            'file.*' => 'required|file|mimes:jpeg,jpg,png|max:5120',
        ]);

        $uploadFile = $this->fileUploadService->multiUpload($request, $this->directoryPath . "/" . $gallery->gallery_type . "/" . $gallery->folder_name, 150, 150);

        $returnResponse = $uploadFile->getContent();
        $filePaths = json_decode($returnResponse, true);


        if (isset($filePaths['filePaths'])) {

            foreach ($filePaths['filePaths'] as $filePath) {

                $insertData = [
                    'gallery_id' => $request->gallery_id,
                    'url' => $filePath,

                ];

                $this->imageServices->saveData($insertData);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $gallery = $this->galleryServices->getDataById($id);

        $images = $this->imageServices->getAllData([
            ['gallery_id', '=', $id],
        ]);


        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "image",
            "pageName" => "Şəkil Əlavə Et",
            'directoryPath' => $this->directoryPath,
            "dropzoneMessage" => "Fayllarınızı bura sürükləyib buraxın və ya onları seçmək üçün klikləyin..",
            "gallery" => $gallery,
            'images' => $images,

        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $image = $this->imageServices->getDataById($id);

        $gallery = $this->galleryServices->getDataById($image->gallery_id);

        $delete = $this->imageServices->deleteData($id);

        if (!$delete) {
            return response()->json([
                'redirect_url' => route('images.show', $gallery->id),
            ], 404);
        }

        $this->fileUploadService->fileDelete($this->directoryPath . "/" . $gallery->gallery_type . "/" . $gallery->url . "/" . $image->url);
        return response()->json([
            'redirect_url' => route('images.show', $gallery->id),
        ]);
    }


    public function refresh_image(string $id): void
    {
        $gallery = $this->galleryServices->getDataById($id);
        $images = $this->imageServices->getAllData(
            [
                ['gallery_id', '=', $id],
            ]
        );
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "image/render_element",
            "directoryPath" => $this->directoryPath,
            "images" => $images,
            "gallery" => $gallery
        ];
        $render_html = view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.image_list")->with($viewData);

        echo $render_html;


    }

    public function rankSetter(Request $request): void
    {
        $this->rankServices->setRankStatus($request, $this->imageServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id): void
    {
        $images = $this->imageServices->getDataById($id);
        $this->statusServices->setStatus($request, $images, $id);
    }

}
