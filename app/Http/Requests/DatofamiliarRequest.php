<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatofamiliarRequest extends FormRequest
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
            'relacion_id' => 'required',
            'user_id' => 'required',
            'prim_apellido' => 'required|max:30|min:3',
            'nombres' => 'required|min:3|max:50'
        ];
    }
}
