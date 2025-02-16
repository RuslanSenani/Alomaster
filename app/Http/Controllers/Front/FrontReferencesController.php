<?php

namespace App\Http\Controllers\Front;

use App\Services\Back\AlertServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\RankServices;
use App\Services\Back\ReferencesServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class FrontReferencesController
{
    /**
     * Display a listing of the resource.
     */

    private $viewFolder;
    private $directoryPath;
    private ReferencesServices $referencesServices;
    private FileUploadService $fileUploadService;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private  AlertServices $alertServices;

    public function __construct(StatusServices $statusServices, RankServices $rankServices, ReferencesServices $referencesServices, FileUploadService $fileUploadService, AlertServices $alertServices)
    {
        $this->viewFolder = "Front/References_v";
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->rankServices = $rankServices;
        $this->referencesServices = $referencesServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->alertServices = $alertServices;
    }

    public function index()
    {
        $reference = $this->referencesServices->getAllData();

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Referanslar",
            'references' => $reference,
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
            "pageName" => "Referans Əlavə Et",
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
                'description' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);


            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
            }

            $this->referencesServices->saveData($validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('references.index');
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
        $reference = $this->referencesServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "references" => $reference,
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
                'description' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $references = $this->referencesServices->getDataById($id);
            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $this->fileUploadService->fileDelete($references->img_url);
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
            }

            $this->referencesServices->updateData($id, $validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('references.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->referencesServices->deleteData($id);
        if (!$delete) {
            return response()->json([
                'redirect_url' => route('references.index'),
            ], 404);
        }
        return response()->json([
            'redirect_url' => route('references.index'),
        ]);
    }

    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->referencesServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $references = $this->referencesServices->getDataById($id);
        $this->statusServices->setStatus($request, $references, $id);
    }
}
