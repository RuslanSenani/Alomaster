<?php

namespace App\Http\Controllers\Back;



use App\Models\Supplier;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class SupplierController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private Supplier $supplierModel;

    public function __construct(Supplier $supplier)
    {
        $this->supplierModel = $supplier;
        $this->viewFolder = 'Back/Supplier_v';
    }

    public function index()
    {
        $supplierList = $this->supplierModel::all();
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Tədarükçülər",
            "supplierList" => $supplierList,
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
            "pageName" => "Tədarükçü",
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'code' => 'nullable|string|max:20',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|string|max:20',
                ]
            );


            $exising = $this->supplierModel::withTrashed()->where('name', $validatedData['name'])->first();


            if ($exising) {
                if ($exising->trashed()) {
                    $exising->code = $validatedData['code'];
                    $exising->email = $validatedData['email'];
                    $exising->phone = $validatedData['phone'];
                    $exising->restore();
                    $exising->save();
                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('suppliers.index');
                } else {
                    Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(5000);
                }
            }

            $this->supplierModel->name = $validatedData['name'];
            $this->supplierModel->code = $validatedData['code'];
            $this->supplierModel->email = $validatedData['email'];
            $this->supplierModel->phone = $validatedData['phone'];
            $this->supplierModel->save();
            return redirect()->route('suppliers.index');

        } catch (QueryException $exception) {

            if ($exception->getCode() == "23000") {
                Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(5000);
            } else {
                Alert::error('Xəta', 'Gözlənilməz baza xətası yarandı: ' . $exception->getMessage())
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(3000);
            }


            return redirect()->route('suppliers.create');
        } catch (ValidationException $exception) {

            foreach ($exception->errors() as $field => $messages) {
                foreach ($messages as $error) {
                    Alert::error('Error', 'Record Inserted Failed!' . $error)
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                }
            }
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
        try {
            $supplierModel = $this->supplierModel->findOrFail($id);
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => 'Redaktə Et',
                'supplierList' => $supplierModel,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('suppliers.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $supplier = $this->supplierModel->findOrFail($id);
            if (!$supplier) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'code' => 'nullable|string|max:20',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|string|max:20',
                ]
            );

            Alert::success('Success', 'Record Updated Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $supplier->name = $validatedData['name'];
            $supplier->code = $validatedData['code'];
            $supplier->email = $validatedData['email'];
            $supplier->phone = $validatedData['phone'];
            $supplier->update($validatedData);

            return redirect()->route('suppliers.index');

        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $message) {
                foreach ($message as $error) {
                    Alert::error('Xəta', $error)->toToast()->autoclose(3000);
                }
            }
            return redirect()->route('suppliers.index');
        } catch (ModelNotFoundException $ex) {
            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('suppliers.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->supplierModel->destroy($id);
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Tədarükçülər',
            'stockList' => $this->supplierModel::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'suppliers.index')->with($viewData);
    }

}
