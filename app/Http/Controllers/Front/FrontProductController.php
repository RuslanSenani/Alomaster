<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\FProductRequest;
use App\Services\Back\AlertServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\FProductServices;
use App\Services\Back\ProductImageServices;
use App\Services\Back\RankServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;


class FrontProductController
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;
    private string $directoryPath;

    private FProductServices $productServices;
    private ProductImageServices $productImageServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;

    private AlertServices $alertServices;
    private FileUploadService $fileUploadService;


    public function __construct(FProductServices $productServices, RankServices $rankServices, StatusServices $statusServices, FileUploadService $fileUploadService, ProductImageServices $productImageServices, AlertServices $alertServices)
    {
        $this->viewFolder = 'Front/Product_v';
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->productServices = $productServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;
        $this->fileUploadService = $fileUploadService;
        $this->productImageServices = $productImageServices;
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


        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "add",
            "pageName" => "Əlavə Et",
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
                'url' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);
            $this->productServices->saveProduct($validationData);
        } catch (\Exception $e) {
            $this->alertServices->error("Xeta", $e->getMessage());
            return redirect()->route('product.create');
        }
        return redirect()->route('product.index');
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
        $product = $this->productServices->getProductById($id);

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "Redaktə Et",
            "product" => $product,
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
                'url' => 'required|string|max:255',
                'description' => 'required|string|max:255',
            ]);
            $this->productServices->updateProduct($id, $validationData);
            return redirect()->route('product.index');

        } catch (ValidationException $e) {
            $this->alertServices->error("Xeta", $e->getMessage());
            return redirect()->route('product.edit', $id);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product_images = $this->productImageServices->getAllProducts(['product_id' => $id]);

        $delete = $this->productServices->deleteProduct($id);

        if (!$delete) {
            return response()->json([
                'redirect_url' => route('product.index'),
            ], 404);
        }

        foreach ($product_images as $product_image) {
            $this->fileUploadService->fileDelete($product_image->img_url);
        }
        return response()->json([
            'redirect_url' => route('product.index'),
        ]);

    }

    public function product_image(string $id)
    {


        $product = $this->productServices->getProductById($id);
        $productImage = $this->productImageServices->getAllProducts(['product_id' => $id]);

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "image",
            "pageName" => "Şəkil Əlavə Et",
            "dropzoneMessage" => "Fayllarınızı bura sürükləyib buraxın və ya onları seçmək üçün klikləyin..",
            'product' => $product,
            'productImage' => $productImage,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);

    }

    public function product_image_upload(Request $request, string $id)
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
                    'product_id' => $id,
                    'img_url' => $filePath,

                ];

                $this->productImageServices->saveProduct($insertData);
            }


        }


    }

    public function product_refresh_image(string $id)
    {

        $productImage = $this->productImageServices->getAllProducts(['product_id' => $id]);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "image/render_element",
            'productImage' => $productImage,
        ];

        $render_html = view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.image_list")->with($viewData);

        echo $render_html;


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
