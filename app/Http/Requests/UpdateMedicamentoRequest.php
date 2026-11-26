<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UpdateMedicamentoRequest extends StoreMedicamentoRequest
{
    public function rules(): array
    {
        $reglas = parent::rules();
        $id = $this->route('medicamento');

        $reglas['codigo_interno'] = [
            'required', 'string', 'max:30',
            Rule::unique('medicamentos', 'codigo_interno')->ignore($id),
        ];

        return $reglas;
    }
}