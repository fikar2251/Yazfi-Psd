<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'nik' => 'required',
            'no_ktp' => 'required',
            'email' => 'required|unique:users',
            'phone_number' => 'required',
            'password' => 'required',
            'role' => 'required',
            'id_agamas' => 'required',
            'id_jabatan' => 'required',
            'id_pernikahan' => 'required',
            'id_perusahaan' => 'required',
            'password' => 'required',
            'created_at' => 'required',
            'address' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The nama field is required.',
            'nik.required' => 'The nip field is required.',
            'no_ktp.required' => 'The no ktp field is required.',
            'email.required' => 'The email field is required.',
            'phone_number.required' => 'The no telp field is required.',
            'password.required' => 'The password field is required.',
            'role.required' => 'Please select divisi.',
            'id_agamas.required' => 'Please select agama.',
            'id_jabatan.required' => 'Please select jabatan.',
            'id_pernikahan.required' => 'Please select status pribadi.',
            'id_perusahaan.required' => 'Please select perusahaan.',
            'password.required' => 'The password field is required',
            'created_at.required' => 'The tanggal masuk field is required',
            'address.required' => 'The alamat field is required.',
            'image.required' => 'The image field is required.',
        ];
    }
}
