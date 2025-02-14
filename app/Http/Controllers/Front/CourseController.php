<?php

namespace App\Http\Controllers\Front;

use App\Services\Back\AlertServices;
use App\Services\Back\CourseServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class CourseController
{
    /**
     * Display a listing of the resource.
     */

    private $viewFolder;
    private $directoryPath;
    private CourseServices $courseServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private FileUploadService $fileUploadService;
    private AlertServices $alertServices;

    public function __construct(CourseServices $courseServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService, AlertServices $alertServices)
    {
        $this->viewFolder = "Front/Courses_v";
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->courseServices = $courseServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->alertServices = $alertServices;

    }

    public function index()
    {
        $courses = $this->courseServices->getAllData();

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Kurslar",
            'courses' => $courses,
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
            "pageName" => "Kurs Əlavə Et",
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
                'event_date' => 'required|date',
            ]);
            $validatedData['event_date'] = Carbon::createFromFormat('m/d/Y', $validatedData['event_date'])->format('Y-m-d');
            $validatedData['url'] = Str::slug($validatedData['url']);
            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
            }

            $this->courseServices->saveData($validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('courses.index');
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
        $course = $this->courseServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "course" => $course,
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
                'event_date' => 'required|date',
            ]);

            $course = $this->courseServices->getDataById($id);
            $validatedData['event_date'] = Carbon::createFromFormat('m/d/Y', $validatedData['event_date'])->format('Y-m-d');
            $validatedData['url'] = Str::slug($validatedData['url']);
            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 150);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $this->fileUploadService->fileDelete($course->img_url);
                $validatedData['img_url'] = $uploadFile->getData()->fileName;
            }

            $this->courseServices->updateData($id, $validatedData);

        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->courseServices->deleteData($id);
        if (!$delete) {
            return response()->json([
                'redirect_url' => route('courses.index'),
            ], 404);
        }
        return response()->json([
            'redirect_url' => route('courses.index'),
        ]);
    }


    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->courseServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $course = $this->courseServices->getDataById($id);
        $this->statusServices->setStatus($request, $course, $id);
    }
}
