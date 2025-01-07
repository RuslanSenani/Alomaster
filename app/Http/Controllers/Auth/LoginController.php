<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember');
            $user = User::where('email', $request->email)->first();


            if (!$user) {
                return back()->withErrors(['email' => 'Bu e-mail adresi ilə qeydiyyat tapılmadı.'])->withInput();
            }

            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors(['password' => 'Girdiyiniz şifrə səhvdir.'])->withInput();

            }
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
            }

        } catch (\Exception $exception) {
            Alert::error($exception->getMessage())
                ->position('top-right')
                ->toToast()
                ->autoclose(50000);
        }
        return redirect()->intended('/admin');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Alert::success("Success", "Uğurla Çıxış Etdiniz")
            ->position('top-right')
            ->toToast()
            ->autoclose(3000);
        return redirect('/login');
    }


    protected function throttleKey()
    {
        return strtolower(request('email')).'|'.request()->ip();
    }
}
