<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Student;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Product');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::with('category')->orderByDesc('created_at')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('category', function ($data) {
                    return $data->category ? $data->category->name : '-';
                })
                ->editColumn('date', function ($data) {
                    return $data->date ? Carbon::parse($data->date)->format('d-m-Y') : '-';
                })
                ->addColumn('action', function ($data) {
                    $button = '<div class="d-flex justify-content-center">';
                    $button .= '<a href="' . route('product.show', $data->id) . '"><img src="' . url('images/view.png') . '"></a>';
                    $button .= '<a href="' . route('product.edit', $data->id) . '"><img src="' . url('images/edit.png') . '" class="ml-3"></a>';
                    $button .= '<a onclick = "commonDelete(\'' . route('product.destroy', $data->id) . '\')" ><img src="' . url('images/delete.png') . '" class="ml-3"></a>';
                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('product.index');
    }


    public function create()
    {
        $product = NULL;
        $categories = ProductCategory::all();

        return view('product.create', compact('product', 'categories'));
    }


    public function store(ProductRequest $request)
    {
        try {
            Product::create($request->all());

            return redirect()->route("product.index")->with("success", "Product Created Successfully.");
        } catch (Exception $exception) {
            info('Error::Place@ProductController@store - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }


    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }


    public function edit(Product $product)
    {
        $categories = ProductCategory::all();

        return view('product.create', compact('product', 'categories'));
    }


    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product->update($request->all());

            return redirect()->route("product.index")->with("success", "Product Updated Successfully.");

        } catch (Exception $exception) {
            info('Place@ProductController@update - ' . $exception->getMessage());
            return redirect()->back()->with("warning", "Something went wrong" . $exception->getMessage());
        }
    }


    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return response(['status' => 'warning', 'message' => 'Product Deleted Successfully.']);
        } catch (Exception $exception) {
            info('Error::Place@ProductController@destroy - ' . $exception->getMessage());
            return response(['message' => 'Something went wrong!']);
        }
    }

    public function getProductList($categoryId)
    {
        $products = Product::whereProductCategoryId($categoryId)->select('id', 'name', 'price')->get();

        return response(['products' => $products]);
    }

    public function getStudentList()
    {
//        $students = Student::with('subjects')->get();
        $students = Student::all();

        return response(['students' => $students]);
    }

}
