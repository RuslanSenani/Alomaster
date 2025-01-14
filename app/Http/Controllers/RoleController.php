<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder = "";
    private Role $roleModel;
    private Permission $permissionModel;

    public function __construct(Role $role, Permission $permission)
    {
        $this->roleModel = $role;
        $this->permissionModel = $permission;
        $this->viewFolder = "Back/Roles_v";


    }

    public function index()
    {
        $roleList = $this->roleModel::all();

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Rol',
            'roleList' => $roleList,

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
            'pageName' => 'Rol',
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
                    'roleName' => 'required|string|unique:roles,name',
                ]
            );

            $this->roleModel->name = $validatedData['roleName'];
            $this->roleModel->save();
            return redirect()->route('roles.index');

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


            return redirect()->route('roles.create');
        } catch (ValidationException $exception) {
            Alert::error('Error', 'Record Inserted Failed!' . $exception->getMessage())
                ->position('top-right')
                ->toToast()
                ->autoclose(300000);

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
            $role = $this->roleModel->findOrFail($id);
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => "Redaktə Et",
                'role' => $role,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('roles.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $role = $this->roleModel->findOrFail($id);
            if (!$role) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate(
                [
                    'roleName' => 'required|string|unique:roles,name',
                ]
            );
            Alert::success('Success', 'Record Updated Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $role->name = $validatedData['roleName'];

            $role->update($validatedData);

            return redirect()->route('roles.index');

        } catch (ValidationException $exception) {

            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);

            return redirect()->route('roles.edit', $id);

        } catch (ModelNotFoundException $ex) {

            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('roles.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->roleModel->destroy($id);
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'roleList' => $this->roleModel::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'roles.index')->with($viewData);
    }


    public function managePermissions(string $roleId)
    {
        $role = $this->roleModel::findOrFail($roleId);
        $permissions = $this->permissionModel::all();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'permission',
            'pageName' => 'İcazələr',
            'role' => $role,
            'permissions' => $permissions,

        ];
        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

    }

    public function updatePermissions(Request $request, string $roleId)
    {
        try {
            $role = $this->roleModel::findOrFail($roleId);
            $validateData = $request->validate([
                'permissions' => 'required|array',
            ]);
            $permissions = $validateData['permissions'] ?? [];
            $role->syncPermissions($permissions);
            Alert::success('Uğurlu', 'İcazələr uğurla elavə edildi')->toToast()->autoclose(3000);
        } catch (ValidationException $ex) {
            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
        }




        return redirect()->route('roles.index')->with('success', 'Yetkiler başarıyla güncellendi.');
    }
}
