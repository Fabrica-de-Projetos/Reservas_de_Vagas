<?php

namespace App\Http\Requests\usuario;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UsuarioUpdateRequest extends FormRequest
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
        $usuario = $this->route('usuario');

        return [
            'nome_usuario' => ['sometimes', 'string', 'max:100'],
            'email' => ['sometimes', 'email', Rule::unique('usuarios', 'email')->ignore($usuario->id)],
            'senha' => ['sometimes', 'min:6']
        ];
    }
}
