<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\RateLimiter;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder = "";
    private User $userModel;

    public function __construct(User $user)
    {
        $this->viewFolder = "Back/LogUsers_v";
        $this->userModel = $user;
    }

    public function index()
    {
        //
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
        //
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

}
