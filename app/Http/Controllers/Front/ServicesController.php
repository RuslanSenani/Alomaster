<?php

namespace App\Http\Controllers\Front;

use App\Services\Back\ReferencesServices;
use App\Services\Back\ServiceServices;
use App\Services\Back\SlidersServices;
use Illuminate\Http\Request;

class ServicesController
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;
    private ServiceServices $serviceServices;
    private ReferencesServices $referencesServices;

    public function __construct(ServiceServices $serviceServices, ReferencesServices $referencesServices)
    {
        $this->viewFolder = 'Front/';
        $this->serviceServices = $serviceServices;
        $this->referencesServices = $referencesServices;
    }

    public function index()
    {
        $services = $this->serviceServices->getAllData([['isActive', '=', 1]]);
        $references = $this->referencesServices->getAllData([['isActive', '=', 1]]);
        $viewData = [
            'viewFolder' => $this->viewFolder . "Services_v",
            'services' => $services,
            'references' => $references
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
