<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $id = optional($this->route('employee'))->id;
        $validation = [
            'employee_code' => 'nullable|string|unique:users,employee_code,' . $id . ',id',
            'name' => 'required|string|max:200',
            'phone' => 'required|integer|digits:10',
            'date_of_joining' => 'nullable|date',
            'reliving_date' => 'nullable|date',
            'email' => 'required|email|max:50|unique:users,email,' . $id . ',id',
            'role_id' => 'nullable|string|max:70',
        ];

        if ($this->isMethod("POST")) {
            $validation["password"] = 'required|min:8|max:20';
        }

        if ($this->isMethod("PUT")) {
            $validation["password"] = 'nullable|min:8|max:20';
        }

        return $validation;
    }
}
