<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\User;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use ProtoneMedia\LaravelCrossEloquentSearch\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $customer = Customer::count();
        $employee = User::count();
        $product = Product::count();
        $user = auth()->user();
        if ($user->can('Manager Dashboard')) {
            return view('home', compact('user', 'customer', 'employee', 'product'));
        } elseif ($user->can('Employee Dashboard')) {
            return view('home', compact('user', 'customer', 'employee', 'product'));

        } else {
            return view('home', compact('user', 'customer', 'employee', 'product'));
        }
    }

    public function globalSearch(Request $request)
    {
        $searchResult = Search::add(Product::class, ['name'])
            ->add(Customer::class, ['name', 'customer_code'])
            ->add(User::class, ['name', 'employee_code', 'email'])
            ->includeModelType('ModelType')
            ->search($request->searchValue);

        $data = [];
        foreach ($searchResult as $result) {
            if ($result->ModelType == 'Product') {
                $data[] = '<a class="dropdown-item" href="' . route('product.show', $result->id) . '">Product : ' . $result->name . '</a>';
            } elseif ($result->ModelType == 'Customer') {
                $data[] = '<a class="dropdown-item" href="' . route('customer.show', $result->id) . '">Customer : ' . $result->name . '</a>';
            } elseif ($result->ModelType == 'User') {
                $data[] = '<a class="dropdown-item" href="' . route('employee.show', $result->id) . '">Employee : ' . $result->name . '</a>';
            }
        }

        return response(['data' => $data]);
    }
}
