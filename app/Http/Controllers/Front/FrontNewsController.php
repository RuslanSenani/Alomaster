<?php

namespace App\Http\Controllers\Front;

use App\Services\Back\AlertServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\FrontNewsServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class FrontNewsController
{
    /**
     * Display a listing of the resource.
     */
    private $viewFolder;
    private $directoryPath;
    private FrontNewsServices $newsServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private FileUploadService $fileUploadService;
    private AlertServices $alertServices;


    public function __construct(FrontNewsServices $newsServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService, AlertServices $alertServices)
    {
        $this->viewFolder = "Front/News_v";
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->newsServices = $newsServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->alertServices = $alertServices;
    }

    public function index()
    {

        $news = $this->newsServices->getAllData();

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Xəbərlər",
            'news' => $news,
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
            "script" => "scripts",
            "style" => "style",
            "pageName" => "Xəbərlər Əlavə Et",
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
                'news_type' => 'required|string|max:5',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'video_url' => 'nullable|string|max:100'
            ]);

            if ($request->news_type == "image") {
                $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
                if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                    $validatedData['img_url'] = $uploadFile->getData()->fileName;
                }
            } else if ($request->news_type == "video") {
                $validatedData['video_url'] = $request->video_url;
            }
            $this->newsServices->saveData($validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('news.index');
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
        $news = $this->newsServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "script" => "scripts",
            "style" => "style",
            "pageName" => "Redaktə Et",
            "news" => $news,
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
                'news_type' => 'required|string|max:5',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'video_url' => 'nullable|string|max:100'
            ]);

            $news = $this->newsServices->getDataById($id);
            if ($request->news_type == "image") {
                $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
                if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                    $this->fileUploadService->fileDelete($news->img_url);
                    $validatedData['img_url'] = $uploadFile->getData()->fileName;
                }
            } else if ($request->news_type == "video") {
                $validatedData['video_url'] = $request->video_url;
            }
            $this->newsServices->updateData($id, $validatedData);
            return redirect()->route('news.index');
        } catch (\Exception $exception) {
            $this->alertServices->error("Xəta ", $exception->getMessage());
            return redirect()->route('news.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->newsServices->deleteData($id);
        if (!$delete) {
            return response()->json([
                'redirect_url' => route('news.index'),
            ], 404);
        }
        return response()->json([
            'redirect_url' => route('news.index'),
        ]);
    }

    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->newsServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $news = $this->newsServices->getDataById($id);
        $this->statusServices->setStatus($request, $news, $id);
    }
}
