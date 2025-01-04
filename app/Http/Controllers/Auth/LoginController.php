<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
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
            if (Auth::attempt($credentials, $remember)) {
                $request->session()->regenerate();
                Alert::success("Success","Ugurlu Giris Etdiniz")
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(5000);
            }else{

                Alert::error("Xeta","Istifadeci adi ve ya sifre duzhun deyil yeniden ceht edin")
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(50000);
                return redirect()->back();
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
        return redirect('/login');
    }
}
