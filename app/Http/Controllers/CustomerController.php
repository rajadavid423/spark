<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Create Customer|View Customer|Edit Customer|Delete Customer')->only('index');
        $this->middleware('permission:Create Customer')->only('create', 'store');
        $this->middleware('permission:View Customer')->only('show');
        $this->middleware('permission:Edit Customer')->only('edit', 'update');
        $this->middleware('permission:Delete Customer')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Customer::orderByDesc('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $user = Auth::user();
                    $button = '<div class="d-flex justify-content-center">';
                    if ($user->can('View Customer')) {
                        $button .= '<a href="' . route('customer.show', $data->id) . '"><img src="' . url('images/view.png') . '"></a>';
                    }

                    if ($user->can('Edit Customer')) {
                        $button .= '<a href="' . route('customer.edit', $data->id) . '"><img src="' . url('images/edit.png') . '" class="ml-3"></a>';
                    }

                    if ($user->can('Delete Customer')) {
                        $button .= '<a onclick = "commonDelete(\'' . route('customer.destroy', $data->id) . '\')" ><img src="' . url('images/delete.png') . '" class="ml-3"></a>';
                    }

                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('customer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        $customer = NULL;

        $sequenceNo = DB::select('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "' . env("DB_DATABASE") . '" AND TABLE_NAME = "customers"');
        $sequenceNo = collect($sequenceNo)->pluck('AUTO_INCREMENT')[0];

        if (strlen((string)$sequenceNo) < 2) {
            $sequenceNo = 'CUS00' . $sequenceNo;
        } elseif (strlen((string)$sequenceNo) < 3) {
            $sequenceNo = 'CUS0' . $sequenceNo;
        } else {
            $sequenceNo = 'CUS' . $sequenceNo;
        }

        return view('customer.create', compact('customer', 'sequenceNo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerRequest $request
     * @return RedirectResponse
     */
    public function store(CustomerRequest $request)
    {
        try {
            Customer::create($request->all());

            return redirect()->route("customer.index")->with("success", "Customer Created Successfully.");
        } catch (Exception $exception) {
            info('Error::Place@CustomerController@store - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function show(Customer $customer)
    {
        return view('customer.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Customer $customer
     * @return Application|Factory|View
     */
    public function edit(Customer $customer)
    {
        return view('customer.create', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        try {
            $input = $request->all();

            $customer->update($input);

            return redirect()->route("customer.index")->with("success", "Customer Updated Successfully.");
        } catch (Exception $exception) {
            info('Error::Place@CustomerController@update - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Customer $customer
     * @return Response
     */
    public function destroy(Customer $customer)
    {
        try {
            $customer->delete();
            return response(['status' => 'warning', 'message' => 'Customer Deleted Successfully.']);
        } catch (Exception $exception) {
            info('Error::Place@CustomerController@destroy - ' . $exception->getMessage());
            return response(['message' => 'Something went wrong!']);
        }
    }
}
