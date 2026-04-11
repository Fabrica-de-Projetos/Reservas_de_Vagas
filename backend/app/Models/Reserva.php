<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'id_usuario',
        'id_veiculo',
        'id_vaga',
        'data_inicio',
        'data_fim'
    ];
}
