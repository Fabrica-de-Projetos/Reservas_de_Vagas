<?php

namespace App\Http\Requests\Reserva;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReservaStoreRequest extends FormRequest
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
            'id_usuario' => ['required', 'integer', 'exists:usuarios,id'],
            'id_veiculo' => ['required', 'integer', 'exists:veiculos,id'],
            'id_vaga' => ['required', 'integer', 'exists:vagas,id'],
            'data_inicio' => ['required', 'date'],
            'data_fim' => ['required', 'date']
        ];
    }
}
