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

    public function veiculos()
    {
        return $this->hasMany(Veiculo::class, 'veiculo_id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_usuario');
    }
}
