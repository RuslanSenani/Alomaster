<?php

namespace App\Http\Controllers\Back;



use App\Models\DbModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder = "";
    private DbModel $dbModel;

    public function __construct(DbModel $dbModel)
    {
        $this->viewFolder = "Back/Models_v";
        $this->dbModel = $dbModel;
    }

    public function index()
    {
        $modelList = $this->dbModel::all();

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => "list",
            'pageName' => "Modellər",
            'modelList' => $modelList,
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
            'subviewFolder' => "add",
            'pageName' => "Modellər",
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);


    }

    /**
     * Store a newly created resource in uploads.
     */
    public function store(Request $request)
    {

        try {
            $validatedData = $request->validate(
                [
                    'modelName' => 'required|string|max:255',
                ]
            );
            $exising = $this->dbModel::withTrashed()->where('name', $validatedData['modelName'])->first();
            if ($exising) {
                if ($exising->trashed()) {
                    $exising->restore();
                    $exising->update($validatedData);
                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('models.index');
                } else {
                    Alert::error('Xəta', '111 Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(5000);
                }
            }

            $this->dbModel->name = $validatedData['modelName'];
            $this->dbModel->save();
            return redirect()->route('models.index');

        } catch (QueryException $exception) {

            if ($exception->getCode() == "23000") {
                Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(5000);
            }
            else {
                Alert::error('Xəta', 'Gözlənilməz baza xətası yarandı: ' . $exception->getMessage())
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(3000);
            }


            return redirect()->route('models.create');
        } catch (ValidationException $exception) {

            foreach ($exception->errors() as $field => $messages) {
                foreach ($messages as $error) {
                    Alert::error('Error', 'Record Inserted Failed!' . $error)
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                }
            }
            return redirect()->back()->withInput();
        }

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
            $getModel = $this->dbModel->findOrFail($id);
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => 'Redaktə Et',
                'model' => $getModel,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            return redirect()->route('models.index');
        }
    }

    /**
     * Update the specified resource in uploads.
     */
    public function update(Request $request, string $id)
    {

        try {

            $model = $this->dbModel->findOrFail($id);

            if (!$model) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate([
                'modelName' => 'required|string|max:255',
            ]);

            Alert::success('Success', 'Record Inserted Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $model->name = $validatedData['modelName'];
            $model->update($validatedData);
            return redirect()->route('models.index');

        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $message) {
                foreach ($message as $error) {
                    Alert::error('Xəta', $error)->toToast()->autoclose(3000);

                }
            }
            return redirect()->route('models.index');
        } catch (ModelNotFoundException $ex) {
            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('models.edit', $id);
        }
    }

    /**
     * Remove the specified resource from uploads.
     */
    public function destroy(string $id)
    {
        $deleted = $this->dbModel->destroy($id);
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Modellər ',
            'modelList' => $this->dbModel::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'home')->with($viewData);


    }
}
