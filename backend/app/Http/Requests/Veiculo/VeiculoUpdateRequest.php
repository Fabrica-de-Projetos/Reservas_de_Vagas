<?php

namespace App\Http\Requests\Veiculo;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VeiculoUpdateRequest extends FormRequest
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
            'modelo' => ['sometimes', 'string'],
            'placa' => ['sometimes', 'string'],
            'maraca' => ['sometimes', 'string'],
            'cor' => ['sometimes', 'string'],
            'ano' => ['sometimes', 'digits:4']
        ];
    }
}
