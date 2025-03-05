<?php

namespace App\Http\Controllers\Back;

use App\Services\Back\AlertServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\RankServices;
use App\Services\Back\SlidersServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class FrontSlidersController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private string $directoryPath;
    private SlidersServices $slidersServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private FileUploadService $fileUploadService;
    private AlertServices $alertServices;

    public function __construct(SlidersServices $slidersServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService, AlertServices $alertServices)
    {
        $this->viewFolder = 'Back/FSliders_v';
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->slidersServices = $slidersServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->alertServices = $alertServices;

    }

    public function index()
    {
        $sliders = $this->slidersServices->getAllData();
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Slaydlar",
            'sliders' => $sliders,
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
            "pageName" => "Slayd Əlavə Et",
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
                'description' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->allowButton == "on") {
                $validatedData = $request->validate([
                    'allowButton' => 'required|string',
                    'button_caption' => 'required|string|max:20',
                    'button_url' => 'required|string|max:255',
                ]);
            }

            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
                unset($validatedData['image']);
            }
            $this->slidersServices->saveData($validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage());
            return redirect()->back()->withInput();
        }

        return redirect()->route('sliders.index');
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
        $slider = $this->slidersServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "slider" => $slider,
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
                'description' => 'required|string',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            if ($request->allowButton == "on") {
                $validatedData = $request->validate([
                    'allowButton' => 'required|string',
                    'button_caption' => 'required|string|max:20',
                    'button_url' => 'required|string|max:255',
                ]);
            }

            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
                unset($validatedData['image']);
            }
            $this->slidersServices->updateData($id, $validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage());
            return redirect()->back()->withInput();
        }

        return redirect()->route('sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->slidersServices->deleteData($id);
        if (!$delete) {
            return response()->json([
                'redirect_url' => route('sliders.index'),
            ], 404);
        }
        return response()->json([
            'redirect_url' => route('sliders.index'),
        ]);
    }

    public function rankSetter(Request $request): void
    {
        $this->rankServices->setRankStatus($request, $this->slidersServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id): void
    {
        $sliders = $this->slidersServices->getDataById($id);
        $this->statusServices->setStatus($request, $sliders, $id);
    }
}
