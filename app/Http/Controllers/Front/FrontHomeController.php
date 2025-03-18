<?php

namespace App\Http\Controllers\Front;

use App\Services\Back\FileUploadService;
use App\Services\Back\ReferencesServices;
use App\Services\Back\ServiceServices;
use App\Services\Back\SettingsServices;
use App\Services\Back\SlidersServices;
use Illuminate\Routing\Controller;

class FrontHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;
    private SettingsServices $services;
    private SlidersServices $slidersServices;
    private ServiceServices $serviceServices;
    private ReferencesServices $referencesServices;

    public function __construct(SettingsServices $services, SlidersServices $slidersServices, ServiceServices $serviceServices, ReferencesServices $referencesServices)
    {
        $this->viewFolder = "Front/";
        $this->services = $services;
        $this->slidersServices = $slidersServices;
        $this->serviceServices = $serviceServices;
        $this->referencesServices = $referencesServices;
        $settings = $this->services->getAllData()->first();

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
        $viewData = [
            'viewFolder' => $this->viewFolder . "Blank_v",
            'subviewFolder' => 'homepage'
        ];
        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index");
    }

    public function work_area()
    {

        $sliders = $this->slidersServices->getAllData([['isActive', '=', 1]]);
        $services = $this->serviceServices->getAllData([['isActive', '=', 1]]);
        $references = $this->referencesServices->getAllData([['isActive', '=', 1]]);

        $viewData = [
            'viewFolder' => $this->viewFolder . "Home_v",
            'sliders' => $sliders,
            'services' => $services,
            'references' => $references
        ];

        return view("{$viewData['viewFolder']}.index")->with($viewData);

    }
//
//    public function services_details(string $id)
//    {
//        $service = $this->serviceServices->getDataById($id);
//        $services = $this->serviceServices->getAllData([
//            ['isActive', '=', 1],
//            ['id', '!=', $id]
//        ]);
//
//        $viewData = [
//            'viewFolder' => $this->viewFolder . "Services_details_v",
//            'services' => $services,
//            'service' => $service
//        ];
//
//        return view("{$viewData['viewFolder']}.index")->with($viewData);
//    }


}
