<?php

namespace App\Http\Controllers\Front;

use App\Services\Back\PortfolioImageServices;
use App\Services\Back\PortfoliosServices;
use App\Services\Back\SettingsServices;
use Illuminate\Http\Request;

class FrontAboutController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;
    private PortfolioImageServices $portfolioImageServices;
    private SettingsServices $settingsServices;

    public function __construct(PortfolioImageServices $portfolioImageServices, SettingsServices $settingsServices)
    {
        $this->viewFolder = 'Front/About_v';
        $this->portfolioImageServices = $portfolioImageServices;
        $this->settingsServices = $settingsServices;
        $settings = $this->settingsServices->getAllData()->first();
        if (!empty($settings)) {
            $companyName = explode(" ", $settings->company_name);
            cache()->put("siteData", [
                'settings' => $settings,
                'companyName' => $companyName,
            ]);
        }

    }

    public function index()
    {
        $portfolioImages = $this->portfolioImageServices->getAllData([['isActive', '=', 1]])->first();
        if ($portfolioImages) {
            $image = "uploads/Back/FPortfolios_v/" . $portfolioImages->img_url;
        } else {
            $image = 'assets/dist/img/alomasterLogo.svg';
        }


        $viewData = [
            'viewFolder' => $this->viewFolder,
            'portfoliosImages' => $image
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
