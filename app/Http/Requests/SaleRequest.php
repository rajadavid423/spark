<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
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
        $id = optional($this->route('sale'))->id;
        return [
            'invoice_number' => 'nullable|string|unique:sales,invoice_number,' . $id . ',id',
            'customer_id' => 'required|integer|exists:customers,id',
            'date' => 'required|date',
            'employee_id' => 'required|integer|exists:users,id',
            'product_details' => 'required|array',
            'product_details.*.product_category_id' => 'required',
            'product_details.*.product_id' => 'required',
            'product_details.*.quantity' => 'required',
            'product_details.*.price' => 'required',
            'product_details.*.amount' => 'required',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'required|numeric',
            'pending_amount' => 'required|numeric',
            'payment_mode' => 'required|string|in:' . implode(',', PAYMENT_MODE),
            'payment_due_date' => 'required|date',
        ];
    }
}
