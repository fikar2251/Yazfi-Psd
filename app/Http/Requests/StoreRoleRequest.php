<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRoleRequest extends FormRequest
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
            'name' => 'required',
            'id_perusahaan' => 'required',
            'permission' => 'required|array'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'The nama field is required.',
            'id_perusahaan.required' => 'Please select perusahaan field is required.',
            'permission.required' => 'The permission field is required.',
        ];
    }
}
