<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;

class FrontSettingController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder = "";

    public function __construct()
    {
        $this->viewFolder = "Front/Settings_v";
    }

    public function index()
    {
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'add',
            'pageName' => 'Setting',
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);
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
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'edit',
            'pageName' => 'Setting',
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);
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
