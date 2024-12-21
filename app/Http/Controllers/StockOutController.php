<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Customer;
use App\Models\DbModel;
use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\Supplier;
use App\Models\Warehouse;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use TijsVerkoyen\CssToInlineStyles\Css\Rule\Rule;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    private string $viewFolder = "";
    private StockOut $stockOutModel;
    private StockIn $stockInModel;
    private Customer $customerModel;


    public function __construct(StockOut $stockOut, Customer $customer, StockIn $stockIn)
    {
        $this->viewFolder = "Back.StockOut_v";
        $this->stockOutModel = $stockOut;
        $this->customerModel = $customer;
        $this->stockInModel = $stockIn;

    }

    public function index()
    {
        $stockOutList = $this->stockOutModel->with(['StockIn', 'customer'])->get();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Stock Out',
            'stockOutList' => $stockOutList,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stockInList = $this->stockInModel->with(['product', 'warehouse', 'category', 'model'])->get();
        $customerList = $this->customerModel::all();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'add',
            'pageName' => 'Stock Out',
            'stockInList' => $stockInList,
            'customerList' => $customerList,

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

                'warehouse' => 'required|string|max:255',
                'product' => 'required|integer|exists:products,id',
                'customer' => 'required|integer|exists:customers,id',
                'code' => 'required|string|max:255',
                'model' => 'nullable|string|max:255',
                'category' => 'required|string|max:50',
                'unit' => 'required|string|max:50',
                'salesPrice' => 'required|numeric|min:0',
                'exitCount' => 'required|numeric|min:1',
                'image' => 'string|nullable',
                'date' => 'required|date',
                'description' => 'nullable|string|max:1000',


            ]);

            $exitDate = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format('Y-m-d');
            $exising = $this->stockOutModel::withTrashed()
                ->where('stock_in_id', $validatedData['product'])
                ->first();
            $productName = $this->stockInModel::with(['product'])
                ->where('id', $validatedData['product'])
                ->first()->product->product_name;
            if ($exising) {
                if ($exising->trashed()) {
                    $exising->warehouse_name = $validatedData['warehouse'];
                    $exising->product_name = $productName;
                    $exising->category_name = $validatedData['category'];
                    $exising->model_name = $validatedData['model'];
                    $exising->customer_id = $validatedData['customer'];
                    $exising->product_img = $validatedData['image'];
                    $exising->product_description = $validatedData['description'];
                    $exising->product_code = $validatedData['code'];
                    $exising->product_exit_count = $validatedData['exitCount'];
                    $exising->product_unit = $validatedData['unit'];
                    $exising->product_unit_sale_price = $validatedData['salesPrice'];
                    $exising->exit_date = $exitDate;
                    $exising->restore();
                    $exising->save();

                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-left')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('stock-out.index');
                } else {
                    Alert::error('Xəta', '111 Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-left')
                        ->toToast()
                        ->autoclose(5000);
                }
            }

            $this->stockOutModel->stock_in_id = $validatedData['product'];
            $this->stockOutModel->warehouse_name = $validatedData['warehouse'];
            $this->stockOutModel->product_name = $productName;
            $this->stockOutModel->category_name = $validatedData['category'];
            $this->stockOutModel->model_name = $validatedData['model'];
            $this->stockOutModel->customer_id = $validatedData['customer'];
            $this->stockOutModel->product_img = $validatedData['image'];
            $this->stockOutModel->product_description = $validatedData['description'];
            $this->stockOutModel->product_code = $validatedData['code'];
            $this->stockOutModel->product_exit_count = $validatedData['exitCount'];
            $this->stockOutModel->product_unit = $validatedData['unit'];
            $this->stockOutModel->product_unit_sale_price = $validatedData['salesPrice'];
            $this->stockOutModel->exit_date = $exitDate;
            $this->stockOutModel->update();
            return redirect()->route('stock-out.index');


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
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $stockOutList = $this->stockOutModel->with(['StockIn', 'customer'])->findOrFail($id);
        $customerList = $this->customerModel::all();
        $stockInList = $this->stockInModel::all();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'edit',
            'pageName' => 'Stock Out',
            'stockInList' => $stockInList,
            'stockOutList' => $stockOutList,
            'customerList' => $customerList,

        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

    }

    /**
     * Update the specified resource in uploads.
     */
    public function update(Request $request, string $id)
    {
        try {

            $validatedData = $request->validate([

                'warehouse' => 'required|string|max:255',
                'product' => 'required|integer|exists:products,id',
                'customer' => 'required|integer|exists:customers,id',
                'code' => 'required|string|max:255',
                'model' => 'nullable|string|max:255',
                'category' => 'required|string|max:50',
                'unit' => 'required|string|max:50',
                'salesPrice' => 'required|numeric|min:0',
                'exitCount' => 'required|numeric|min:1',
                'image' => 'string|nullable',
                'date' => 'required|date',
                'description' => 'nullable|string|max:1000',
            ]);

            $stock = $this->stockOutModel->findOrFail($id);
            $productName = $this->stockInModel::with(['product'])
                ->where('id', $stock->stock_in_id)
                ->first()->product->product_name;
            if (!$stock) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }


            $exitDate = Carbon::createFromFormat('m/d/Y', $request->input('date'))->format('Y-m-d');
            $stock->stock_in_id = $validatedData['product'];
            $stock->warehouse_name = $validatedData['warehouse'];
            $stock->product_name = $productName;
            $stock->category_name = $validatedData['category'];
            $stock->model_name = $validatedData['model'];
            $stock->customer_id = $validatedData['customer'];
            $stock->product_img = $validatedData['image'] ?? $stock->product_img;
            $stock->product_description = $validatedData['description'];
            $stock->product_code = $validatedData['code'];
            $stock->product_exit_count = $validatedData['exitCount'];
            $stock->product_unit = $validatedData['unit'];
            $stock->product_unit_sale_price = $validatedData['salesPrice'];
            $stock->exit_date = $exitDate;
            $stock->save();
            return redirect()->route('stock-out.index');


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
     * Remove the specified resource from uploads.
     */
    public function destroy(string $id)
    {
       //
    }
}
