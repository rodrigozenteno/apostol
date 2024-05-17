<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnidadRequest extends FormRequest
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
            'unidad' => 'required|max:100|unique:unidads,unidad',
            'abrev' => 'required|max:50|unique:unidads,abrev',
            'municipio_id' => 'required',
            'ubicacion_id' => 'required',
            'tipo_id' => 'required',
        ];
    }
}
