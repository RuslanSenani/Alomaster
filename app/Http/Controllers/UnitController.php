<?php

namespace App\Http\Controllers;



use App\Models\Unit;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder = "";
    private Unit $unitModel;

    public function __construct(Unit $unitModel)
    {
        $this->viewFolder = "Back/Unit_v";
        $this->unitModel = $unitModel;
    }

    public function index()
    {
        $unitList = $this->unitModel::all();

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Vahid',
            'units' => $unitList,
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
            'pageName' => 'Vahid',
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(
                [
                    'name' => 'required|string|regex:/^[a-zA-Z]+$/|max:10',
                ]
            );
            $exising = $this->unitModel::withTrashed()->where('name', $validatedData['name'])->first();
            if ($exising) {
                if ($exising->trashed()) {
                    $exising->restore();
                    $exising->update($validatedData);
                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('units.index');
                } else {
                    Alert::error('Xəta', '111 Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(5000);
                }
            }

            $this->unitModel->name = $validatedData['name'];
            $this->unitModel->save();
            return redirect()->route('units.index');

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


            return redirect()->route('units.create');
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
            $getUnit = $this->unitModel->findOrFail($id);
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => 'Redaktə Et',
                'unit' => $getUnit,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('units.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $unit = $this->unitModel->findOrFail($id);
            if (!$unit) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate([
                'name' => 'required|string|regex:/^[a-zA-Z]+$/|max:10',
            ]);


            Alert::success('Success', 'Record Inserted Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $unit->name = $validatedData['name'];
            $unit->update($validatedData);

            return redirect()->route('units.index');

        } catch (ValidationException $exception) {

            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);

            return redirect()->route('units.index');
        } catch (ModelNotFoundException $ex) {

            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('units.edit', $id)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->unitModel->destroy($id);
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Vahid',
            'stockList' => $this->unitModel::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'units.index')->with($viewData);

    }
}
