<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'estado_id' => 'required',
            'escalafon_id' => 'required',
            'ci' => 'required|max:10|min:7|unique:users,ci',
            'c_militar' => 'required|max:10|min:8|unique:carnets,c_militar',
            'seguro_id' => 'required',
            'c_seguro' => 'required|max:15|min:9|unique:carnets,c_seguro',
            'papeleta' => 'required|min:7|unique:users,papeleta',
            'grado_id' => 'required',
            'arma_id' => 'required',
            'prim_nombre' => 'required|max:30|min:3',
            'prim_apellido' => 'required|max:30|min:3',
            'f_nac' => 'required',
            'departamento_id' => 'required',
            'provincia_id' => 'required',
            'municipio_id' => 'required',
            'e_civil' => 'required',
            'sexo' => 'required',
            'g_sang' => 'required',
            'email' => 'required|max:255|min:11|unique:users,email',
        ];
    }
}
