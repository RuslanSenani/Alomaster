<?php

namespace App\Http\Controllers;


use App\Models\Customer;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Services\StockOutServices;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    private string $viewFolder = "";
    private StockOut $stockOutModel;
    private StockIn $stockInModel;
    private Customer $customerModel;
    private StockOutServices $stockOutServices;

    public function __construct(StockOut $stockOut, Customer $customer, StockIn $stockIn, StockOutServices $stockOutServices)
    {
        $this->viewFolder = "Back.StockOut_v";
        $this->stockOutModel = $stockOut;
        $this->customerModel = $customer;
        $this->stockInModel = $stockIn;
        $this->stockOutServices = $stockOutServices;
    }

    public function index()
    {
        $stockOutList = $this->stockOutModel->with(['StockIn', 'customer'])->orderBy('id', 'desc')->get();
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

            $this->stockOutServices->storeStockOut($validatedData);

           return redirect()->route('stock-out.index');


        } catch (ValidationException $ex) {


            Alert::error('Error', 'Record Inserted Failed!' . $ex->getMessage())
                ->position('top-left')
                ->toToast()
                ->autoclose(3000);

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

            $this->stockOutServices->updateStockOut($validatedData, $id);


            return redirect()->route('stock-out.index');


        } catch (ValidationException $ex) {


            Alert::error('Error', 'Record Inserted Failed!' . $ex->getMessage())
                ->position('top-left')
                ->toToast()
                ->autoclose(3000);

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
