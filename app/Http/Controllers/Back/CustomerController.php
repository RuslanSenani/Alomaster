<?php

namespace App\Http\Controllers\Back;


use App\Http\Controllers\QueryException;
use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\ValidationException;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private string $viewFolder;
    private Customer $customerModel;

    public function __construct(Customer $customer)
    {
        $this->customerModel = $customer;
        $this->viewFolder = 'Back/Customer_v';
    }

    public function index()
    {
        $customerList = $this->customerModel::all();
        $viewData = [
            "viewFolder" => $this->viewFolder,
            "subViewFolder" => "list",
            "pageName" => "Müştərilər",
            "customers" => $customerList,
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
            "pageName" => "Müştəri",
        ];

        return view("{$viewData['viewFolder']}.{$viewData['subViewFolder']}.index")->with($viewData);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {
            $validatedData = $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'code' => 'nullable|string|max:20',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|string|max:20',
                ]
            );


            $exising = $this->customerModel::withTrashed()->where('name', $validatedData['name'])->first();


            if ($exising) {
                if ($exising->trashed()) {
                    $exising->code = $validatedData['code'];
                    $exising->email = $validatedData['email'];
                    $exising->phone = $validatedData['phone'];
                    $exising->restore();
                    $exising->save();
                    Alert::success('Success', 'Record Inserted Successfully!')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(3000);
                    return redirect()->route('customers.index');
                } else {
                    Alert::error('Xəta', 'Bu dəyər artıq mövcuddur! Zəhmət olmasa başqa bir dəyər girin.')
                        ->position('top-right')
                        ->toToast()
                        ->autoclose(5000);
                }
            }

            $this->customerModel->name = $validatedData['name'];
            $this->customerModel->code = $validatedData['code'];
            $this->customerModel->email = $validatedData['email'];
            $this->customerModel->phone = $validatedData['phone'];
            $this->customerModel->save();
            return redirect()->route('customers.index');

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


            return redirect()->route('customers.create');
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
            $customerList = $this->customerModel->findOrFail($id);
            $viewData = [
                'viewFolder' => $this->viewFolder,
                'subviewFolder' => "edit",
                'pageName' => 'Redaktə Et',
                'customerList' => $customerList,

            ];

            return view("{$viewData['viewFolder']}.{$viewData['subviewFolder']}.index")->with($viewData);

        } catch (\Exception $exception) {
            Alert::error('Xəta', $exception->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('customers.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {

            $customer = $this->customerModel->findOrFail($id);
            if (!$customer) {
                throw new ModelNotFoundException("Hər hansı məlumat tapılmadı");
            }

            $validatedData = $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'code' => 'nullable|string|max:20',
                    'email' => 'required|email|max:255',
                    'phone' => 'required|string|max:20',
                ]
            );

            Alert::success('Success', 'Record Updated Successfully!')
                ->position('top-right')
                ->toToast()
                ->autoclose(3000);

            $customer->name = $validatedData['name'];
            $customer->code = $validatedData['code'];
            $customer->email = $validatedData['email'];
            $customer->phone = $validatedData['phone'];
            $customer->update($validatedData);

            return redirect()->route('customers.index');

        } catch (ValidationException $exception) {
            foreach ($exception->errors() as $message) {
                foreach ($message as $error) {
                    Alert::error('Xəta', $error)->toToast()->autoclose(3000);
                }
            }
            return redirect()->route('customers.index');
        } catch (ModelNotFoundException $ex) {
            Alert::error('Xəta', $ex->getMessage())->toToast()->autoclose(3000);
            return redirect()->route('customers.edit', $id);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = $this->customerModel->destroy($id);
        $viewData = [
            'viewFolder' => $this->viewFolder,
            'subviewFolder' => 'list',
            'pageName' => 'Müştərilər',
            'stockList' => $this->customerModel::all(),
        ];
        if ($deleted) {

            Alert::success('Success', 'Record deleted successfully!')->position('top-right')->toToast()->autoclose(3000);
        } else {
            Alert::error('Error', 'Something went wrong!')->position('top-right')->toToast()->autoclose(3000);
        }
        return redirect()->back(302, [], 'customers.index')->with($viewData);
    }
}
