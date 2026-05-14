<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estacionamento extends Model
{
    protected $fillable = [
        'nome',
        'rua',
        'numero',
        'bairro',
        'cep',
        'cidade',
        'estado',
        'total_vagas'
    ];

    protected $with = ['vagas'];

    public function vagas()
    {
        return $this->hasMany(Vaga::class, 'estacionamento_id');
    }
}
