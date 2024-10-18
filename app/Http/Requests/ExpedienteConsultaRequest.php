<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpedienteConsultaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'ci' => 'required|numeric|exists:ciudadanos,ci',
            'n_mesa_entrada' => 'required|exists:expedientes,n_mesa_entrada',
        ];
    }

    public function messages()
    {
        return [
            'ci.required' => 'Ingrese un número de CI.',
            'ci.numeric' => 'El CI debe ser númerico.',
            'ci.exists' => 'No hay registros con ese número de CI.',
            'n_mesa_entrada.required' => 'Ingrese su número de mesa de entrada',
            'n_mesa_entrada.exists' => 'No hay datos coincidentes con el número de mesa de entrada',
        ];
    }
}
