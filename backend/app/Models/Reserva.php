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
    
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }

    public function veiculo()
    {
        return $this->belongsTo(Veiculo::class, 'id_veiculo');
    }

    public function vaga()
    {
        return $this->belongsTo(Vaga::class, 'id_vaga');
    }
}
