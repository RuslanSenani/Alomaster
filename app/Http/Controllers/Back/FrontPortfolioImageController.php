<?php

namespace App\Http\Controllers\Back;

use App\Services\Back\FileUploadService;
use App\Services\Back\PortfolioImageServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class FrontPortfolioImageController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private string $directoryPath;
    private PortfolioImageServices $portfolioImageServices;
    private StatusServices $statusServices;
    private RankServices $rankServices;
    private  FileUploadService  $fileUploadService;

    public function __construct(PortfolioImageServices $portfolioImageServices, StatusServices $statusServices, RankServices $rankServices, FileUploadService $fileUploadService)
    {
        $this->viewFolder = 'Back/FPortfolios_v';
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->portfolioImageServices = $portfolioImageServices;
        $this->statusServices = $statusServices;
        $this->rankServices = $rankServices;
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
        //
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


        $portfolio = $this->portfolioImageServices->getDataById($id);
        $delete = $this->portfolioImageServices->deleteData($id);

        if (!$delete) {
            return response()->json([
                'redirect_url' => route('portfolios.image-form', $portfolio->portfolio_id),
            ], 404);
        }
        $this->fileUploadService->fileDelete($this->directoryPath . "/" . $portfolio->img_url);
        return response()->json([
            'redirect_url' => route('portfolios.image-form', $portfolio->portfolio_id),
        ]);
    }

    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->portfolioImageServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $portfolioImage = $this->portfolioImageServices->getDataById($id);
        $this->statusServices->setStatus($request, $portfolioImage, $id);
    }
}
