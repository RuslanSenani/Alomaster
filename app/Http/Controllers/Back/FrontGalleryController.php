<?php

namespace App\Http\Controllers\Back;

use App\Services\Back\AlertServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\GalleryServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontGalleryController
{
    /**
     * Display a listing of the resource.
     */

    private $viewFolder;
    private $directoryPath;

    private GalleryServices $galleryServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private FileUploadService $fileUploadService;
    private AlertServices $alertServices;

    public function __construct(GalleryServices $galleryServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService, AlertServices $alertServices)
    {
        $this->viewFolder = "Back/FGalleries_v";
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->galleryServices = $galleryServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->alertServices = $alertServices;


    }

    public function index()
    {
        $galleries = $this->galleryServices->getAllData();
        $galleries =$this->galleryServices->addGalleryAttributes($galleries);

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Qalerya",
            'galleries' => $galleries,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "add",
            "pageName" => "Qalerya Əlavə Et",
        ];
        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'title' => 'required|string|max:100',
                'gallery_type' => 'required|string|max:6',
            ]);
            $urlAndFolderName = Str::slug($validatedData['title']);
            $validatedData['url'] = $urlAndFolderName;
            $validatedData['folder_name'] = $urlAndFolderName;
            if ($validatedData['gallery_type'] != 'video') {
                $createdDirectory = $this->fileUploadService->createDirectory($this->directoryPath . "/" . $validatedData['gallery_type'] . "/" . $urlAndFolderName);

                if (isset($createdDirectory->getData()->Error)) {
                    throw  new \Exception($createdDirectory->getData()->Error);
                }

            } else {
                $validatedData['folder_name'] = '';
            }

            $this->galleryServices->saveData($validatedData);


        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back()->withInput();
        }

        return redirect()->route('galleries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = $this->galleryServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "gallery" => $gallery,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $validatedData = $request->validate([
                'title' => 'required|string|max:100',
            ]);


            $newUrlAndPath = Str::slug($validatedData['title']);
            $validatedData['url'] = $newUrlAndPath;
            $validatedData['folder_name'] = $newUrlAndPath;

            $gallery = $this->galleryServices->getDataById($id);

            if ($gallery->gallery_type != 'video') {
                $createdDirectory = $this->fileUploadService->renameDirectory($this->directoryPath . "/" . $gallery->gallery_type . "/" . $gallery->folder_name, $this->directoryPath . "/" . $gallery->gallery_type . "/" . $newUrlAndPath);
                if (isset($createdDirectory->getData()->Error)) {
                    throw  new \Exception($createdDirectory->getData()->Error);
                }
            } else {
                $validatedData['folder_name'] = '';
            }

            $this->galleryServices->updateData([[
                "id","=",$id
            ]], $validatedData);

            return redirect()->route('galleries.index');

        } catch (\Exception $exception) {
            $this->alertServices->error("Xəta ", $exception->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = $this->galleryServices->getDataById($id);
        $delete = $this->galleryServices->deleteData($id);

        if (!$delete) {
            return response()->json([
                'redirect_url' => route('galleries.index'),
            ], 404);
        } else {
            $this->fileUploadService->deleteDirectory($this->directoryPath . "/" . $gallery->gallery_type . "/" . $gallery->folder_name);

            return response()->json([
                'redirect_url' => route('galleries.index'),
            ]);
        }

    }

    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->galleryServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $gallery = $this->galleryServices->getDataById($id);
        $this->statusServices->setStatus($request, $gallery, $id);
    }


}
