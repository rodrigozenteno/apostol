<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComplementarioRequest extends FormRequest
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
            'direccion' => 'required|max:150|min:3',
            'cel' => 'required|max:9|min:8',
            'contacto' => 'required|max:150|min:3',
            'cel_contacto' => 'required|max:9|min:8'
        ];
    }
}