<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePenyewaRequest extends FormRequest
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
            'no_identitas' => 'required|unique:penyewas',
            'nama_penyewa' => 'required',
            'gender'       => 'required',
            'no_hp'        => 'required|unique:penyewas',
            'alamat'       => 'required'
        ];
    }
}
