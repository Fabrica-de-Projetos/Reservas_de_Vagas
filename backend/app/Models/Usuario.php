<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Model
{
    use HasApiTokens;
    protected $fillable = [
        'nome',
        'email',
        'senha',
        'telefone',
        'cidade',
        'estado'
    ];

    protected $with = ['veiculos', 'reservas'];

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'id_usuario');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_usuario');
    }
}
