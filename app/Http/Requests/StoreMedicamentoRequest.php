<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Medicamento;
use Illuminate\Validation\Rule;

class StoreMedicamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'codigo_interno'   => ['required', 'string', 'max:30', 'unique:medicamentos,codigo_interno'],
            'nombre_comercial' => ['required', 'string', 'max:120'],
            'principio_activo' => ['required', 'string', 'max:120'],
            'categoria_id'     => ['required', Rule::exists('categorias', 'id')->where('activo', true)],
            'presentacion'     => ['required', 'string', 'max:80'],
            'precio_venta'     => ['required', 'numeric', 'min:0'],
            'stock_minimo'     => ['required', 'integer', 'min:0'],
            'condicion_venta'  => ['required', Rule::in(array_keys(Medicamento::CONDICIONES_VENTA))],
            'lista_control_id' => [
                'nullable',
                'required_if:condicion_venta,controlado',
                Rule::exists('listas_control', 'id')->where('activa', true),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'required'                     => 'El campo :attribute es obligatorio.',
            'max'                          => 'El campo :attribute admite hasta :max caracteres.',
            'codigo_interno.unique'        => 'Ya existe un medicamento con este código interno.',
            'categoria_id.exists'          => 'Seleccione una categoría válida y activa.',
            'precio_venta.min'             => 'El precio de venta no puede ser negativo.',
            'stock_minimo.min'             => 'El stock mínimo no puede ser negativo.',
            'condicion_venta.in'           => 'Seleccione una condición de venta válida.',
            'lista_control_id.required_if' => 'Debe seleccionar una lista de control cuando el medicamento es controlado.',
            'lista_control_id.exists'      => 'La lista de control seleccionada no es válida o está inactiva.',
        ];
    }

    public function attributes(): array
    {
        return [
            'codigo_interno'   => 'código interno',
            'nombre_comercial' => 'nombre comercial',
            'principio_activo' => 'principio activo (DCI)',
            'categoria_id'     => 'categoría',
            'presentacion'     => 'presentación',
            'precio_venta'     => 'precio de venta',
            'stock_minimo'     => 'stock mínimo',
            'condicion_venta'  => 'condición de venta',
            'lista_control_id' => 'lista de control',
        ];
    }
}
