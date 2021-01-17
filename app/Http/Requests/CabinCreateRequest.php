<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CabinCreateRequest extends FormRequest
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
            //
            'id' => 'required|unique:cabins',
            'type' => 'required|exists:type_cabins,id',
            'cantPax' => 'required|integer',
            'valorTemporadaAlta' => 'required|regex:/^\d*(\.\d{2})?$/',
            'valorTemporadaBaja' => 'required|regex:/^\d*(\.\d{2})?$/',
        ];
    }
}
