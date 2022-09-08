<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMotorRequest extends FormRequest
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
            'image_motor'     => 'required|image|mimes:jpeg,bmp,png,jpg',
            'nama'      => 'required|max:225',
            'kategori'  => 'required|max:225',
            'catatan'   => 'required',
            'harga'     => 'required',
            'no_polisi' => 'required|unique:motors'
        ];
    }
}
