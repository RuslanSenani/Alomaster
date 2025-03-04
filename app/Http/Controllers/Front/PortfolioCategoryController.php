<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\FProductRequest;
use App\Services\Back\AlertServices;
use App\Services\Back\PortfolioCategoryServices;
use App\Services\Back\PortfoliosServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class PortfolioCategoryController
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;

    private PortfolioCategoryServices $portfolioCategoryServices;
    private  PortfoliosServices $portfolioServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private AlertServices $alertServices;


    public function __construct(PortfolioCategoryServices $portfolioCategoryServices, RankServices $rankServices, StatusServices $statusServices, AlertServices $alertServices,PortfoliosServices $portfolioServices)
    {
        $this->viewFolder = 'Front/PortfoliosCategory_v';
        $this->portfolioCategoryServices = $portfolioCategoryServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->alertServices = $alertServices;
        $this->portfolioServices = $portfolioServices;

    }

    public function index()
    {

        $portfoliosCategories = $this->portfolioCategoryServices->getAllData();
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Portfolio Kateqoriyası Listi",
            "portfoliosCategories" => $portfoliosCategories,

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
            "pageName" => "Portfolio Kateqoriyası Əlavə Et",

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
                'title' => 'required|string|max:255',
            ]);
            $this->portfolioCategoryServices->saveData($validatedData);
        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('portfoliosCategories.index');
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
        $portfoliosCategory = $this->portfolioCategoryServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Portfolio Kateqoriyası Redaktə Et",
            "portfoliosCategory" => $portfoliosCategory,

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
                'title' => 'required|string|max:255',
            ]);

            $this->portfolioCategoryServices->updateData($id, $validatedData);

        } catch (\Exception $exception) {

            $this->alertServices->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back();
        }

        return redirect()->route('portfoliosCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $delete = $this->portfolioCategoryServices->deleteData($id);
        if (!$delete) {
            return response()->json([
                'redirect_url' => route('portfoliosCategories.index'),
            ], 404);
        }
        return response()->json([
            'redirect_url' => route('portfoliosCategories.index'),
        ]);
    }

    public function isActiveSetter(FProductRequest $request, string $id)
    {
        $portfolioCategory = $this->portfolioCategoryServices->getDataById($id);
        $this->statusServices->setStatus($request, $portfolioCategory, $id);

    }
}
