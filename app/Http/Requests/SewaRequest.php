<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SewaRequest extends FormRequest
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
            'penyewa_id'        => 'required',
            'motor_id'          => 'required',
            'tanggal_sewa'      => 'required',
            'tanggal_kembali'   => 'required',
            'catatan'           => 'string'
        ];
    }
}
