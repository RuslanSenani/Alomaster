<?php

namespace App\Http\Controllers\Back;



use App\Models\Warehouse;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private Warehouse $warehouseModel;

    public function __construct(Warehouse $warehouseModel)
    {
        $this->viewFolder = "Back/Warehouse_v";
        $this->warehouseModel = $warehouseModel;
    }

    public function index()
    {

        $warehouseList = $this->warehouseModel::all();

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Anbarlar",
            "warehouses" => $warehouseList,
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
            "pageName" => "Anbar Əlavə Et",
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);

    }

    /**
     * Store a newly created resource in uploads.
     */
    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'location' => 'required|string|max:255',
                ]
            );
            $exising = $this->warehouseModel::withTrashed()->where('name', $validatedData['name'])->first();
            if ($exising) {
                if ($exising->trashed()) {
                    $exising->restore();
                    $exising->update($validatedData);
                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('warehouse.index');
                } else {
                    Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(5000);
                }
            }

            $this->warehouseModel->name = $validatedData['name'];
            $this->warehouseModel->location = $validatedData['location'];
            $this->warehouseModel->save();
            return redirect()->route('warehouse.index');

        } catch (QueryException $exception) {

            if ($exception->getCode() == "23000") {
                Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(5000);
            }
            else {
                Alert::error('Xəta', 'Gözlənilməz baza xətası yarandı: ' . $exception->getMessage())
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(3000);
            }


            return redirect()->route('warehouse.create');
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
            $getWarehouse = $this->warehouseModel->findOrFail($id);
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => 'Redaktə Et',
                'warehouseList' => $getWarehouse,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('warehouse.index');
        }
    }

    /**
     * Update the specified resource in uploads.
     */
    public function update(Request $request, string $id)
    {

        try {

            $warehouse = $this->warehouseModel->findOrFail($id);
            if (!$warehouse) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
            ]);

            Alert::success('Success', 'Record Updated Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $warehouse->name = $validatedData['name'];
            $warehouse->location = $validatedData['location'];
            $warehouse->update($validatedData);

            return redirect()->route('warehouse.index');

        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $message) {
                foreach ($message as $error) {
                    Alert::error('Xəta', $error)->toToast()->autoclose(3000);
                }
            }
            return redirect()->route('warehouse.index');
        } catch (ModelNotFoundException $ex) {
            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('warehouse.edit', $id);
        }
    }


    /**
     * Remove the specified resource from uploads.
     */
    public function destroy(string $id)
    {
        $deleted = $this->warehouseModel->destroy($id);
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Anbarlar',
            'stockList' => $this->warehouseModel::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'warehouse.index')->with($viewData);

    }
}
