<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmprendedorRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'direccion' => ['required'],
            'telefonos' => ['nullable'],
            'celulares' => ['required'],
            'actividad' => ['required'],
            'user_id' => ['required', 'integer'],
            'fecha_nacimiento' => ['required', 'date'],
            'billetera_id' => ['nullable'],
        ];
    }
}
