<?php

namespace App\Http\Controllers\Front;

use App\Models\Front\FProduct;
use Illuminate\Http\Request;

class FrontProductController
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;

    private FProduct $productModel;

    public function __construct(FProduct $product)
    {
        $this->viewFolder = 'Front/Product_v';
        $this->productModel = $product;
    }

    public function index()
    {
        $products = $this->productModel->orderBy('rank', 'asc')->get();
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
        //
    }

}
