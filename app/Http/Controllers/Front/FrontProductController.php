<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\FProductRequest;
use App\Services\Back\AlertServices;
use App\Services\Back\FProductServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;


class FrontProductController
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;

    private FProductServices $productServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;
    private AlertServices $alertServices;

    public function __construct(FProductServices $productServices, RankServices $rankServices, StatusServices $statusServices, AlertServices $alertServices)
    {
        $this->viewFolder = 'Front/Product_v';
        $this->productServices = $productServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->alertServices = $alertServices;
    }

    public function index()
    {
        $products = $this->productServices->getAllProducts();
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Məhsullar",
            'products' => $products,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
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
    public function store(FProductRequest $request)
    {
        $validationData = $request->validated();
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
    public function update(FProductRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->productServices->deleteProduct($id);

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Məhsullar",
            'products' => $this->productServices->getAllProducts(),
        ];
        return redirect()->route("product.index")->with($viewData, 200);
    }

    public function isActiveSetter(FProductRequest $request, string $id)
    {
        $product = $this->productServices->getProductById($id);
        $this->statusServices->setStatus($request, $product, $id);

    }

    public function rankSetter(FProductRequest $request)
    {
        $this->rankServices->setRankStatus($request, $this->productServices->getModelInstance());
    }

}
