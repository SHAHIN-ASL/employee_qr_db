<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeUpdateRequest extends FormRequest
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
        return [
            'employee_id'     => 'required|string',
            'name'            => 'required|string',
            'personal_number' => 'required',
            'official_number' => 'regex:/(01)[0-9]{9}/|nullable',
            'home_address'    => 'required',
            'ename'           => 'string|nullable',
            'erelation'       => 'string|nullable',
            'ephone'          => 'regex:/(01)[0-9]{9}/|nullable',
            'gender'          => 'required',
            'company_name'    => 'required',
            'dob'             => 'required',
            'blood_group'     => 'required',
            'marital_status'  => 'required',
            'personal_email'  => 'required|string|email',
            'official_email'  => 'required|string|email',
            'expiry_date'     => 'required',
            'joining_date'    => 'required',
            'designation'     => 'required|string',
            'file'            => 'mimes:jpg,jpeg,png',
        ];
    }
}
