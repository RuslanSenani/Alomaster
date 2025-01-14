<?php

namespace App\Http\Controllers\Auth;

use App\LogRepo\LogManager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{


    private User $userModel;
    private Role $roleModel;

    public function __construct(User $userModel, Role $roleModel)
    {
        $this->roleModel = $roleModel;
        $this->userModel = $userModel;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request, LogManager $logManager)
    {

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = $request->only('email', 'password');
            $remember = $request->has('remember');
            $user = User::where('email', $request->email)->first();

            $throttleKey = 'login:' . $user->id . '|' . $request->input('email') . '|' . $request->ip();


            if (RateLimiter::tooManyAttempts($throttleKey, 3)) {
                $retryAfter = RateLimiter::availableIn($throttleKey);
                RateLimiter::hit($throttleKey, 300);
                return response()->view('errors.429', ['retryAfter' => $retryAfter], 429);
            }

            if (!$user) {
                $logManager->log("Error", "Bu e-mail adresi ilə qeydiyyat tapılmadı", ['user_ip' => request()->ip(), 'user_agent' => request()->userAgent()]);
                return back()->withErrors(['email' => 'Bu e-mail adresi ilə qeydiyyat tapılmadı.'])->withInput();
            }

            if (!Hash::check($request->password, $user->password)) {
                $logManager->log("Error", "Girdiyiniz şifrə səhvdir", ['user_id' => $user->id, 'user_name' => $user->full_name, 'user_ip' => request()->ip(), 'user_agent' => request()->userAgent()]);
                RateLimiter::hit($throttleKey, 300);
                return back()->withErrors(['password' => 'Girdiyiniz şifrə səhvdir.'])->withInput();

            }
            if (Auth::attempt($credentials, $remember)) {

                if (!$user->isActive) {
                    Auth::logout();
                    return redirect()->route('login')->with('error', $user->email . ' Sizin Hesab Aktiv Deyil');
                }

                RateLimiter::clear($throttleKey);
                $request->session()->regenerate();
            } else {
                RateLimiter::hit($throttleKey, 300);
                return redirect()->back()->withErrors(['status' => 'Invalid credentials']);

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




}
