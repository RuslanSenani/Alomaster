<?php

namespace App\Http\Controllers\Auth;


use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{

    private string $viewFolder = "";
    private User $userModel;

    public function __construct(User $user)
    {
        $this->viewFolder = "auth.register";
        $this->userModel = $user;
    }

    public function showRegisterForm()
    {
        return view($this->viewFolder);
    }

    public function register(Request $request)
    {

        try {
            $request->validate([
                'username' => 'required|string|max:255|unique:users,user_name',
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);
            $user = User::create([
                'user_name' => $request->username,
                'full_name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'email_token' => Str::random(200),
            ]);


            sendEmailVerification($user);


            return redirect()->route('login')->with('status', "Uğurla Qeyd Oldunuz Zəhmət olmasa E-Poçtunuzu Yoxlayın");

        } catch (ValidationException $exception) {
            return back()->with('status',$exception->getMessage());
        } catch (\Exception $exception) {
//            'Qeydiyyat zamanı xəta baş verdi. Xahiş edirik, yenidən cəhd edin.'
            return back()->with('status',$exception->getMessage());

        }

    }

    public function verifyEmail($token)
    {
        $user = User::where('email_token', $token)->firstOrFail();
        if ($user) {
            $user->email_token = NULL;
            $user->email_verified_at = now();
            $user->save();
            Auth::logout();
            return redirect('login')->with('status', "E-Poçtunuz Uğurla Doğrulandı");
        }
        return redirect('login')->with('status', 'Xətalı Token');
    }
}
