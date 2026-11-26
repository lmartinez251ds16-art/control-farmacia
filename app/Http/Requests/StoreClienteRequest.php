<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'dni'       => ['required', 'digits:8', 'unique:clientes,dni'],
            'nombres'   => ['required', 'string', 'max:80'],
            'apellidos' => ['required', 'string', 'max:80'],
            'telefono'  => ['nullable', 'digits:9', 'starts_with:9'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'             => 'El campo :attribute es obligatorio.',
            'max'                  => 'El campo :attribute admite hasta :max caracteres.',
            'dni.digits'           => 'El DNI debe tener exactamente 8 dígitos.',
            'dni.unique'           => 'Ya existe un cliente registrado con este DNI.',
            'telefono.digits'      => 'El celular debe tener 9 dígitos.',
            'telefono.starts_with' => 'El celular debe empezar con 9.',
        ];
    }

    public function attributes(): array
    {
        return [
            'dni'      => 'DNI',
            'telefono' => 'celular',
        ];
    }
}