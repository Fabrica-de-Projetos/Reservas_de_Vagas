<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    protected $fillable = [
        'id_estacionamento',
        'numero',
        'tipo'
    ];

    public function estacionamento()
    {
        return $this->belongsTo(Estacionamento::class);
    }

    public function reservas()
    {           
        return $this->hasMany(Reserva::class, 'id_vaga');
    }
}
