<?php

namespace App\Http\Controllers\Back;



use App\Models\Product;
use App\Models\Unit;
use App\Services\Back\FileUploadService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    private string $viewFolder = "";
    private string $directoryPath ;
    private Product $productModel;
    private Unit $unitModel;


    public function __construct(Product $product, Unit $unit)
    {

        $this->viewFolder = "Back/Product_v";
        $this->directoryPath = "uploads/" . $this->viewFolder;
        $this->productModel = $product;
        $this->unitModel = $unit;
    }

    public function index()
    {
        $products = $this->productModel->with(['unit'])->get();


        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Məhsullar',
            'productList' => $products,

        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = $this->productModel::all();
        $units = $this->unitModel::all();

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'add',
            'pageName' => 'Məhsul Əlavə Et',
            'productList' => $products,
            'units' => $units,

        ];

        return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

    }

    /**
     * Store a newly created resource in uploads.
     */
    public function store(Request $request, FileUploadService $fileUploadService)
    {


        try {
            $validatedData = $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'code' => 'required|string|max:255',
                    'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                    'info' => 'max:255',
                    'unit' => 'required|string|max:10',

                ]
            );
            $exising = $this->productModel::withTrashed()
                ->where('product_name', $validatedData['name'])
                ->where('product_code', $validatedData['code'])
                ->first();

            if ($exising) {
                if ($exising->trashed()) {
                    $uploadFile = $fileUploadService->uploadPicture($request, $this->directoryPath, 355, 300);
                    if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                        $exising->product_img = $uploadFile->getData()->fileName;

                    }
                    $exising->product_description = $validatedData['info'] ?? null;
                    $exising->unit_id = $validatedData['unit'];

                    $exising->restore();

                    $exising->save();

                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('products.index');
                } else {
                    Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(5000);
                }
            }


            $uploadFile = $fileUploadService->uploadPicture($request, $this->directoryPath, 355, 300);
            if ($uploadFile->getStatusCode() === 200 && isset($uploadFile->getData()->fileName)) {
                $validatedData['image'] = $uploadFile->getData()->fileName;
                $this->productModel->product_img = $validatedData['image'];
            }

            $this->productModel->product_name = $validatedData['name'];
            $this->productModel->product_code = $validatedData['code'];
            $this->productModel->unit_id = $validatedData['unit'];
            $this->productModel->product_description = $validatedData['info'] ?? null;

            $this->productModel->save();

            return redirect()->route('products.index');

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


            return redirect()->route('products.create');
        } catch (ValidationException $exception) {

            Alert::error('Error', 'Record Inserted Failed!' . $exception->getMessage())
                ->position('top-right')
                ->toToast()
                ->autoclose(30000);

            return redirect()->back()->withInput();
        } catch (\Exception $exception) {

            Alert::error('Error', 'Something get wrong!' . $exception->getMessage())
                ->position('top-right')
                ->toToast()
                ->autoclose(30000);
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
            $getProduct = $this->productModel->with(['unit'])->findOrFail($id);
            $units = $this->unitModel::all();
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => 'Redaktə Et',
                'product' => $getProduct,
                'units' => $units,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('products.index');
        }
    }

    /**
     * Update the specified resource in uploads.
     */
    public function update(Request $request, string $id, FileUploadService $fileUploadService)
    {
        try {

            $product = $this->productModel->findOrFail($id);
            if (!$product) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'code' => 'required|string|max:255',
                'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'info' => 'max:255',
                'unit' => 'required|string|max:10',
            ]);

            Alert::success('Success', 'Record Inserted Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $getPath = $fileUploadService->uploadPicture($request, $this->directoryPath, 355, 300);
            if ($getPath->getStatusCode() === 200 && isset($getPath->getData()->fileName)) {
                $fileUploadService->fileDelete($product->product_img);
                $product->product_img = $getPath->getData()->fileName;
            }
            $product->product_name = $validatedData['name'];
            $product->product_code = $validatedData['code'];
            $product->unit_id = $validatedData['unit'];
            $product->product_description = $validatedData['info'] ?? null;

            $product->update($validatedData);

            return redirect()->route('products.index');

        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $message) {
                foreach ($message as $error) {
                    Alert::error('Xəta', $error)->toToast()->autoclose(3000);
                }
            }
            return redirect()->route('products.index');
        } catch (ModelNotFoundException $ex) {
            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('products.edit', $id);
        }
    }

    /**
     * Remove the specified resource from uploads.
     */
    public function destroy(string $id, FileUploadService $fileUploadService)
    {
        $product = $this->productModel->findOrFail($id);
        $deleted = $this->productModel->destroy($id);
        $fileUploadService->fileDelete($product->product_img);
        $product->product_img = '';
        $product->save();

        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Məhsul',
            'stockList' => $this->productModel::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'categories.index')->with($viewData);
    }



}
