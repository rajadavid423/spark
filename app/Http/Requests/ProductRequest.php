<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = optional($this->route('product'))->id;
        return [
            'product_category_id' => 'required|integer|exists:product_categories,id',
            'name' => 'required|string|max:100|unique:products,name,' . $id . ',id',
            'price' => 'required|numeric',
            'date' => 'required|date',
        ];
    }
}
