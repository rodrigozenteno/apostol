<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class Destino_NovedadRequest extends FormRequest
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
        $desde = substr(Carbon::now()->toDateTimeString(),0,10);
        return [
            'desde' => 'required|date|after_or_equal:' . $desde,
            'hasta' => 'required|date|after_or_equal:desde',
        ];
    }
}

