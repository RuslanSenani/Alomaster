<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

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


        // try {
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $this->userModel->user_name = $validatedData['username'];
        $this->userModel->full_name = $validatedData['name'];
        $this->userModel->email = $validatedData['email'];
        $this->userModel->password = Hash::make($validatedData['password']);
        $this->userModel->save();
        return redirect()->route('login')->with('success', 'Kayıt başarılı!');
//        } catch (QueryException $exception) {


//            if ($exception->getCode() == "23000") {
//                Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
//                    ->position('top-right')
//                    ->toToast()
//                    ->autoclose(50000);
//            } else {
//                Alert::error('Xəta', 'Gözlənilməz baza xətası yarandı: ' . $exception->getMessage())
//                    ->position('top-right')
//                    ->toToast()
//                    ->autoclose(30000);
//            }
        //} catch (Exception $exception) {

//            Alert::error('Error', 'Record Inserted Failed!' . $exception->getMessage())
//                ->position('top-left')
//                ->toToast()
//                ->autoclose(30000);
//
//            return redirect()->route('register')->withInput();
        //}
        // return redirect()->route('register')->withInput();
    }
}
