<?php

namespace App\Http\Controllers\Front;

use App\Services\Back\AlertServices;
use App\Services\Back\ContactServices;
use App\Services\Back\SettingsServices;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\RateLimiter;

class FrontContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private SettingsServices $services;
    private ContactServices $contactServices;

    public function __construct(SettingsServices $services, ContactServices $contactServices)
    {
        $this->viewFolder = 'Front/';
        $this->services = $services;
        $this->contactServices = $contactServices;
        $settings = $this->services->getAllData()->first();
        cache()->put("settings", $settings);

    }

    public function index()
    {

        $viewData = [
            'viewFolder' => $this->viewFolder . "Contact_v",

        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);
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
        $validatedData = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|phone:AZ',
            'email' => 'required|email:rfc,dns',
            'subject' => 'required|string|max:50',
            'message' => 'required|string',
        ]);


        $key = 'contact:' . $request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $retryAfter = RateLimiter::availableIn($key);
            return response()->view('errors.429', ['retryAfter' => $retryAfter], 429);
        }
        RateLimiter::hit($key, 60);

        $validatedData['ip'] = $request->ip();
        $this->contactServices->saveData($validatedData);
        return redirect()->back()->with('success', 'Mesajınız gönderildi!');
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
}
