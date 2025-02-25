<?php

namespace App\Http\Controllers\Front;

use App\Contracts\IAlert;
use App\Services\Back\FileUploadService;
use App\Services\Back\SettingsServices;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class FrontSettingController
{
    /**
     * Display a listing of the resource.
     */
    private string $viewFolder = "";
    private string $directoryPath = "";
    private SettingsServices $settingsServices;
    private FileUploadService $fileUploadService;
    private IAlert $alertService;

    public function __construct(FileUploadService $fileUploadService, SettingsServices $settingsServices, IAlert $alertService)
    {
        $this->viewFolder = "Front/Settings_v";
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->fileUploadService = $fileUploadService;
        $this->settingsServices = $settingsServices;
        $this->alertService = $alertService;
    }

    public function index()
    {
        $item = $this->settingsServices->getAllData();

        if ($item->isNotEmpty()) {
            return redirect()->route("settings.edit", $item[0]->id);
        }

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

        try {
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255',
                'phone_1' => 'required|string|max:15',
                'email' => 'required|string|email|max:100|unique:settings,email',
            ]);

            $others = $request->only([
                'phone_2', 'fax_1', 'fax_2', 'address', 'about_us', 'mission', 'vision', 'instagram', 'tik_tok', 'youtube', 'facebook'
            ]);


            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 35);

            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $others['logo'] = $uploadFile->getData()->fileName;
            }

            $insertableData = array_merge($validatedData, $others);
            $inserted = $this->settingsServices->saveData($insertableData);

        } catch (\Exception $exception) {
            $this->alertService->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->back()->withInput();
        }

        return redirect()->route('settings.edit', $inserted->id);

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

        try {
            $setting = $this->settingsServices->getDataById($id);

        } catch (\Exception $exception) {
            return redirect()->route('settings.index');
        }

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'edit',
            'pageName' => 'Setting',
            'setting' => $setting,
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $settings = $this->settingsServices->getDataById($id);

        try {
            $validatedData = $request->validate([
                'company_name' => 'required|string|max:255',
                'phone_1' => 'required|string|max:15',
                'email' => 'required|string|email|max:100',
            ]);

            $others = $request->only([
                'phone_2', 'fax_1', 'fax_2', 'address', 'about_us', 'mission', 'vision', 'instagram', 'tik_tok', 'youtube', 'facebook'
            ]);


            $uploadFile = $this->fileUploadService->uploadPicture($request, $this->directoryPath, 150, 100);

            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $this->fileUploadService->fileDelete($settings->logo);
                $others['logo'] = $uploadFile->getData()->fileName;
            }

            $insertableData = array_merge($validatedData, $others);
            $this->settingsServices->updateData($id, $insertableData);

        } catch (\Exception $exception) {
            $this->alertService->error("Xəta", $exception->getMessage(), 30000);
            return redirect()->route('settings.edit', $id);
        }

        return redirect()->route('settings.edit', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
