<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadRequest extends FormRequest
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
            'especialidad' => 'required|max:35|min:8|unique:especialidads,especialidad',
            'abreviacion' => 'required|max:25|min:4|unique:especialidads,abreviacion',
        ];
    }
}
