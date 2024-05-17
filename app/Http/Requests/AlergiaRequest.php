<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlergiaRequest extends FormRequest
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
            'alergia' => 'required|max:150|min:3|unique:alergias,alergia',
        ];
    }
}

