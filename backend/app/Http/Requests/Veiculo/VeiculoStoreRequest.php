<?php

namespace App\Http\Requests\Veiculo;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class VeiculoStoreRequest extends FormRequest
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
            'modelo' => ['required', 'string'],
            'placa' => ['required', 'string'],
            'marca' => ['required', 'string'],
            'cor' => ['required', 'string'],
            'ano' => ['required', 'digits:4']
        ];
    }
}
