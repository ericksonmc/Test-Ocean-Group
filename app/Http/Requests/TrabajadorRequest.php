<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TrabajadorRequest extends Request
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
            'nombre' => 'string|required|max:10|min:3',
            'apellido' => 'string|required|max:10|min:3',
            'cedula' => 'numeric|unique:trabajadors,cedula|required|min:3',
            'cargo' => 'string|required|max:50|min:3',
            'correo' => 'email|unique:trabajadors,correo|required'
        ];
    }
}
