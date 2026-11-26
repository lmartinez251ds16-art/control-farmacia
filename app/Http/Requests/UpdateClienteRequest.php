<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateClienteRequest extends StoreClienteRequest
{
    public function rules(): array
    {
        $reglas = parent::rules();

        $reglas['dni'] = [
            'required',
            'digits:8',
            Rule::unique('clientes', 'dni')->ignore($this->route('cliente')),
        ];

        return $reglas;
    }
}