<?php

namespace App\Http\Controllers\Front;

use App\Repositories\BrandsRepository;
use App\Services\Back\AlertServices;
use App\Services\Back\BrandServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class BrandController
{
    /**
     * Display a listing of the resource.
     */

    private $viewFolder;
    private $directoryPath;
    private BrandServices $brandServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private FileUploadService $fileUploadService;
    private AlertServices $alertServices;

    public function __construct(BrandServices $brandServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService, AlertServices $alertServices)
    {
        $this->viewFolder = "Front/Brands_v";
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->brandServices = $brandServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->alertServices = $alertServices;

    }

    public function index()
    {
        $brands = $this->brandServices->getAllData();

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Brendlər",
            'brands' => $brands,
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
            "pageName" => "Brend Əlavə Et",
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
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
            }

            $this->brandServices->saveData($validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('brands.index');
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
        $brand = $this->brandServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "brand" => $brand,
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
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $brands = $this->brandServices->getDataById($id);
            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $this->fileUploadService->fileDelete($brands->img_url);
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
            }

            $this->brandServices->updateData($id, $validatedData);

        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('brands.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->brandServices->deleteData($id);
        if (!$delete) {
            return response()->json([
                'redirect_url' => route('brands.index'),
            ], 404);
        }
        return response()->json([
            'redirect_url' => route('brands.index'),
        ]);
    }


    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->brandServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $brands = $this->brandServices->getDataById($id);
        $this->statusServices->setStatus($request, $brands, $id);
    }
}
