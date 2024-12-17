<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StockOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private  string $viewFolder="Back/StockOut_v";

    public function index()
    {
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder'=>'list',
            'pageName'=>'Stock Out',
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'add',
            'pageName' => 'Stock Out',
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with( $viewData);

    }

    /**
     * Store a newly created resource in uploads.
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
        //
    }

    /**
     * Update the specified resource in uploads.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from uploads.
     */
    public function destroy(string $id)
    {
        //
    }
}
