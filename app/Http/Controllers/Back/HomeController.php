<?php

namespace App\Http\Controllers\Back;


use Illuminate\Http\Client\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{


    private string $viewFolder = "Back/Home_v";

    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Home',
            'video' => asset("assets/img/alomaster/video/alomasterTanitim.mp4"),
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
