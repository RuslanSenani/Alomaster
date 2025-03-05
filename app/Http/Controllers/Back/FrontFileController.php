<?php

namespace App\Http\Controllers\Back;

use App\Services\Back\FileServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\GalleryServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class FrontFileController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private string $directoryPath;


    private GalleryServices $galleryServices;
    private FileServices $fileServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private FileUploadService $fileUploadService;

    public function __construct(GalleryServices $galleryServices, FileServices $fileServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService)
    {
        $this->viewFolder = 'Back/FFiles_v';
        $this->directoryPath = "uploads/Back/FGalleries_v";
        $this->galleryServices = $galleryServices;
        $this->fileServices = $fileServices;
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
        $extension = $request->file('file')->extension();
        $gallery = $this->galleryServices->getDataById($request->gallery_id);

        $validationData = $request->validate([
            'file' => 'required|mimes:pdf,xlsx,xls,doc,docx|max:5120',
        ]);

        $uploadFile = $this->fileUploadService->multiUpload($request, $this->directoryPath . "/" . $gallery->gallery_type . "/" . $gallery->folder_name, $extension, $extension);

        $returnResponse = $uploadFile->getContent();
        $filePaths = json_decode($returnResponse, true);


        if (isset($filePaths['filePaths'])) {

            foreach ($filePaths['filePaths'] as $filePath) {

                $insertData = [
                    'gallery_id' => $request->gallery_id,
                    'url' => $filePath,

                ];

                $this->fileServices->saveData($insertData);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $gallery = $this->galleryServices->getDataById($id);

        $files = $this->fileServices->getAllData([
            ['gallery_id', '=', $id],
        ]);


        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "file",
            "pageName" => "Şəkil Əlavə Et",
            'directoryPath' => $this->directoryPath,
            "dropzoneMessage" => "Fayllarınızı bura sürükləyib buraxın və ya onları seçmək üçün klikləyin..",
            "gallery" => $gallery,
            'files' => $files,

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
        $file = $this->fileServices->getDataById($id);

        $gallery = $this->galleryServices->getDataById($file->gallery_id);

        $delete = $this->fileServices->deleteData($id);

        if (!$delete) {
            return response()->json([
                'redirect_url' => route('files.show', $gallery->id),
            ], 404);
        }

        $this->fileUploadService->fileDelete($this->directoryPath . "/" . $gallery->gallery_type . "/" . $gallery->url . "/" . $file->url);
        return response()->json([
            'redirect_url' => route('files.show', $gallery->id),
        ]);
    }


    public function refresh_files(string $id)
    {
        $gallery = $this->galleryServices->getDataById($id);
        $files = $this->fileServices->getAllData(
            [
                ['gallery_id', '=', $id],
            ]
        );
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "file/render_element",
            "directoryPath" => $this->directoryPath,
            "files" => $files,
            "gallery" => $gallery
        ];
        $render_html = view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.image_list")->with($viewData);

        echo $render_html;


    }

    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->fileServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $files = $this->fileServices->getDataById($id);
        $this->statusServices->setStatus($request, $files, $id);
    }
}
