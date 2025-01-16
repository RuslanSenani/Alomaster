<?php

namespace App\Http\Controllers\Back;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder = "";
    private User $userModel;
    private Role $roleModel;

    public function __construct(User $user, Role $role)
    {
        $this->viewFolder = "Back/Users_v";
        $this->userModel = $user;
        $this->roleModel = $role;
    }

    public function index()
    {
        $users = $this->userModel::where('email_verified_at', '!=', null)->get()->all();

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'İstifadəçilər',
            'users' => $users,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
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
        $user = $this->userModel->find($id);

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "edit",
            "pageName" => "İstifadəçi" . $user->full_name,
            "user" => $user,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showRateLimitedUsers(Request $request)
    {
        $viewData = $this->showLimitClear($request);

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

    }

    public function clearRateLimitedUsers(Request $request)
    {
        $user = $this->userModel::where('id', $request->user_id)->first();

        RateLimiter::clear('login:' . $user->id . '|' . $user->email . '|' . $request->ip());


        $viewData = $this->showLimitClear($request);
        return redirect()->back(302, [], 'rate.limited.users')->with($viewData);

    }

    /**
     * @param Request $request
     * @return array
     */
    public function showLimitClear(Request $request): array
    {
        $this->viewFolder = "Back/LogUsers_v";
        $users = $this->userModel::all();
        $rateLimitedUsers = [];
        foreach ($users as $user) {

            $throttleKey = 'login:' . $user->id . '|' . $user->email . '|' . $request->ip();

            if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
                $rateLimitedUsers[] = [
                    'user' => $user,
                    'waitTime' => RateLimiter::availableIn($throttleKey)
                ];
            }
        }


        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => "list",
            'pageName' => "Vaxt Limitinə Düşən İstifadəçilər",
            'rateLimitedUsers' => $rateLimitedUsers,
        ];
        return $viewData;
    }


    public function manageRoles(string $userId)
    {
        $user = $this->userModel->findOrFail($userId);
        $roles = $this->roleModel->orderBy('id', 'desc')->get();
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'role',
            'pageName' => 'İstifadəçi İcazələr',
            'user' => $user,
            'roles' => $roles,

        ];
        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

    }

    public function updateRoles(Request $request, string $userId)
    {
        try {
            $user = $this->userModel->findOrFail($userId);
            $validatedData = $request->validate([
                'roles' => 'required|array',
            ]);
            $roles = $validatedData['roles'] ?? [];
            $user->syncRoles($roles);
            Alert::success('Uğurlu', 'Rollar uğurla yeniləndi!')->toToast()->autoclose(3000);

        } catch (ValidationException $ex) {
            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
        }




        return redirect()->route('users.index')->with('success', 'Yetkiler başarıyla güncellendi.');
    }

}
