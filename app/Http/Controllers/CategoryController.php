<?php

namespace App\Http\Controllers;


use App\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder = "";
    private Category $category;


    public function __construct(Category $category)
    {
        $this->viewFolder = "Back/Category_v";
        $this->category = $category;
    }

    public function index()
    {
        $categoryList = $this->category::all();

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Kateqorialar',
            'categories' => $categoryList,
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
            'pageName' => 'Kateqoriya',
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
                    'categoryName' => 'required|string|regex:/^[a-zA-Z]+$/|max:255',
                ]
            );
            $exising = $this->category::withTrashed()->where('name', $validatedData['categoryName'])->first();
            if ($exising) {
                if ($exising->trashed()) {
                    $exising->restore();
                    $exising->update($validatedData);
                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('categories.index');
                } else {
                    Alert::error('Xəta', '111 Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(5000);
                }
            }

            $this->category->name = $validatedData['categoryName'];
            $this->category->save();
            return redirect()->route('categories.index');

        } catch (QueryException $exception) {

            if ($exception->getCode() == "23000") {
                Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(5000);
            } else {
                Alert::error('Xəta', 'Gözlənilməz baza xətası yarandı: ' . $exception->getMessage())
                    ->position('top-right')
                    ->toToast()
                    ->autoclose(3000);
            }


            return redirect()->route('categories.create');
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
            $getCategory = $this->category->findOrFail($id);
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => 'Redaktə Et',
                'category' => $getCategory,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('categories.index');
        }
    }

    /**
     * Update the specified resource in uploads.
     */
    public function update(Request $request, string $id)
    {


        try {

            $category = $this->category->findOrFail($id);
            if (!$category) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate([
                'categoryName' => 'required|string|max:255',
            ]);

            Alert::success('Success', 'Record Inserted Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $category->name = $validatedData['categoryName'];
            $category->update($validatedData);

            return redirect()->route('categories.index');

        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $message) {
                foreach ($message as $error) {
                    Alert::error('Xəta', $error)->toToast()->autoclose(3000);
                }
            }
            return redirect()->route('categories.index');
        } catch (ModelNotFoundException $ex) {
            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('categories.edit', $id);
        }
    }

    /**
     * Remove the specified resource from uploads.
     */
    public function destroy(string $id)
    {
        $deleted = $this->category->destroy($id);
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Kateqoriya',
            'stockList' => $this->category::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'categories.index')->with($viewData);

    }
}
