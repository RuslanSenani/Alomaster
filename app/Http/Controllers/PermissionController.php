<?php

namespace App\Http\Controllers;

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
                'permission' => $permission,

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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
