<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyEmail;
use App\Models\User;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class VerificationController extends Controller
{
    use VerifiesEmails;

    private User $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function resendVerificationEmail(Request $request)
    {
        $user = Auth::user();

        if ($user && !$user->hasVerifiedEmail()) {

            Mail::to($user->email)->send(new VerifyEmail($user));


            return back()->with('resent', true);
        }

        return back()->withErrors(['email' => 'E-posta zaten doğrulanmış veya kullanıcı bulunamadı.']);
    }
}
