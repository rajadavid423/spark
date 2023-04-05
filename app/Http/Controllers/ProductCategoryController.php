<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:Product Category');
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = ProductCategory::all();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {

                    $button = '<div class="d-flex justify-content-center">';

                    $button .= '<a onclick="getData(' . $data->id . ')" data-toggle="modal" data-target="#updateBranch"><img src="' . url('images/edit.png') . '" class="ml-3"></a>';
                    $button .= '<a onclick = "commonDelete(\'' . route('product-category.destroy', $data->id) . '\')" ><img src="' . url('images/delete.png') . '" class="ml-3"></a>';

                    $button .= '</div>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('product.product_category');
    }


    public function store(ProductCategoryRequest $request)
    {
        try {
            $input = $request->all();

            ProductCategory::create($input);
            return response(['message' => 'Success']);
        } catch (\Exception $exception) {
            info('Error::Place@ProductCategoryController@store - ' . $exception->getMessage());
            return response(['message' => 'fail']);
        }
    }


    public function show(ProductCategory $productCategory)
    {
        return response(["category" => $productCategory]);
    }


    public function update(ProductCategoryRequest $request, ProductCategory $productCategory)
    {
        try {
            $input = $request->all();
            $productCategory->update($input);
            return response(['message' => 'Success']);
        } catch (\Exception $exception) {
            info('Error::Place@ProductCategoryController@update - ' . $exception->getMessage());
            return response(['message' => 'fail']);
        }
    }


    public function destroy(ProductCategory $productCategory)
    {
        try {
            $productCategory->delete();
            return response(['status' => 'warning', 'message' => 'Deleted Successfully!']);
        } catch (\Exception $exception) {
            info('Error::Place@ProductCategoryController@delete - ' . $exception->getMessage());
            return response(['message' => 'Something went wrong!']);
        }
    }
}
