<?php

namespace App\Http\Controllers\Back;

use App\Services\Back\AlertServices;
use App\Services\Back\ContactServices;
use App\Services\Back\FileUploadService;
use App\Services\Back\RankServices;
use App\Services\Back\SlidersServices;
use App\Services\Back\StatusServices;
use Illuminate\Http\Request;

class BackContactController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder;

    private ContactServices $contactServices;
    private RankServices $rankServices;
    private StatusServices $statusServices;


    public function __construct(ContactServices $contactServices, RankServices $rankServices, StatusServices $statusServices)
    {
        $this->viewFolder = 'Back/FContacts_v';
        $this->contactServices = $contactServices;
        $this->rankServices = $rankServices;
        $this->statusServices = $statusServices;

    }

    public function index()
    {
        $contacts = $this->contactServices->getAllData([], ['id', 'asc']);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Contacts",
            'contacts' => $contacts,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
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
        $contact = $this->contactServices->getDataById($id);
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "show",
            "pageName" => "Contacts",
            "contact" => $contact,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
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

    public function isReadable(string $id)
    {
        $contacts = $this->contactServices->getDataById($id);
        return $this->statusServices->setIsReadable($contacts, $id);

    }

}
