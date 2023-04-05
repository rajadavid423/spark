<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Support\Facades\Auth;

class ProductController extends BaseController
{
    /**
     * Product category List API
     *
     * @return JsonResponse
     */
    public function getCategoryList()
    {
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            return $this->sendError('ERROR', ['error' => 'Access Denied!, User does not have the right roles.'], 403);
        }
        $categories = ProductCategory::all();

        return $this->sendResponse($categories, 'Success!');
    }

    /**
     * Product List API
     *
     * @return JsonResponse
     */
    public function getProductList()
    {
        $user = auth()->user();
        if (!$user->hasRole('Admin')) {
            return $this->sendError('ERROR', ['error' => 'Access Denied!, User does not have the right roles.'], 403);
        }
        $products = Product::all();

        return $this->sendResponse($products, 'Success!');
    }
}
