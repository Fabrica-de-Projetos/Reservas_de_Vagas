<?php

namespace App\Http\Requests\Estacionamento;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class EstacionamentoStoreRequest extends FormRequest
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
            'nome' => ['required', 'string', 'max:100'],
            'rua' => ['required', 'string', 'max:100'],
            'numero' => ['required', 'string', 'max:10'],
            'bairro' => ['required', 'string', 'max:100'],
            'cep' => ['required', 'string', 'max:8'],
            'cidade' => ['required', 'string', 'max:50'],
            'total_vagas' => ['required', 'integer'],
            'imagem' => ['required', 'image', 'mimes:jpg,png,webp', 'max:2048']
        ];
    }
}
