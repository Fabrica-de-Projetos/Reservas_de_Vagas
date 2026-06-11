<?php

namespace App\Http\Requests\Vaga;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VagaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id_estacionamento' => ['required', 'integer'],

            'numero' => [
                'required',
                'integer',
                Rule::unique('vagas')->where(function ($query) {
                    return $query->where(
                        'id_estacionamento',
                        $this->id_estacionamento
                    );
                }),
            ],

            'tipo' => ['required']
        ];
    }
}
