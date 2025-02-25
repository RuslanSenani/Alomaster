<?php

namespace App\Http\Controllers\Front;

use App\Contracts\IAlert;
use App\Models\Front\Gallery;
use App\Models\Front\Video;
use App\Services\Back\GalleryServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use App\Services\Back\VideoServices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class FrontVideoController
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;
    private GalleryServices $galleryServices;
    private VideoServices $videoServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private IAlert $alert;

    public function __construct(GalleryServices $galleryServices, VideoServices $videoServices, RankServices $rankServices, StatusServices $statusServices, IAlert $alert)
    {
        $this->viewFolder = 'Front/Videos_v';
        $this->galleryServices = $galleryServices;
        $this->videoServices = $videoServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->alert = $alert;

    }

    public function index(Gallery $gallery)
    {

        $videos = $this->videoServices->getAllData([
            ['gallery_id', '=', $gallery->id],
        ]);


        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Video Əlavə Et",
            "gallery" => $gallery,
            'videos' => $videos,

        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Gallery $gallery)
    {
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "add",
            "pageName" => "Video Əlavə Et",
            "gallery" => $gallery,
        ];
        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Gallery $gallery)
    {
        try {
            $validatedData = $request->validate([
                'url' => 'required|string|max:100',
            ]);

            $validatedData['gallery_id'] = $gallery->id;
            $this->videoServices->saveData($validatedData);
        } catch (\Exception $exception) {

            $this->alert->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back()->withInput();
        }

        return redirect()->route('galleries.videos.index', $gallery);
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
    public function edit(Gallery $gallery, Video $video)
    {

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "gallery" => $gallery,
            "video" => $video,
        ];
        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery, Video $video)
    {
        try {
            $validatedData = $request->validate([
                'url' => 'required|string|max:100',
            ]);

            $validatedData['gallery_id'] = $gallery->id;
            $this->videoServices->updateData($video->id, $validatedData);
        } catch (\Exception $exception) {

            $this->alert->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back()->withInput();
        }

        return redirect()->route('galleries.videos.index', $gallery);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery, Video $video)
    {

        $delete = $this->videoServices->deleteData($video->id);

        if (!$delete) {
            return response()->json([
                'redirect_url' => route('galleries.videos.index', [$gallery->id, $video->id]),
            ], 404);
        }
        return response()->json([
            'redirect_url' => route('galleries.videos.index', [$gallery, $video->id]),
        ]);
    }


    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->videoServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $videos = $this->videoServices->getDataById($id);
        $this->statusServices->setStatus($request, $videos, $id);
    }
}
