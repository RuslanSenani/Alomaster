<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\DbModel;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\Supplier;
use App\Models\Warehouse;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class StockInController extends Controller
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
    private Supplier $supplierModel;


    public function __construct(StockIn $stockIn, Product $product, Warehouse $warehouse, Category $category, DbModel $dbModel, Supplier $supplier)
    {
        $this->viewFolder = "Back.StockIn_v";
        $this->stockInModel = $stockIn;
        $this->productModel = $product;
        $this->warehouseModel = $warehouse;
        $this->categoryModel = $category;
        $this->dbModel = $dbModel;
        $this->supplierModel = $supplier;

    }

    public function index()
    {
        $stockList = $this->stockInModel->withoutGlobalScope('excludeDeletedProducts')->with(['product.unit', 'warehouse', 'category', 'model', 'supplier'])->get();


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

        $productList = $this->productModel->with(['unit'])->get();
        $warehouseList = $this->warehouseModel::all();
        $categoryList = $this->categoryModel::all();
        $modelList = $this->dbModel::all();
        $supplierList = $this->supplierModel::all();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'add',
            'pageName' => 'Stock In',
            'categoryList' => $categoryList,
            'productList' => $productList,
            'warehouseList' => $warehouseList,
            'modelList' => $modelList,
            'supplierList' => $supplierList,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

    }

    /**
     * Store a newly created resource in uploads.
     */
    public function store(Request $request)
    {


        try {
            $validatedData = $request->validate([

                'warehouse' => 'required|integer|exists:warehouses,id',
                'product' => 'required|integer|exists:products,id',
                'supplier' => 'required|integer|exists:suppliers,id',
                'code' => 'required|string|max:255',
                'model' => 'nullable|string|max:255',
                'category' => 'required|integer|exists:categories,id',
                'unit' => 'required|string|max:50',
                'unitPrice' => 'required|numeric|min:0',
                'enterCount' => 'required|numeric|min:1',
                'image' => 'string|nullable',
                'date' => 'required|date',
                'description' => 'nullable|string|max:1000',


            ]);

            $enterDate = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format('Y-m-d');
            $exising = $this->stockInModel::withTrashed()
                ->where('warehouse_id', $validatedData['warehouse'])
                ->where('product_id', $validatedData['product'])
                ->where('category_id', $validatedData['category'])
                ->where('model_id', $validatedData['model'])
                ->where('supplier_id', $validatedData['supplier'])
                ->first();

            if ($exising) {
                if ($exising->trashed()) {
                    $exising->product_img = $validatedData['image'];
                    $exising->product_desc = $validatedData['description'];
                    $exising->product_code = $validatedData['code'];
                    $exising->qty = $validatedData['enterCount'];
                    $exising->product_unit = $validatedData['unit'];
                    $exising->product_unit_price = $validatedData['unitPrice'];
                    $exising->enter_date = $enterDate;
                    $exising->restore();
                    $exising->save();

                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-left')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('stock-in.index');
                } else {
                    Alert::error('Xəta', '111 Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-left')
                        ->toToast()
                        ->autoclose(5000);
                }
            }


            $this->stockInModel->warehouse_id = $validatedData['warehouse'];
            $this->stockInModel->product_id = $validatedData['product'];
            $this->stockInModel->category_id = $validatedData['category'];
            $this->stockInModel->model_id = $validatedData['model'];
            $this->stockInModel->supplier_id = $validatedData['supplier'];
            $this->stockInModel->product_img = $validatedData['image'];
            $this->stockInModel->product_desc = $validatedData['description'];
            $this->stockInModel->product_code = $validatedData['code'];
            $this->stockInModel->qty = $validatedData['enterCount'];
            $this->stockInModel->product_unit = $validatedData['unit'];
            $this->stockInModel->product_unit_price = $validatedData['unitPrice'];
            $this->stockInModel->enter_date = $enterDate;
            $this->stockInModel->save();
            return redirect()->route('stock-in.index');


        } catch (ValidationException $ex) {

            foreach ($ex->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    Alert::error('Error', 'Record Inserted Failed!' . $ex->getMessage())
                        ->position('top-left')
                        ->toToast()
                        ->autoclose(3000);
                }
            }
            return redirect()->back()->withInput();

        } catch (Exception $e) {
            Alert::error('Error', 'Record Not Inserted!' . $e->getMessage())
                ->position('top-left')
                ->toToast()
                ->autoclose(50000);
            return redirect()->back()->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //burda formnan gelen ve ya linkden id ile gelen deyeri alib  gostereceyik serte uygun deyer gostermek
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stockList = $this->stockInModel->with(['product', 'warehouse', 'category', 'model', 'supplier'])->findOrFail($id);
        $productList = $this->productModel->with(['unit'])->get();
        $warehouseList = $this->warehouseModel::all();
        $categoryList = $this->categoryModel::all();
        $modelList = $this->dbModel::all();
        $supplierList = $this->supplierModel::all();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'edit',
            'pageName' => 'Stock In',
            'stockList' => $stockList,
            'categoryList' => $categoryList,
            'productList' => $productList,
            'warehouseList' => $warehouseList,
            'modelList' => $modelList,
            'supplierList' => $supplierList,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);
    }

    /**
     * Update the specified resource in uploads.
     */
    public function update(Request $request, string $id)
    {
        try {

            $stock = $this->stockInModel->findOrFail($id);
            if (!$stock) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }


            $validatedData = $request->validate([
                'warehouse' => 'required|integer|exists:warehouses,id',
                'product' => 'required|integer|exists:products,id',
                'supplier' => 'required|integer|exists:suppliers,id',
                'code' => 'required|string|max:255',
                'model' => 'nullable|string|max:255',
                'category' => 'required|integer|exists:categories,id',
                'unit' => 'required|string|max:50',
                'unitPrice' => 'required|numeric|min:0',
                'enterCount' => 'required|numeric|min:1',
                'image' => 'string|nullable',
                'date' => 'required|date',
                'description' => 'nullable|string|max:1000',
            ]);

            $enterDate = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format('Y-m-d');


            $stock->warehouse_id = $validatedData['warehouse'];
            $stock->product_id = $validatedData['product'];
            $stock->product_code = $validatedData['code'];
            $stock->model_id = $validatedData['model'];
            $stock->category_id = $validatedData['category'];
            $stock->product_unit = $validatedData['unit'];
            $stock->product_unit_price = $validatedData['unitPrice'];
            $stock->qty = $validatedData['enterCount'];
            $stock->product_img = $validatedData['image'] ?? $stock->product_img;
            $stock->enter_date = $enterDate;
            $stock->product_desc = $validatedData['description'];
            $stock->supplier_id = $validatedData['supplier'];
            $stock->update();

            Alert::success('Success', 'Record Inserted Successfully!')
                ->position('top-left')
                ->toToast()
                ->autoclose(3000)
                ->width('100px');

            return redirect()->route('stock-in.index');

        } catch (ValidationException $ex) {

            foreach ($ex->errors() as $field => $messages) {
                foreach ($messages as $message) {
                    Alert::error('Error', 'Record Inserted Failed!' . $ex->getMessage())
                        ->position('top-left')
                        ->toToast()
                        ->autoclose(3000)
                        ->width('100px');
                }
            }
            return redirect()->back()->withInput();

        } catch (Exception $e) {
            Alert::error('Error', 'Record Not Inserted!' . $e->getMessage())
                ->position('top-left')
                ->toToast()
                ->autoclose(50000)
                ->width('100px');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from uploads.
     */
    public function destroy(string $id)
    {
        $product = $this->stockInModel->findOrFail($id);
        $deleted = $this->stockInModel->destroy($id);

        $stockList = $this->stockInModel->with(['product', 'warehouse', 'category', 'model'])->get();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Stock In',
            'stockList' => $stockList,
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-left')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-left')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'stock-in.index')->with($viewData);

    }


}
