<?php

namespace App\Http\Controllers\Back;

use App\Services\Back\CoverServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\ProductImageServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class FrontProductImageController
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;
    private string $directoryPath;
    private ProductImageServices $productImageServices;
    private StatusServices $statusServices;
    private RankServices $rankServices;
    private CoverServices $coverServices;
    private FileUploadService $fileUploadService;

    public function __construct(ProductImageServices $productImageServices, StatusServices $statusServices, RankServices $rankServices, CoverServices $coverServices, FileUploadService $fileUploadService)
    {
        $this->viewFolder = 'Back/FProduct_v';
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->productImageServices = $productImageServices;
        $this->statusServices = $statusServices;
        $this->rankServices = $rankServices;
        $this->coverServices = $coverServices;
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
        $product = $this->productImageServices->getProductById($id);
        $delete = $this->productImageServices->deleteProduct($id);

        if (!$delete) {
            return response()->json([
                'redirect_url' => route('product.image-form', $product->product_id),
            ], 404);
        }
        $this->fileUploadService->fileDelete($this->directoryPath . "/" . $product->img_url);
        return response()->json([
            'redirect_url' => route('product.image-form', $product->product_id),
        ]);
    }

    public function isActiveSetter(Request $request, string $id)
    {
        $image = $this->productImageServices->getProductById($id);
        $this->statusServices->setStatus($request, $image, $id);

    }

    public function rankSetter(Request $request)
    {
        $this->rankServices->setRankStatus($request, $this->productImageServices->getModelInstance());
    }

    public function isCoverSetter(Request $request, string $id, string $parent_id)
    {
        $this->coverServices->setCover($id, $parent_id, $this->productImageServices->getModelInstance(), $request);


        $productImage = $this->productImageServices->getAllProducts(['product_id' => $parent_id]);
        $viewData = [
            "viewFolder" => 'Back/FProduct_v',
            "subViewFolder" => "image/render_element",
            'productImage' => $productImage,
            'directoryPath' => $this->directoryPath,
        ];

        $render_html = view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.image_list")->with($viewData);

        echo $render_html;
    }
}
