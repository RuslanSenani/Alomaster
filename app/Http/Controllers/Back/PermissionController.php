<?php

namespace App\Http\Controllers\Back;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;

class PermissionController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder = "";
    private Permission $permissionModel;

    public function __construct(Permission $permission)
    {
        $this->permissionModel = $permission;
        $this->viewFolder = "Back/Permission_v";


    }

    public function index()
    {
        $permissionList = $this->permissionModel::all();

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Səlahiyyətlər',
            'permissionList' => $permissionList,

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
            'pageName' => 'Səlahiyyət',
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
                    'permissionName' => 'required|string|unique:permissions,name',
                ]
            );

            $this->permissionModel->name = $validatedData['permissionName'];
            $this->permissionModel->save();
            return redirect()->route('permissions.index');

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


            return redirect()->route('permissions.create');
        } catch (ValidationException $exception) {
            Alert::error('Error', 'Record Inserted Failed!' . $exception)
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

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
            $permission = $this->permissionModel->findOrFail($id);
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => "Redaktə Et",
                'role' => $permission,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('permissions.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $permission = $this->permissionModel->findOrFail($id);
            if (!$permission) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate(
                [
                    'permissionName' => 'required|string|unique:permissions,name',
                ]
            );
            Alert::success('Success', 'Record Updated Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $permission->name = $validatedData['permissionName'];

            $permission->update($validatedData);

            return redirect()->route('permissions.index');

        } catch (ValidationException $exception) {

            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);

            return redirect()->route('permissions.edit', $id);

        } catch (ModelNotFoundException $ex) {

            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('permissions.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->permissionModel->destroy($id);
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'roleList' => $this->permissionModel::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'permissions.index')->with($viewData);
    }
}
