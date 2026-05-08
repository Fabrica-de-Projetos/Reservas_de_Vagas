<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $fillable = [
        'id_usuario',
        'modelo',
        'placa',
        'marca',
        'cor',
        'ano'
    ];

    public function usuario()
    {
        return $this->belongsTo(Veiculo::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_veiculo');
    }
}
