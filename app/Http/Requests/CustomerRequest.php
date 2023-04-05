<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        $id = optional($this->route('customer'))->id;
        return [
            'customer_code' => 'nullable|string|unique:customers,customer_code,' . $id . ',id,deleted_at,NULL',
            'name' => 'required|string|max:200',
            'mobile' => 'required|integer|digits:10',
            'mobile2' => 'nullable|integer|digits:10',
            'date' => 'nullable|date',
        ];
    }
}
