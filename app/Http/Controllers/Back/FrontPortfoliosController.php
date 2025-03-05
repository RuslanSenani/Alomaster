<?php

namespace App\Http\Controllers\Back;

use App\Services\Back\AlertServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\PortfolioCategoryServices;
use App\Services\Back\PortfolioImageServices;
use App\Services\Back\PortfoliosServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;


class FrontPortfoliosController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private string $directoryPath;
    private PortfoliosServices $portfoliosServices;
    private PortfolioCategoryServices $portfolioCategoryServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private AlertServices $alertServices;
    private FileUploadService $fileUploadService;
    private PortfolioImageServices $portfolioImageServices;


    public function __construct(RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService, AlertServices $alertServices, PortfoliosServices $portfoliosServices, PortfolioCategoryServices $portfolioCategoryServices, PortfolioImageServices $portfolioImageServices)
    {
        $this->viewFolder = 'Back/FPortfolios_v';
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->alertServices = $alertServices;
        $this->portfoliosServices = $portfoliosServices;
        $this->portfolioCategoryServices = $portfolioCategoryServices;
        $this->portfolioImageServices = $portfolioImageServices;
    }

    public function index()
    {
        $portfolios = $this->portfoliosServices->getAllData([], ['rank', 'asc']);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Portfel Listi",
            'portfolios' => $portfolios,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $portfoliosCategories = $this->portfolioCategoryServices->getAllData([
            ['isActive', '=', true]
        ]);

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "add",
            "pageName" => "Əlavə Et",
            "portfoliosCategories" => $portfoliosCategories
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validationData = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|string',
                'client' => 'required|string|max:255',
                'finishedAt' => 'required|date',
                'place' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'portfolio_url' => 'nullable|string',

            ]);
            $validationData['url'] = Str::slug($validationData['title']);
            $validationData['finishedAt'] = Carbon::createFromFormat('m/d/Y', $request->input('finishedAt'))->format('Y-m-d');

            $this->portfoliosServices->saveData($validationData);
        } catch (\Exception $e) {
            $this->alertServices->error("Xeta", $e->getMessage());
            return redirect()->route('portfolios.create')->withInput();
        }
        return redirect()->route('portfolios.index');
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
        $portfoliosCategories = $this->portfolioCategoryServices->getAllData([
            ['isActive', '=', true]
        ]);
        $portfolio = $this->portfoliosServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "portfolio" => $portfolio,
            "portfoliosCategories" => $portfoliosCategories,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validationData = $request->validate([
                'title' => 'required|string|max:255',
                'category_id' => 'required|string',
                'client' => 'required|string|max:255',
                'finishedAt' => 'required|date',
                'place' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'portfolio_url' => 'nullable|string',

            ]);
            $validationData['url'] = Str::slug($validationData['title']);
            $validationData['finishedAt'] = Carbon::createFromFormat('m/d/Y', $request->input('finishedAt'))->format('Y-m-d');

            $this->portfoliosServices->updateData($id, $validationData);
        } catch (\Exception $e) {
            $this->alertServices->error("Xeta", $e->getMessage());
            return redirect()->route('portfolios.edit')->withInput();
        }
        return redirect()->route('portfolios.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portfolio_images = $this->portfolioImageServices->getAllData(['portfolio_id' => $id]);

        $delete = $this->portfoliosServices->deleteData($id);

        if (!$delete) {
            return response()->json([
                'redirect_url' => route('portfolios.index'),
            ], 404);
        }

        foreach ($portfolio_images as $portfolio_image) {

            $this->fileUploadService->fileDelete($this->directoryPath . "/" . $portfolio_image->img_url);
        }
        return response()->json([
            'redirect_url' => route('portfolios.index'),
        ]);
    }

    public function portfolios_image(string $id)
    {
        $portfolio = $this->portfoliosServices->getDataById($id);

        $portfolioImage = $this->portfolioImageServices->getAllData(['portfolio_id' => $id], ['rank', 'asc']);

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "image",
            "directoryPath" => $this->directoryPath,
            "pageName" => "Şəkil Əlavə Et",
            "dropzoneMessage" => "Fayllarınızı bura sürükləyib buraxın və ya onları seçmək üçün klikləyin..",
            'portfolio' => $portfolio,
            'portfolioImage' => $portfolioImage,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);

    }

    public function portfolio_image_upload(Request $request, string $id)
    {


        $validationData = $request->validate([
            'file.*' => 'required|file|mimes:jpeg,jpg,png|max:5120',
        ]);

        $uploadFile = $this->fileUploadService->multiUpload($request, $this->directoryPath, 150, 150);
        $returnResponse = $uploadFile->getContent();
        $filePaths = json_decode($returnResponse, true);

        if (isset($filePaths['filePaths'])) {
            foreach ($filePaths['filePaths'] as $filePath) {

                $insertData = [
                    'portfolio_id' => $id,
                    'img_url' => $filePath,

                ];

                $this->portfolioImageServices->saveData($insertData);
            }


        }


    }

    public function portfolio_refresh_image(string $id)
    {


        $portfolioImage = $this->portfolioImageServices->getAllData(['portfolio_id' => $id]);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "directoryPath" => $this->directoryPath,
            "subViewFolder" => "image/render_element",
            'portfolioImage' => $portfolioImage,
        ];

        $render_html = view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.image_list")->with($viewData);

        echo $render_html;


    }

    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->portfoliosServices->getModelInstance());
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $portfolios = $this->portfoliosServices->getDataById($id);
        $this->statusServices->setStatus($request, $portfolios, $id);
    }
}
