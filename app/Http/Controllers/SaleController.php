<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Jobs\NewSaleNotificationJob;
use App\Mail\NewSaleMailNotification;
use App\Models\Customer;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Sales');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sale::with('customer', 'employee')->orderByDesc('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('customer', function ($data) {
                    return $data->customer ? $data->customer->name : '-';
                })
                ->editColumn('employee', function ($data) {
                    return $data->employee ? $data->employee->name : '-';
                })
                ->editColumn('date', function ($data) {
                    return $data->date ? Carbon::parse($data->date)->format('d-m-Y') : '-';
                })
                ->editColumn('payment_due_date', function ($data) {
                    return $data->payment_due_date ? Carbon::parse($data->payment_due_date)->format('d-m-Y') : '-';
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex justify-content-center">';
                    $button .= '<a href="' . route('sale.show', $data->id) . '"><img src="' . url('images/view.png') . '"></a>';
                    $button .= '<a href="' . route('sale.edit', $data->id) . '"><img src="' . url('images/edit.png') . '" class="ml-3"></a>';
                    $button .= '<a onclick = "commonDelete(\'' . route('sale.destroy', $data->id) . '\')" ><img src="' . url('images/delete.png') . '" class="ml-3"></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('sale.index');
    }


    public function create()
    {
        $sale = NULL;
        $customers = Customer::all();
        $employees = User::all();
        $categories = ProductCategory::all();
        $products = Product::all();

        $sequenceNo = DB::select('SELECT AUTO_INCREMENT FROM information_schema.TABLES WHERE TABLE_SCHEMA = "' . env("DB_DATABASE") . '" AND TABLE_NAME = "sales"');
        $sequenceNo = collect($sequenceNo)->pluck('AUTO_INCREMENT')[0];

        if (strlen((string)$sequenceNo) < 2) {
            $sequenceNo = 'INV00' . $sequenceNo;
        } elseif (strlen((string)$sequenceNo) < 3) {
            $sequenceNo = 'INV0' . $sequenceNo;
        } else {
            $sequenceNo = 'INV' . $sequenceNo;
        }

        return view('sale.create', compact('sale', 'customers', 'employees', 'categories', 'sequenceNo', 'products'));
    }


    public function store(SaleRequest $request)
    {
        DB::beginTransaction();
        try {
            $sale = Sale::create($request->all());

            foreach ($request->product_details as $detail) {
                $detail['sale_id'] = $sale->id;
                SaleDetail::create($detail);
            }

            dispatch(new NewSaleNotificationJob($sale->id));

            DB::commit();
            return redirect()->route("sale.index")->with("success", "Sale Created Successfully.");
        } catch (Exception $exception) {
            DB::rollBack();
            info('Error::Place@SaleController@store - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }


    public function show(Sale $sale)
    {
        return view('sale.show', compact('sale'));
    }


    public function edit(Sale $sale)
    {
        $customers = Customer::all();
        $employees = User::all();
        $categories = ProductCategory::all();
        $products = Product::all();

        return view('sale.create', compact('sale', 'customers', 'employees', 'categories', 'products'));
    }


    public function update(SaleRequest $request, Sale $sale)
    {
        DB::beginTransaction();
        try {
            $sale->update($request->all());

            $sale->saleDetails()->delete();

            foreach ($request->product_details as $detail) {
                $detail['sale_id'] = $sale->id;
                SaleDetail::create($detail);
            }

            DB::commit();
            return redirect()->route("sale.index")->with("success", "Sale Updated Successfully.");
        } catch (Exception $exception) {
            DB::rollBack();
            info('Place@SaleController@update - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }


    public function destroy(Sale $sale)
    {
        try {
            $sale->delete();
            return response(['status' => 'warning', 'message' => 'Sale Deleted Successfully.']);
        } catch (Exception $exception) {
            info('Error::Place@SaleController@destroy - ' . $exception->getMessage());
            return response(['message' => 'Something went wrong!']);
        }
    }
}
