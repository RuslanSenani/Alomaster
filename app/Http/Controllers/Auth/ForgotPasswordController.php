<?php

namespace App\Http\Controllers\Auth;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;



class ForgotPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }


    public function sendResetLinkEmail(Request $request)
    {


        $request->validate([
            'email' => 'required|email'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Bu e-mail adresiylə qeyidli bir istifaəçi tapılmadı.']);
        }

        $token = Password::createToken($user);

        $resetUrl = route('password.reset', ['token' => $token, 'email' => $request->email]);

        $expiredAt = Carbon::now()->addMinutes(60);

        Mail::send('emails.password-reset', [
            'resetUrl' => $resetUrl,
            'expiredAt' => $expiredAt->format("H:i:s"),
            'text' => "Parol Sıfırlama",
            'username' => $user->full_name
        ], function (Message $message) use ($request) {
            $message->to($request->email)
                ->subject("Parol Sıfırlama");

        });

        return back()->with('status', 'Şifrə sıfırlama linki e-mail adresinizə göndərildi.');

    }

}
