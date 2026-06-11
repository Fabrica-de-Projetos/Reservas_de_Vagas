<?php

namespace App\Http\Requests\Estacionamento;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EstacionamentoUpdateRequest extends FormRequest
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
            'nome' => ['sometimes', 'string', 'max:100'],
            'rua' => ['sometimes', 'string', 'max:100'],
            'numero' => ['sometimes', 'string', 'max:10'],
            'bairro' => ['sometimes', 'string', 'max:100'],
            'cep' => ['sometimes', 'string', 'max:8'],
            'cidade' => ['sometimes', 'string', 'max:50'],
            'estado' => ['sometimes', 'string', 'max:2'],
            'total_vagas' => ['sometimes', 'integer']
        ];
    }
}
