<?php

namespace App\Http\Requests\Reserva;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ReservaUpdateRequest extends FormRequest
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
            'data_inicio' => ['sometimes', 'date', 'before:data_fim'],
            'data_fim' => ['sometimes', 'date', 'after:data_inicio']
        ];
    }
}
