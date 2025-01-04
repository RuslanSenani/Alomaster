<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use Throwable;


class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {

        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
                'token' => 'required',
            ]);


            $response = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function ($user) use ($request) {
                    $user->forceFill([
                        'password' => Hash::make($request->password),
                    ])->save();


                    event(new PasswordReset($user));
                }
            );

            return $response == Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', trans($response))
                : back()->withErrors(['email' => trans($response)]);
        } catch (ValidationException $validationException) {

            return back()->withErrors($validationException->validator->errors())->withInput();

        } catch (Throwable $throwable) {
            return back()->withErrors(['error' => 'Bir xəta meydana gəldi. Xahiş edirik, yenidən cəhd edin.'])->withInput();

        }
    }
}
