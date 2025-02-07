<?php

namespace App\Http\Controllers\Front;

use App\Contracts\IFrontNewsRepository;
use App\Services\Back\FrontNewsServices;
use Illuminate\Http\Request;

class FrontNewsController
{
    /**
     * Display a listing of the resource.
     */
    private $viewFolder;
    private FrontNewsServices $newsServices;


    public function __construct(FrontNewsServices $newsServices)
    {
        $this->viewFolder = "Front/News_v";
        $this->newsServices = $newsServices;
    }

    public function index()
    {

        $news = $this->newsServices->getAllData();

        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Xəbərlər",
            'news' => $news,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "add",
            "pageName" => "Xəbərlər Əlavə Et",
        ];
        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
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
