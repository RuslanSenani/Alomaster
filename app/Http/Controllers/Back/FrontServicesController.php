<?php

namespace App\Http\Controllers\Back;

use App\Services\Back\AlertServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\RankServices;
use App\Services\Back\ServiceServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FrontServicesController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private string $directoryPath;


    private ServiceServices $serviceServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private FileUploadService $fileUploadService;
    private AlertServices $alertServices;


    public function __construct(ServiceServices $serviceServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService, AlertServices $alertServices)
    {
        $this->viewFolder = 'Back/FServices_v';
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->serviceServices = $serviceServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->alertServices = $alertServices;
    }

    public function index()
    {
        $services = $this->serviceServices->getAllData();
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Servisler",
            'services' => $services,
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
            "pageName" => "Xidmət Əlavə Et",
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
                'url' => 'required|string|max:100',
                'title' => 'required|string|max:100',
                'description' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $validatedData['url'] = Str::slug($validatedData['url']);
            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
            }

            $this->serviceServices->saveData($validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('services.index');
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
        $service = $this->serviceServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "service" => $service,
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
                'url' => 'required|string|max:100',
                'title' => 'required|string|max:100',
                'description' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $service = $this->serviceServices->getDataById($id);
            $validatedData['url'] = Str::slug($validatedData['title']);
            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $this->fileUploadService->fileDelete($service->img_url);
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
                unset($validatedData['image']);
            }

            $this->serviceServices->updateData($id, $validatedData);

        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('services.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->serviceServices->deleteData($id);
        if (!$delete) {
            return response()->json([
                'redirect_url' => route('services.index'),
            ], 404);
        }
        return response()->json([
            'redirect_url' => route('services.index'),
        ]);
    }

    public function rankSetter(Request $request): void
    {
        $this->rankServices->setRankStatus($request, $this->serviceServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id): void
    {
        $services = $this->serviceServices->getDataById($id);
        $this->statusServices->setStatus($request, $services, $id);
    }
}
