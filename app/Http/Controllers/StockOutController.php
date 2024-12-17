<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Customer;
use App\Models\DbModel;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\Supplier;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    private string $viewFolder = "";
    private StockIn $stockInModel;
    private Product $productModel;
    private Warehouse $warehouseModel;
    private Category $categoryModel;
    private DbModel $dbModel;
    private Customer $customerModel;


    public function __construct(StockIn $stockIn, Product $product, Warehouse $warehouse, Category $category, DbModel $dbModel, Customer $customer)
    {
        $this->viewFolder = "Back.StockIn_v";
        $this->stockInModel = $stockIn;
        $this->productModel = $product;
        $this->warehouseModel = $warehouse;
        $this->categoryModel = $category;
        $this->dbModel = $dbModel;
        $this->customerModel = $customer;

    }

    public function index()
    {
        $stockList = $this->stockInModel->with(['product', 'warehouse', 'category', 'model', 'customer'])->get();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Stock In',
            'stockList' => $stockList,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'add',
            'pageName' => 'Stock Out',
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with( $viewData);

    }

    /**
     * Store a newly created resource in uploads.
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
     * Update the specified resource in uploads.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from uploads.
     */
    public function destroy(string $id)
    {
        //
    }
}
